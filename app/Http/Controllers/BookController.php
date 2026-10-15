<?php

namespace App\Http\Controllers;

use index;
use App\Models\Book;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        // $books = Book::select(['id', 'author_id', 'publisher_id', 'title', 'slug', 'isbn', 'price', 'description', 'image'])->with([
        //     'author:id,publisher_id,name',
        //     'publisher:id,publisher_name',
        //     'genres:id,genre_name',
        //     'reviews:id,user_id,reviewable_id,reviewable_type,stars,comment',
        // ])->get();

        $books = Book::with(['author', 'publisher'])
        ->when(
            $request->search,
            fn($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
        )
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('book/index', [
            'books' => $books,
            'filters' => $request->only('search'),
        ]);
        
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
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
