<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable =['dep_name'];

    public function positions()
    {
       return $this->hasMany(Position::class, 'dep_id', 'id');
        
    }
    public function employee()
    {
        return $this->hasOne(Employee::class, 'dep_id','id');
    }
}
