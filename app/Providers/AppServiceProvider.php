<?php

namespace App\Providers;

use App\Http\Resources\AgeGroupResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\PublisherResource;
use App\Models\AgeGroup;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $genres = Genre::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $ageGroups = AgeGroup::all();

        $headerProps = [
            'genres' => GenreResource::collection($genres),
            'authors' => AuthorResource::collection($authors),
            'publishers' => PublisherResource::collection($publishers),
            'agegroups' => AgeGroupResource::collection($ageGroups),
        ];

        // Share data with all views
        Inertia::share('headerProps', $headerProps);
    }
}
