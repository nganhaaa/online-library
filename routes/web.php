<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resources([
        'books' => BookController::class,
        'users' => UserController::class,
        'genres' => GenreController::class,
        'authors' => AuthorController::class,
        'publishers' => PublisherController::class,
    ]);
});

// Route::get('/', [FrontEndController::class, 'genresIndex']);

// // Books
// Route::get('/books', [FrontEndController::class, 'booksIndex'])->name('books.index');
// Route::get('/books/{book}', [FrontEndController::class, 'booksShow'])->name('books.show');

// // Genres
// Route::get('/genres', [FrontEndController::class, 'genresIndex'])->name('genres.index');
// Route::get('/genres/{genre}', [FrontEndController::class, 'genresShow'])->name('genres.show');

// // Authors
// Route::get('/authors', [FrontEndController::class, 'authorsIndex'])->name('authors.index');
// Route::get('/authors/{author}', [FrontEndController::class, 'authorsShow'])->name('authors.show');

// // Publishers
// Route::get('/publishers', [FrontEndController::class, 'publishersIndex'])->name('publishers.index');
// Route::get('/publishers/{publisher}', [FrontEndController::class, 'publishersShow'])->name('publishers.show');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/borrow', [CartController::class, 'createBorrowingReceipt'])->name('cart.borrow');
});

require __DIR__.'/auth.php';
