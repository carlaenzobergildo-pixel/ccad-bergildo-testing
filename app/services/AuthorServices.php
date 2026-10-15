<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Pagination\LengthAwarePaginator;

class AuthorService
{
    public function paginate(?string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return Author::query()
            ->with(['publisher:id,publisher_name'])
            ->withCount('books')
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }
}