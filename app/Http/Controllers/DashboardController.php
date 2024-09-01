<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgeGroupResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\PublisherResource;
use App\Models\AgeGroup;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Book::query()->orderBy('name', 'asc')->paginate(12)
        ->onEachSide(1);

    
        $genres = Genre::all();
        $author = Author::all();
        $publisher = Publisher::all();
        $agegroup = AgeGroup::all();
        $headerProps = [
            'genres' => GenreResource::collection($genres),
            'authors' => AuthorResource::collection($author),
            'publishers' => PublisherResource::collection($publisher),
            'agegroups' => AgeGroupResource::collection($agegroup),
        ];

        // Fetch authenticated user
        $user = auth()->user();

        return Inertia::render('Dashboard', [
            'auth' => [
                'user' => $user,
            ],
            'headerProps' => $headerProps,
            'books' => BookResource::collection($books),
        ]);
    }
}
