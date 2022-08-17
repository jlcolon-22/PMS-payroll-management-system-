<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['dep_id','pos_name'];

    public function departments()
    {
       
            return $this->belongsTo(Department::class,'dep_id');
        
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'pos_id','id');
    }

     public function mainpayroll()
    {
        return $this->hasMany(Mainpayroll::class, 'mp_id', 'id');
    }
}
