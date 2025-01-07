<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'brand',
        'type',
        'support_expire_date',
        'purchase_date',
        'cost'
    ];

    protected $dates = [
        'support_expire_date',
        'purchase_date'
    ];

    public function licences()
    {
        return $this->hasMany(Licence::class, 'product_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'product_id');
    }
}
