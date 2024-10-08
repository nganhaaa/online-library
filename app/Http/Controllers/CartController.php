<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\ReceiptDetail;
use App\Models\BorrowReceipt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        // Retrieve cart items from session
        $cartItems = $request->session()->get('cart', []);
        $bookIds = array_column($cartItems, 'book_id');
        $books = Book::whereIn('id', $bookIds)->get()->keyBy('id');

        // Merge cart items with book details
        foreach ($cartItems as $bookId => $item) {
            if (isset($books[$bookId])) {
                $item['book'] = $books[$bookId];
            } else {
                $item['book'] = null; // Handle case where book is not found
            }
            $cartItems[$bookId] = $item;
        }

        // Pass cart items to the Inertia page
        return Inertia::render('Cart/Index', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Add a book to the cart.
     *
     * @param Request $request
     * @param string $bookId
     * @param int $quantity
     * @return \Inertia\Response
     */
    public function add(Request $request, $bookId)
    {
        $quantity = $request->input('quantity', 1);

        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }
    
        // Ensure cart exists in the session
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart', []);
        }
    
        $cart = $request->session()->get('cart');
    
        // Initial addition of book to the cart
        if (!isset($cart[$bookId])) {
            $cart[$bookId] = [
                'book_id' => $bookId,
                'quantity' => $quantity,
            ];
        } else {
            if ($book->available >= ($cart[$bookId]['quantity']+ $quantity)) {
                $cart[$bookId]['quantity']+= $quantity;
            } else {
                return redirect()->back()->with('error', 'Invalid operation or out of stock.');
            }
            
        }
    
        // Save the updated cart to the session
        $request->session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Book added to cart!');
    }
    


    /**
     * Remove a book from the cart.
     *
     * @param string $id
     * @return \Inertia\Response
     */
    public function remove($id)
    {
        $cart = session('cart', []);
    
        if (!isset($cart[$id])) {
            return redirect()->route('cart.index')->with('error', 'Book not found in cart.');
        }
    
        DB::beginTransaction();
    
        try {
            // Retrieve the book ID and update availability
            $bookId = $cart[$id]['book_id'];
            $book = Book::find($bookId);
    
            if ($book) {
                $book->available += $cart[$id]['quantity'];
                $book->save();
            }
    
            // Remove the book from the cart
            unset($cart[$id]);
            session()->put('cart', $cart);
    
            DB::commit();
            
            return redirect()->route('cart.index')->with('success', 'Book removed from cart!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error removing book from cart: ' . $e->getMessage());
            return redirect()->route('cart.index')->with('error', 'An error occurred.');
        }
    }
    
    /**
     * Update the quantity of a book in the cart.
     *
     * @param Request $request
     * @param string $bookId
     * @return \Inertia\Response
     */
    public function update(Request $request, $id)
{
    $cart = session('cart', []);
    $quantity = $request->input('quantity');
    if (!isset($cart[$id])) {
        return redirect()->route('cart.index')->with('error', 'Book not found in cart.');
    }

    $bookId = $cart[$id]['book_id'];
    $book = Book::find($bookId);

    if ($book) {
        DB::beginTransaction();

        try {
            if ($book->available >= $quantity) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                return redirect()->back()->with('error', 'Invalid operation or out of stock.');
            }

            session()->put('cart', $cart);
            DB::commit();
            
            return redirect()->route('cart.index')->with('success', 'Quantity updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    return redirect()->route('cart.index')->with('error', 'Book not found.');
}


    /**
     * Create a borrowing receipt and clear the cart.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function createBorrowReceipt(Request $request)
    {
        $cartItems = session('cart', []);
        $bookIds = array_column($cartItems, 'book_id');
        $books = Book::whereIn('id', $bookIds)->get()->keyBy('id');
    
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to borrow books.');
        }
    
        // Check if there are items in the cart
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
    
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Create a new borrowing receipt
            $borrowReceipt = BorrowReceipt::create([
                'user_id' => Auth::id(), // Assuming the user is logged in and has an ID
                'borrow_date' => now(),
                'due_date' => now()->addDays(30),
                'return_date' => null,
                'status' => 'Pending'
            ]);
    
            // Retrieve the generated receipt ID
            $receiptId = $borrowReceipt->id;
    
            // Store borrowed books
            foreach ($cartItems as $bookId => $item) {
                $item['book'] = $books[$bookId];
    
                // Create a record for each borrowed book
                ReceiptDetail::create([
                    'receipt_id' => $receiptId,
                    'book_id' => $item['book']->id, // Book ID
                    'quantity' => $item['quantity'], // Quantity
                    'status' => 'Pending'
                ]);
            }
    
            // Commit the transaction
            DB::commit();
    
            // Clear the cart
            session()->forget('cart');
            $cartItems = [];
            return redirect()->route('cart.index')->with('success', 'Borrowing receipt created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
    
            // Optionally log the error or handle it as needed
            Log::error('Error creating borrowing receipt: ' . $e->getMessage());
    
            return redirect()->route('cart.index')->with('error', 'Failed to create borrowing receipt. Please try again.');
        }
    }
    
}
