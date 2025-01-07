<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $primaryKey = 'asset_id';

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

    public function licence()
    {
        return $this->belongsTo(Licence::class, 'licence_id');
    }

    public function getFullNameAttribute()
    {
        return $this->product->name . ' - ' . $this->licence->licence_key;
    }
}
