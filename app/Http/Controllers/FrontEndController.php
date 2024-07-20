<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Models\Genre;
use App\Models\Author;

class FrontEndController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($model, $id)
    {
        $item = null;
        $view = '';

        switch ($model) {
            case 'publisher':
                $item = Publisher::findOrFail($id);
                $view = 'publishers.show';
                break;
            case 'genre':
                $item = Genre::findOrFail($id);
                $view = 'genres.show';
                break;
            case 'author':
                $item = Author::findOrFail($id);
                $view = 'authors.show';
                break;
            // Add more cases for other models as needed
            default:
                abort(404);
        }

        return view($view, compact('item'));
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

