<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'url',
        'support_url',
        'warranty_lookup_url',
        'support_phone',
        'support_email',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public function licences()
{
    return $this->hasMany(Licence::class, 'manufacturer_id', 'id');
}

}
