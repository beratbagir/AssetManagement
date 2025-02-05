<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
use App\Models\UsersProduct;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'company_id'];
    public $timestamps = false;
    public function company()
    {
        return $this->belongsTo(Companies::class);  // Company modeline bağlı
    }
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    // Status Scope
    public function scopeFilterByCompany($query, $company_id)
    {
        if (!empty($company_id)) {
            return $query->where('company_id', $company_id);
        }
        return $query;
    }

    public function scopeSortBy($query, $sort, $direction)
    {
        $sortableColumns = ['name', 'company_id'];

        // Eğer sıralama sütunu desteklenenlerden biriyse, sıralama uygula
        if (in_array($sort, $sortableColumns)) {
            return $query->orderBy($sort, $direction);
        }

        // Varsayılan sıralama
        return $query->orderBy('name', $direction); // Default sıralama
    }



    public function userproduct()
    {
        return $this->belongsTo(UsersProduct::class);  // UsersProduct modeline bağlı
    }
}
