<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = ['total','salary','pag_ibig','sss','payroll_date','attendance','created_at','emp_id','type','mp_id'];

     public $timestamps = false;



    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

      public function mainpayroll()
    {
        return $this->belongsTo(Mainpayroll::class, 'mp_id');
    }

}
