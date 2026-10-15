<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BookGenre extends Pivot
{
    protected $table = 'book_genre';
    public $incrementing = true;


    protected $fillable = [
        'book_id',
        'genre_id',
    ];

    use HasFactory;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }


    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }
   
}
