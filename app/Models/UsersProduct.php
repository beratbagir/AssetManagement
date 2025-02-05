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

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }
    
    public function scopeFilterByDepartment($query, $department_id)
    {
        if (!empty($department_id)) {
            return $query->where('department_id', $department_id);
        }
        return $query;
    }

    public function scopeSortBy($query, $sort, $direction)
    {
        $sortableColumns = ['id', 'name'];

        // Eğer sıralama sütunu desteklenenlerden biriyse, sıralama uygula
        if (in_array($sort, $sortableColumns)) {
            return $query->orderBy($sort, $direction);
        }

        // Varsayılan sıralama
        return $query->orderBy('id', $direction); // Default sıralama
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
