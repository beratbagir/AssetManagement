<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function departments()
    {
        return $this->hasMany(Department::class); 
    }

    public function scopeSortBy($query, $sort, $direction)
    {
        $sortableColumns = ['name'];

        if (in_array($sort, $sortableColumns)) {
            return $query->orderBy($sort, $direction);
        }
        
        return $query->orderBy('name', $direction); 
    }
}
