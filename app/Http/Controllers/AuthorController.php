<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return Inertia::render('Author/Index', [
            'authors' => AuthorResource::collection($authors),
        ]);
    }

    /**
     * Display the specified author.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return inertia('Author/Show', [
            'author' => new AuthorResource($author),
        ]);
    }

}

