<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|string|max:50|unique:books',
            'book_name' => 'required|string|max:50',
            'age_group_id' => 'required|string|max:50',
            'publisher_id' => 'required|string|max:50',
            'publication_year' => 'required|integer',
            'available' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_name' => 'required|string|max:50',
            'age_group_id' => 'required|string|max:50',
            'publisher_id' => 'required|string|max:50',
            'publication_year' => 'required|integer',
            'available' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}
