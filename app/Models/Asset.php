<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $primaryKey = 'asset_id';
    public $timestamps = false;

    protected $fillable = [
        'asset_name',
        'product_id',
        'licence_id',
        'serial_number',
        'quantity',
        'status',
        'assigned_to',
        'notes'
    ];

    

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('asset_name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    // Status Scope
    public function scopeFilterByStatus($query, $status)
    {
        if (!empty($status)) {
            return $query->where('status', $status);
        }
        return $query;
    }

    // Product Scope
    public function scopeFilterByProduct($query, $productId)
    {
        if (!empty($productId)) {
            return $query->where('product_id', $productId);
        }
        return $query;
    }

    // Assigned To Scope
    public function scopeFilterByAssignedTo($query, $assignedTo)
    {
        if (!empty($assignedTo)) {
            return $query->where('assigned_to', $assignedTo);
        }
        return $query;
    }

    public function scopeSortBy($query, $sort, $direction)
    {
        $sortableColumns = ['asset_name', 'product_id', 'licence_id', 'serial_number', 'quantity', 'status', 'assigned_to', 'brand'];

        // Eğer sıralama sütunu desteklenenlerden biriyse, sıralama uygula
        if (in_array($sort, $sortableColumns)) {
            if ($sort === 'asset_name') {
                return $query->orderByRaw('LEFT(asset_name, 1) ' . $direction); // asset_name için özel sıralama
            }
            return $query->orderBy($sort, $direction);
        }
        
        // Varsayılan sıralama
        return $query->orderBy('asset_id', $direction); // Default sıralama
    }


    public function licence()
    {
        return $this->belongsTo(Licence::class, 'licence_id');
    }

    public function getFullNameAttribute()
    {
        return $this->product->name . ' - ' . $this->licence->licence_key;
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
