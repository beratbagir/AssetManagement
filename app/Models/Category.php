<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class Category extends Model
{
    use HasFactory;

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'type',
        'warehouse_occupancy',
        'last_update_date',
        'quantity',
        'progress',
    ]
}
