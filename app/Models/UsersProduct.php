<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersProduct extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'department_id',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');   
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
