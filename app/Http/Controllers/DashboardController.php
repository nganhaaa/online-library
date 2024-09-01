<?php

namespace App\Http\Controllers;

use App\Http\Resources\AgeGroupResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\PublisherResource;
use App\Models\AgeGroup;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch headerProps and other data as needed
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
        ]);
    }
}
