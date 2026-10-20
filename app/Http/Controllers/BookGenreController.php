<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookGenre;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class BookGenreController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('book_genres/index', [
            'records' => BookGenre::with(['book:id,title', 'genre:id,genre_name'])->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('book_genres/create', ['options' => $this->options()]);
    }

    public function store(Request $request): RedirectResponse
    {
        BookGenre::create($this->validated($request));

        return to_route('book_genres.index');
    }

    public function edit(BookGenre $bookGenre): Response
    {
        return Inertia::render('book_genres/edit', [
            'record' => $bookGenre,
            'options' => $this->options(),
        ]);
    }

    public function update(Request $request, BookGenre $bookGenre): RedirectResponse
    {
        $bookGenre->update($this->validated($request));

        return to_route('book_genres.index');
    }

    public function destroy(BookGenre $bookGenre): RedirectResponse
    {
        $bookGenre->delete();

        return to_route('book_genres.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'book_id' => ['required', 'integer', Rule::exists('books', 'id')],
            'genre_id' => ['required', 'integer', Rule::exists('genres', 'id')],
        ]);
    }

    private function options(): array
    {
        return [
            'books' => Book::query()->orderBy('title')->get(['id', 'title'])->map(fn (Book $book) => ['id' => $book->id, 'label' => $book->title]),
            'genres' => Genre::query()->orderBy('genre_name')->get(['id', 'genre_name'])->map(fn (Genre $genre) => ['id' => $genre->id, 'label' => $genre->genre_name]),
        ];
    }
}
