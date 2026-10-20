<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GenreController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('genre/index', ['records' => Genre::query()->latest()->get()]);
    }

    public function create(): Response
    {
        return Inertia::render('genre/create');
    }

    public function store(Request $request): RedirectResponse
    {
        Genre::create($request->validate([
            'genre_name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('genres.index');
    }

    public function edit(Genre $genre): Response
    {
        return Inertia::render('genre/edit', ['record' => $genre]);
    }

    public function update(Request $request, Genre $genre): RedirectResponse
    {
        $genre->update($request->validate([
            'genre_name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('genres.index');
    }

    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();

        return to_route('genres.index');
    }
}
