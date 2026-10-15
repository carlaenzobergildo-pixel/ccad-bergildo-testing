<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends Model
{

    protected $fillable = [
        'user_id',
        'stars',
        'comment',
        'reviewable_id',
        'reviewable_type',
    ];

    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function reviewable(): MorphTo
    {
        return $this->morphTo('reviewable', 'reviewable_type', 'reviewable_id');
    }


}
