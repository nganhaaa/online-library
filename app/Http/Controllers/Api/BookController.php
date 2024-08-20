<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $genreId = $request->query('genre_id');
        $authorId = $request->query('author_id');
        $ageGroupId = $request->query('age_group_id');
        $publisherId = $request->query('publisher_id');

        $query = Book::query()->with(['ageGroup', 'publisher', 'authors', 'genres']);

        if ($genreId) {
            $query->where('genre_id', $genreId);
        }

        if ($authorId) {
            $query->where('author_id', $authorId);
        }

        if ($ageGroupId) {
            $query->where('age_group_id', $ageGroupId);
        }

        if ($publisherId) {
            $query->where('publisher_id', $publisherId);
        }

        $books = $query->orderBy('name', 'asc')->get();

        return Inertia::render('Book/Index', [
            'books' => BookResource::collection($books),
        ]);
    }

    public function show(Book $book)
    {
        $book->load(['ageGroup', 'publisher', 'authors', 'genres']);
        return Inertia::render('Book/Show', [
            'book' => new BookResource($book),
        ]);
    }

    public function create()
    {
        return Inertia::render('Book/Create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('book.index')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'age_group_id' => 'required|exists:age_groups,id',
            'publisher_id' => 'required|exists:publishers,id',
            'publication_year' => 'required|integer',
            'available' => 'required|boolean',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        Book::create($validated);

        return redirect()->route('book.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        return Inertia::render('Book/Edit', [
            'book' => new BookResource($book),
        ]);
    }

    public function update(Request $request, Book $book)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('book.index')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'age_group_id' => 'required|exists:age_groups,id',
            'publisher_id' => 'required|exists:publishers,id',
            'publication_year' => 'required|integer',
            'available' => 'required|boolean',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        $book->update($validated);

        return redirect()->route('book.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('book.index')->with('error', 'Unauthorized.');
        }

        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully.');
    }
}
