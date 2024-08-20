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
     * Show the form for creating a new author.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Author/Create');
    }

    /**
     * Store a newly created author in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('author.index')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'nationality' => 'required',
        ]);

        Author::create($validated);

        return redirect()->route('author.index')
            ->with('success', 'Author created successfully.');
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

    /**
     * Show the form for editing the specified author.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return Inertia::render('Author/Edit', [
            'author' => new AuthorResource($author),
        ]);
    }

    /**
     * Update the specified author in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('author.index')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'nationality' => 'required',
        ]);

        $author->update($validated);

        return redirect()->route('author.index')
            ->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified author from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('author.index')->with('error', 'Unauthorized.');
        }

        $author->delete();

        return redirect()->route('author.index')
            ->with('success', 'Author deleted successfully.');
    }
}

