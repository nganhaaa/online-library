<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve cart items from session
        $cartItems = $request->session()->get('cart', []);
        $bookIds = array_column($cartItems, 'book_id');
        $books = Book::whereIn('book_id', $bookIds)->get()->keyBy('book_id');

        // Merge cart items with book details
        foreach ($cartItems as $bookId => $item) {
            if (isset($books[$bookId])) {
                $item['book'] = $books[$bookId];
            } else {
                $item['book'] = null; // Handle case where book is not found
            }
            $cartItems[$bookId] = $item;
        }

        // Pass cart items to the view
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Add a book to the cart.
     *
     * @param Request $request
     * @param string $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, $bookId)
    {
        Log::info('Add to cart method called with book ID: ' . $bookId);

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
                'book_id' => $book->book_id,
                'quantity' => 1,
            ];
        }

        $request->session()->put('cart', $cart);

        Log::info('Cart contents: ' . print_r($cart, true));

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    /**
     * Remove a book from the cart.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $bookId = $cart[$id]['book_id'];
            $book = Book::find($bookId);
            if ($book) {
                $book->available += $cart[$id]['quantity'];
                $book->save();
            }
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Book removed from cart!');
    }

    /**
     * Create a borrowing receipt and clear the cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createBorrowingReceipt(Request $request)
    {
        // Handle the creation of borrowing receipt
        // This would typically involve saving details to the database

        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Borrowing receipt created!');
    }
}
