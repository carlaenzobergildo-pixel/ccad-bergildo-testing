<?php

namespace App\Services;

use App\Models\Publisher;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PublisherService
{
    public function paginate(
        ?string $search = null,
        int $page = 5,
    ): LengthAwarePaginator
    {
        return Publisher::query()
        ->search($search)
        ->latestFirst()
        ->paginate($page)
        ->withQueryString();
    }

    public function create(array $data): Publisher
    {
        return DB::transaction(
            fn() => Publisher::create($data)
        );
    }

    public function update(Publisher $publisher, array $data): Publisher
    {
        return DB::transaction(
            function() use (
                $publisher, $data
            ){
                $publisher->update($data);
                return $publisher;
            }
        );
    }

    public function delete(Publisher $publisher): void
    {
        // if($publisher->authors()->exists()){

        // }

        DB::transaction(
            fn() => $publisher->delete()
        );
    }

}