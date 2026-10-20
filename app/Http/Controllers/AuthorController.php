<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AuthorController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('author/index', [
            'records' => Author::with('publisher:id,publisher_name')->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('author/create', ['options' => $this->options()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Author::create($this->validated($request));

        return to_route('authors.index');
    }

    public function edit(Author $author): Response
    {
        return Inertia::render('author/edit', ['record' => $author, 'options' => $this->options()]);
    }

    public function update(Request $request, Author $author): RedirectResponse
    {
        $author->update($this->validated($request));

        return to_route('authors.index');
    }

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return to_route('authors.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'publisher_id' => ['required', 'integer', Rule::exists('publishers', 'id')],
            'name' => ['required', 'string', 'max:50'],
        ]);
    }

    private function options(): array
    {
        return [
            'publishers' => Publisher::query()->orderBy('publisher_name')->get(['id', 'publisher_name'])->map(fn (Publisher $publisher) => ['id' => $publisher->id, 'label' => $publisher->publisher_name]),
        ];
    }
}
