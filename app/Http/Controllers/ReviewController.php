<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ReviewController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('review/index', [
            'records' => Review::with(['user:id,name', 'reviewable'])->latest()->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('review/create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $this->ensureReviewableExists($validated['reviewable_type'], $validated['reviewable_id']);

        Review::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return to_route('reviews.index');
    }

    public function edit(Review $review): Response
    {
        return Inertia::render('review/edit', ['record' => $review]);
    }

    public function update(Request $request, Review $review): RedirectResponse
    {
        $validated = $this->validated($request);
        $this->ensureReviewableExists($validated['reviewable_type'], $validated['reviewable_id']);
        $review->update($validated);

        return to_route('reviews.index');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return to_route('reviews.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'reviewable_type' => ['required', Rule::in([Book::class, Product::class])],
            'reviewable_id' => ['required', 'integer', 'min:1'],
            'stars' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string'],
        ]);
    }

    private function ensureReviewableExists(string $type, int $id): void
    {
        $exists = $type === Book::class ? Book::whereKey($id)->exists() : Product::whereKey($id)->exists();

        if (!$exists) {
            throw ValidationException::withMessages([
                'reviewable_id' => 'Select an existing item.',
            ]);
        }
    }
}
