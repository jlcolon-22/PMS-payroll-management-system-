<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
        User::create([
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('admin123')
        ]);

        Deduction::create();
        $dep = Department::create([
            'dep_name'=>'IT Department'
        ]);

        $pos = Position::create([
            'dep_id'=>$dep->id,
            'pos_name'=>'WEB Developer'
        ]);
    }
}
