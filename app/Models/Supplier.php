<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Supplier extends Model
{

    protected $fillable = [
        'supplier_name',
        ];

        use HasFactory;

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class, 'supplier_id', 'id');
    }


}
