<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use App\Models\BorrowingReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('book')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, $bookId)
    {
        // Validate the request (optional)
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Find the book by its ID
        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }
    
        // Initialize cart in session if not already set
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart', []);
        }
    
        // Get the current cart from session
        $cart = $request->session()->get('cart');
    
        // Check if the book is already in the cart
        if (isset($cart[$bookId])) {
            // Update quantity if book is already in the cart
            $cart[$bookId]['quantity'] += $request->input('quantity', 1);
        } else {
            // Add new book to the cart
            $cart[$bookId] = [
                'book' => $book,
                'quantity' => $request->input('quantity', 1),
            ];
        }
    
        // Save the updated cart back to session
        $request->session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Book added to cart!');
    }
    

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Book removed from cart.');
    }

    public function createBorrowingReceipt()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $borrowingReceipt = BorrowingReceipt::create([
            'receipt_id' => uniqid('receipt_'),
            'member_account_id' => Auth::id(),
            'fee_id' => null, // Adjust this based on your fee structure
            'borrow_date' => now(),
            'due_date' => now()->addWeeks(2), // Set due date as two weeks from now
            'return_date' => null,
            'status' => 'borrowed',
        ]);

        foreach ($cartItems as $item) {
            $borrowingReceipt->borrowedBooks()->create([
                'receipt_id' => $borrowingReceipt->receipt_id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
            ]);

            // Update book availability
            $book = Book::findOrFail($item->book_id);
            $book->available -= $item->quantity;
            $book->save();
        }

        // Empty the cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('borrowings.show', $borrowingReceipt->receipt_id)
            ->with('success', 'Borrowing receipt created successfully.');
    }
}
