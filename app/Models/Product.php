<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{

    protected $fillable = [
        'prod_name',
        'price'
        ];

        use HasFactory;

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
   
}
