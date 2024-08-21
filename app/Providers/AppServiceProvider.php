<?php

namespace App\Providers;

use App\Models\AgeGroup;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\ServiceProvider;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Support\Facades\View;

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
        View::share('authors', Author::all());
        View::share('books', Book::paginate(10)->onEachSide(3));
        View::share('genres', Genre::all());
        View::share('publishers', Publisher::all());
        View::share('agegroups', AgeGroup::all());
    }
}
