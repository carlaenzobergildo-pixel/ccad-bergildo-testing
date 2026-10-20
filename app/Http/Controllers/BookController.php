<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class BookController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $search = is_string($search) ? trim($search) : '';
        $books = Book::with(['author:id,name', 'publisher:id,publisher_name', 'genres:id,genre_name'])
            ->when(
                $search !== '',
                fn ($query) => $query->whereRaw('LOWER(title) LIKE ?', ['%' . Str::lower($search) . '%']),
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('book/index', [
            'records' => $books,
            'filters' => ['search' => $search],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('book/create', ['options' => $this->options()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $genreIds = $validated['genre_ids'] ?? [];
        unset($validated['genre_ids']);

        $book = Book::create($validated);
        $book->genres()->sync($genreIds);

        return to_route('books.index');
    }

    public function edit(Book $book): Response
    {
        return Inertia::render('book/edit', [
            'record' => $book->load('genres:id,genre_name'),
            'options' => $this->options(),
        ]);
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $this->validated($request, $book);
        $genreIds = $validated['genre_ids'] ?? [];
        unset($validated['genre_ids']);

        $book->update($validated);
        $book->genres()->sync($genreIds);

        return to_route('books.index');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return to_route('books.index');
    }

    private function validated(Request $request, ?Book $book = null): array
    {
        return $request->validate([
            'author_id' => ['required', 'integer', Rule::exists('authors', 'id')],
            'publisher_id' => ['required', 'integer', Rule::exists('publishers', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('books', 'slug')->ignore($book?->id)],
            'isbn' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:2048'],
            'genre_ids' => ['sometimes', 'array'],
            'genre_ids.*' => ['integer', Rule::exists('genres', 'id')],
        ]);
    }

    private function options(): array
    {
        return [
            'authors' => Author::query()->orderBy('name')->get(['id', 'name'])->map(fn (Author $author) => ['id' => $author->id, 'label' => $author->name]),
            'publishers' => Publisher::query()->orderBy('publisher_name')->get(['id', 'publisher_name'])->map(fn (Publisher $publisher) => ['id' => $publisher->id, 'label' => $publisher->publisher_name]),
            'genres' => Genre::query()->orderBy('genre_name')->get(['id', 'genre_name'])->map(fn (Genre $genre) => ['id' => $genre->id, 'label' => $genre->genre_name]),
        ];
    }
}
