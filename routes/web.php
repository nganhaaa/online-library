<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowReceiptController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('book', BookController::class);
Route::resource('borrow-receipts', BorrowReceiptController::class);

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Add a book to the cart
Route::post('/cart/add/{bookId}/', [CartController::class, 'add'])->name('cart.add');

// Remove a book from the cart
Route::delete('/cart/remove/{bookId}', [CartController::class, 'remove'])->name('cart.remove');

// Update the quantity of a book in the cart
Route::patch('/cart/update/{bookId}', [CartController::class, 'update'])->name('cart.update');


// Create a borrowing receipt and clear the cart
Route::post('/cart/borrow', [CartController::class, 'createBorrowReceipt'])->name('cart.borrow');
});


require __DIR__.'/auth.php';
