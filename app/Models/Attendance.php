<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['emp_id','time_in','created_at','in_status','out_status'];

    public $timestamps = false;

    
  
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
