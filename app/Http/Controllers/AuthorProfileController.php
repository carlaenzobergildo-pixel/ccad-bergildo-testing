<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class AuthorProfileController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('author_profiles/index', [
            'records' => AuthorProfile::with('author:id,name')->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('author_profiles/create', ['options' => $this->options()]);
    }

    public function store(Request $request): RedirectResponse
    {
        AuthorProfile::create($this->validated($request));

        return to_route('author_profiles.index');
    }

    public function edit(AuthorProfile $authorProfile): Response
    {
        return Inertia::render('author_profiles/edit', [
            'record' => $authorProfile,
            'options' => $this->options(),
        ]);
    }

    public function update(Request $request, AuthorProfile $authorProfile): RedirectResponse
    {
        $authorProfile->update($this->validated($request, $authorProfile));

        return to_route('author_profiles.index');
    }

    public function destroy(AuthorProfile $authorProfile): RedirectResponse
    {
        $authorProfile->delete();

        return to_route('author_profiles.index');
    }

    private function validated(Request $request, ?AuthorProfile $authorProfile = null): array
    {
        return $request->validate([
            'author_id' => [
                'required',
                'integer',
                Rule::exists('authors', 'id'),
                Rule::unique('author_profiles', 'author_id')->ignore($authorProfile?->id),
            ],
            'bio' => ['nullable', 'string'],
        ]);
    }

    private function options(): array
    {
        return [
            'authors' => Author::query()->orderBy('name')->get(['id', 'name'])->map(fn (Author $author) => ['id' => $author->id, 'label' => $author->name]),
        ];
    }
}
