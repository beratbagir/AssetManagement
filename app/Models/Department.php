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

    public function userproduct()
    {
        return $this->belongsTo(UsersProduct::class);  // UsersProduct modeline bağlı
    }
}
