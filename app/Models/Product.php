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
        'product_name',
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

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('product_name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    public function scopeSortByProductName($query, $direction = 'asc')
    {
        return $query->orderBy('product_name', $direction);
    }

    /**
     * Scope a query to sort by support expire date.
     */
    public function scopeSortBySupportExpireDate($query, $direction = 'asc')
    {
        return $query->orderBy('support_expire_date', $direction);
    }

    /**
     * Scope a query to sort by purchase date.
     */
    public function scopeSortByPurchaseDate($query, $direction = 'asc')
    {
        return $query->orderBy('purchase_date', $direction);
    }

    /**
     * Scope a query to sort by cost.
     */
    public function scopeSortByCost($query, $direction = 'asc')
    {
        return $query->orderBy('cost', $direction);
    }

    
    public function scopeFilterByCategory($query, $category_id)
    {
        if (!empty($category_id)) {
            return $query->where('category_id', $category_id);
        }
        return $query;
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
