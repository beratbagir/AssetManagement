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
        return $this->hasMany(Department::class);  // Department modeline bağlı
    }

    public function scopeSortBy($query, $sort, $direction)
    {
        $sortableColumns = ['name'];

        // Eğer sıralama sütunu desteklenenlerden biriyse, sıralama uygula
        if (in_array($sort, $sortableColumns)) {
            return $query->orderBy($sort, $direction);
        }
        
        // Varsayılan sıralama
        return $query->orderBy('name', $direction); // Default sıralama
    }
}
