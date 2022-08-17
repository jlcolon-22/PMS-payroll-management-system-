<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function employees()
    {
        $data = Employee::all()->count();

        return response()->json($data, 200);
    }

    public function attendances()
    {
        
        $now = explode(' ',explode('T',Carbon::today())[0])[0];
        $data = Attendance::whereRaw('created_at = ? ',$now)->get();
        return response()->json($data);
    }
}
