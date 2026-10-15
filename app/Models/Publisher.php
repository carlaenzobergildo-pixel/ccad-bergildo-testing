<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Publisher extends Model
{
    protected $fillable = [
        'publisher_name',
        ];

        use HasFactory;

    public function authors(): HasMany
    {
        return $this->hasMany(Author::class, 'publisher_id', 'id');
    }


    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'publisher_id', 'id');
    }
}
