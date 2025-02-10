<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $primaryKey = 'licence_id';

    protected $fillable = [
        'product_id',
        'licence_key',
        'expiration_date',
        'supplier_id',
        'cost',
        'status'
    ];

    protected $casts = [
        'expiration_date' => 'date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('cost', 'like', '%' . $search . '%');
        }
        return $query;
    }

    
    public function scopeFilterByLicence($query, $licence_id)
    {
        if (!empty($licence_id)) {
            return $query->where('licence_id', $licence_id);
        }
        return $query;
    }

    public function scopeFilterByStatus($query, $status)
    {
        if (!empty($status)) {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopeSortBy($query, $sort, $direction)
    {
        $sortableColumns = ['licence_id', 'licence_key', 'cost', 'expiration_date', 'status', 'product_id'];

        if (in_array($sort, $sortableColumns)) {
            return $query->orderBy($sort, $direction);
        }

        return $query->orderBy('licence_id', $direction); 
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'licence_id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'licence_supplier', 'supplier_id', 'id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturers::class, 'manufacturer_id', 'id');
    }
}


