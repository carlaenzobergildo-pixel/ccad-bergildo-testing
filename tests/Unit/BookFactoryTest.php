<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookFactoryTest extends TestCase
{
    public function test_it_generates_a_slug_from_the_title(): void
    {
        $attributes = Book::factory()->definition();

        $this->assertSame(Str::slug($attributes['title']), $attributes['slug']);
    }
}
