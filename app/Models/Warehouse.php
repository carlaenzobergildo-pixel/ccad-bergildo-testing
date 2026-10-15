<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Warehouse extends Model
{

    protected $fillable = [
        'supplier_id',
        'location',
        ];

        use HasFactory;

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }


    public function manager(): HasOne
    {
        return $this->hasOne(Manager::class, 'warehouse_id', 'id');
    }


}
