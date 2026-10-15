<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Genre extends Model
{

    protected $fillable = [
        'genre_name',
        ];

        use HasFactory;

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_genre')->using(BookGenre::class)->withTimestamps();
    }
   
}
