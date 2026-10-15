<?php

namespace App\Http\Controllers;

use index;
use Inertia\Inertia;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\Author\AuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::select(['id', 'publisher_id', 'name'])->with([
            'publisher:id,publisher_name',
            'profile:id,author_id,bio',
            'books',
        ])->get();

        dd($authors);

        return Inertia::render('author/index', [
            'authors' => $authors
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('author/create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
