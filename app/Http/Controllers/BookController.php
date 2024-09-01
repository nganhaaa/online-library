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

        $books = $query->orderBy('name', 'asc')->paginate(10)
        ->onEachSide(1);
        $books->additional([
            'meta' => [
                'key' => 'value',  // Add any additional metadata here
            ]
        ]);
    
        return Inertia::render('Book/Index', [
            'books' => $books,  // Pass the raw paginated object
        ]);
    }

    public function show(Book $book)
    {
        $book->load(['ageGroup', 'publisher', 'authors', 'genres']);
        return Inertia::render('Book/Show', [
            'book' => new BookResource($book),
        ]);
    }
}