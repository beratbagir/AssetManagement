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
        return $this->belongsTo(Companies::class);  
    }
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }

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

        if (in_array($sort, $sortableColumns)) {
            return $query->orderBy($sort, $direction);
        }

        return $query->orderBy('name', $direction); 
    }



    public function userproduct()
    {
        return $this->belongsTo(UsersProduct::class);  
    }
}
