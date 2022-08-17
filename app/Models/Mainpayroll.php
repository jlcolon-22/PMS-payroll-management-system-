<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainpayroll extends Model
{
    use HasFactory;

    protected $fillable = ['status'];
     public function payroll()
    {
        return $this->hasMany(Payroll::class, 'mp_id','id');
    }
}
