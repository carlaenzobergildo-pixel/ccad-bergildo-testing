<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\BookGenre;
use Illuminate\Http\Request;

class BookGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookGenres = BookGenre::select(['id', 'book_id', 'genre_id'])->with([
            'book:id,title,slug,isbn,price,description,image,author_id,publisher_id',
            'genre:id,genre_name',
        ])->get();

        dd($bookGenres);

        return Inertia::render('book-genre/index', [
            'bookGenres' => $bookGenres
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BookGenre $bookGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookGenre $bookGenre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookGenre $bookGenre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookGenre $bookGenre)
    {
        //
    }
}
