<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BookGenreController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\AuthorProfileController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::resource('books', BookController::class)->except('show');
    Route::resource('authors', AuthorController::class)->except('show');
    Route::resource('publishers', PublisherController::class)->except('show');
    Route::resource('genres', GenreController::class)->except('show');
    Route::resource('author_profiles', AuthorProfileController::class)->except('show');
    Route::resource('book_genres', BookGenreController::class)->except('show');
    Route::resource('managers', ManagerController::class)->except('show');
    Route::resource('products', ProductController::class)->except('show');
    Route::resource('reviews', ReviewController::class)->except('show');
    Route::resource('warehouses', WarehouseController::class)->except('show');
    Route::resource('suppliers', SupplierController::class)->except('show');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
