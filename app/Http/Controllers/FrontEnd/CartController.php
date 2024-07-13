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

    public function add(Request $request, $book_id)
    {
        $book = Book::findOrFail($book_id);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('book_id', $book_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $book_id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Book added to cart.');
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
