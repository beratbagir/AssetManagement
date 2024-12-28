<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['id', 'product', 'status', 'asset_name', 'serial', 'assigned_user', 'pdf'];
}
