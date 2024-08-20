<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\ReceiptDetail;
use App\Models\BorrowReceipt;
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
     * @return \Inertia\Response
     */
    public function add(Request $request, $bookId)
    {
        // Log::info('Add to cart method called with book ID: ' . $bookId);

        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        if ($book->available <= 0) {
            return redirect()->back()->with('error', 'Book is out of stock.');
        }

        $book->available -= 1;
        $book->save();

        if (!$request->session()->has('cart')) {
            $request->session()->put('cart', []);
        }

        $cart = $request->session()->get('cart');

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] += 1;
        } else {
            $cart[$bookId] = [
                'book_id' => $bookId, // Store only the book ID
                'quantity' => 1,
            ];
        }

        $request->session()->put('cart', $cart);

        // Log::info('Cart contents: ' . print_r($cart, true));

        return redirect()->route('cart.index')->with('success', 'Book added to cart!');
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
            // Log::error("Attempted to remove book with ID $id that does not exist in cart.");
            return redirect()->route('cart.index')->with('error', 'Book not found in cart.');
        }
    
        // Retrieve the book ID
        $bookId = $cart[$id]['book_id'];
        $book = Book::find($bookId);
    
        if ($book) {
            $book->available += $cart[$id]['quantity'];
            $book->save();
        }
    
        unset($cart[$id]);
        session()->put('cart', $cart);
    
        return redirect()->route('cart.index')->with('success', 'Book removed from cart!');
    }

    /**
     * Update the quantity of a book in the cart.
     *
     * @param Request $request
     * @param string $bookId
     * @return \Inertia\Response
     */
    public function update(Request $request, $bookId)
    {
        $cart = session('cart', []);
        $book = Book::find($bookId);

        if (!isset($cart[$bookId])) {
            return redirect()->route('cart.index')->with('error', 'Book not found in cart.');
        }

        $quantity = $cart[$bookId]['quantity'];

        if ($request->action === 'increment') {
            if ($quantity + 1 > $book->available) {
                return redirect()->route('cart.index')->with('error', 'Exceeded available quantity');
            }
            $cart[$bookId]['quantity'] += 1;
        } elseif ($request->action === 'decrement' && $quantity > 1) {
            $cart[$bookId]['quantity'] -= 1;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
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

        // Check if there are items in the cart
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Generate a unique receipt ID
        $receiptId = uniqid();

        // Create a new borrowing receipt
        BorrowReceipt::create([
            'receipt_id' => $receiptId,
            'member_account_id' => Auth::id(), // Assuming the user is logged in and has an ID
            'borrow_date' => now(),
            'due_date' => now()->addDays(30), 
            'return_date' => null,
            'status' => 'Pending'
        ]);

        // Store borrowed books
        foreach ($cartItems as $bookId => $item) {
            $item['book'] = $books[$bookId];
            // Create a record for each borrowed book
            ReceiptDetail::create([
                'receipt_id' => $receiptId,
                'book_id' => $item['book']->id, // Book ID
                'quantity' => $item['quantity'], // Quantity
            ]);
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Borrowing receipt created successfully!');
    }
}
