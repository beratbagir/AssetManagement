<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;
    protected  $fillable = ['name', 'email', 'phone', 'address' , 'city', 'state', 'zip', 'country', 'contact_person'];

    public function licences()
    {
        return $this->hasMany(Licence::class, 'supplier_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
