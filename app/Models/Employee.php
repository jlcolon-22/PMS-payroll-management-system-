<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','middlename','location','number','email','salary','pos_id','dep_id','photo'];

  
    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'pos_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'emp_id', 'id');
    }

    public function payroll()
    {
        return $this->hasMany(Payroll::class, 'emp_id', 'id');
    }

    // public function mainpayroll()
    // {
    //     return $this->belongsTo(Mainpayroll::class, 'emp_id');
    // }
}
