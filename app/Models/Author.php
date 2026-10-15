<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Author extends Model
{
    protected $fillable = [
        'publisher_id',
        'name'
        ];

        use HasFactory;

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }


    public function profile(): HasOne
    {
        return $this->hasOne(AuthorProfile::class, 'author_id', 'id');
    }
 
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
   
}
