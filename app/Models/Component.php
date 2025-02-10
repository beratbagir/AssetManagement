<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Component extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'component';
    protected $fillable = [
        'name',
        'category_id',
        'quantity',
        'min_quantity',
        'serial',
        'manufacturer_id',
        'model_no',
        'company_id',
        'supplier_id',
        'order_number',
        'purchase_date',
        'purchase_cost',
        'description',
    ];

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturers::class);
    }

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
