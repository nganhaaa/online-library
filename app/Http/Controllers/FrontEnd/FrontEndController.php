<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

class FrontEndController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function booksIndex()
    {
        return app(BookController::class)->index();
    }

    /**
     * Display the specified book.
     */
    public function booksShow($book)
    {
        return app(BookController::class)->show($book);
    }

    /**
     * Display a listing of genres.
     */
    public function genresIndex()
    {
        return app(GenreController::class)->index();
    }

    /**
     * Display the specified genre.
     */
    public function genresShow($genre)
    {
        return app(GenreController::class)->show($genre);
    }

    /**
     * Display a listing of authors.
     */
    public function authorsIndex()
    {
        return app(AuthorController::class)->index();
    }

    /**
     * Display the specified author.
     */
    public function authorsShow($author)
    {
        return app(AuthorController::class)->show($author);
    }
}
