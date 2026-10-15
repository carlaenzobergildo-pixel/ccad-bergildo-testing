<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Book extends Model
{

    protected $fillable = [
        'author_id',
        'publisher_id',
        'title',
        'slug',
        'isbn',
        'price',
        'description',
        'image',
    ];

    use HasFactory;

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }


    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }


    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id')->using(BookGenre::class)->withTimestamps();
    }


    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable', 'reviewable_type', 'reviewable_id', 'id');
    }


}
