<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UsersProduct;
class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'category_id',
        'supplier_id',
        'manufacturer_id',
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
        return $this->hasMany(Asset::class, 'product_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function usersProducts()
    {
        return $this->hasMany(UsersProduct::class);
    }

    public function supplier()
{
    return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
}

public function manufacturer()
{
    return $this->belongsTo(Manufacturers::class, 'manufacturer_id', 'id');
}

}
