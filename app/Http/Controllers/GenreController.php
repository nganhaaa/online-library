<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GenreController extends Controller
{
    /**
     * Display a listing of the genres.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return Inertia::render('Genre/Index', [
            'genres' => GenreResource::collection($genres),
        ]);
    }

    /**
     * Show the form for creating a new genre.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Genre/Create');
    }

    /**
     * Store a newly created genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('genre.index')->with('error', 'Ungenreized.');
        }

        $validated = $request->validate([
            'genre_name' => 'required',
        ]);

        Genre::create($validated);

        return redirect()->route('genre.index')
            ->with('success', 'Genre created successfully.');
    }

    /**
     * Display the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return Inertia::render('Genre/Show', [
            'genre' => new GenreResource($genre),
        ]);
    }

    /**
     * Show the form for editing the specified genre.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return Inertia::render('Genre/Edit', [
            'genre' => new GenreResource($genre),
        ]);
    }

    /**
     * Update the specified genre in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('genre.index')->with('error', 'Unauthorized.');
        }

        $validated = $request->validate([
            'genre_name' => 'required',
        ]);

        $genre->update($validated);

        return redirect()->route('genre.index')
            ->with('success', 'Genre updated successfully.');
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('genre.index')->with('error', 'Unauthorized.');
        }

        $genre->delete();

        return redirect()->route('genre.index')
            ->with('success', 'Genre deleted successfully.');
    }
}

