<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;


class FrontEndController extends Controller
{
    // public function show(Book $book)
    // {
    //     return view('books.show', compact('book'));
    // }

    public function index()
    {
        $books = Book::paginate(2);
        return view('book.index', compact('books'));
    }

    public function show($id)
    {
        // Fetch the book model by ID
        $book = Book::findOrFail($id);
        
        // Pass data to the view
        return view('book.show', compact('book'));
    }
     /**
     * Display a listing of items based on model.
     *
     * @param string $model
     * @return \Illuminate\View\View
     */
    // public function index($model)
    // {
    //     switch ($model) {
    //         case 'publishers':
    //             $items = Publisher::all();
    //             $view = 'publishers.index';
    //             break;
    //         case 'genres':
    //             $items = Genre::all();
    //             $view = 'genres.index';
    //             break;
    //         case 'authors':
    //             $items = Author::all();
    //             $view = 'authors.index';
    //             break;
    //         default:
    //             abort(404);
    //     }

    //     return view($view, compact('items'));
    // }

    public function GenreIndex()
    {
        $genres = Genre::all();
        return view('dashboard', compact('genres'));
    }
}

