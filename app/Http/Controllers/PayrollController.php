<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Deduction;
use App\Models\Mainpayroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        return view('admin.payroll');
    }

    public function payrolls()
    {
        $data = Mainpayroll::with('payroll')->orderBy('id','desc')->paginate(10);
        // $payroll = Attendance::selectRaw('*, count(*) AS count')
        //                     ->whereBetween('created_at',['2022-1-9','2022-31-9'])
        //                     ->groupBy('emp_id')
        //                     ->get();

        return response()->json($data);
    }

    public function store(Request $req)
    {
        // date now
        $now = explode(' ',explode('T',Carbon::now())[0])[0];

        // payroll
        $payroll = Attendance::selectRaw('*, count(*) AS count')
                            ->whereBetween('created_at',[$req->from,$req->to])
                            ->groupBy('emp_id')
                            ->get();
        $employees = Employee::all();
        $arr = array();
   
        // foreach($payroll as $key => $val)
        // {
        //     $pay = $employees->filter(function($value, $key) use ($val){
        //         return $value->id == $val->emp_id;
                 
        //     })->map(function($value){
        //         return $value->salary;
        //     });
        //     $x = (int)$pay[$key] / 22;
        //     array_push($arr, $x);
   
        // }
        // return response($arr);
        // deduction
        $deduction = Deduction::first();

        // compute days
        $start = Carbon::parse($req->from);
        $end = Carbon::parse($req->to);
        $length = $end->diffInDays($start);


        
        if ($req->type == '1') {
            if ($length == 14 || $length == 15 || $length == 16) {
                $Mainpayroll = Mainpayroll::create();
               foreach ($payroll as $key => $value)
                    {

                            $pay = $employees->filter(function($values, $key) use ($value){
                                return $values->id == $value->emp_id;
                                 
                            })->map(function($values){
                                return $values->salary;
                            });
                            $x = (int)$pay[$key] / 22;
                            //sss deduction base on salary per month 
                            $sss = ((int)$deduction->sss / 100 ) * (11 * round($x,2));

                            // compute total payroll of employee
                            $user = ((11 * round($x,2)) / (11 / $payroll[$key]->count) - $sss) - (int)$deduction->pag_ibig;
                            
                            Payroll::create([
                                'emp_id'=>$value->emp_id,
                                'mp_id'=>$Mainpayroll->id,
                                'salary'=>(11 * $x),
                                'sss'=>$deduction->sss,
                                'pag_ibig'=>$deduction->pag_ibig,
                                'total'=>round($user,2),
                                'payroll_date'=>$req->from.' '.'TO'.' '.$req->to,
                                'attendance'=>$payroll[$key]->count,
                                'type'=>true,
                                'created_at'=>$now
                            ]);
                    }

                return response()->json('success',201);
            }else{
                return response()->json('only 15 and 16 days');
                
            }
        }
        else if($req->type == '0')
        {
            if ($length == 31 || $length == 30) {
                 $Mainpayroll = Mainpayroll::create(
                  [  'status'=> false]
                );
                    foreach ($payroll as $key => $value)
                    {

                            $pay = $employees->filter(function($values, $key) use ($value){
                                return $values->id == $value->emp_id;
                                 
                            })->map(function($values){
                                return $values->salary;
                            });
                            $x = (int)$pay[$key] / 22;

                            //sss deduction base on salary per month 
                            $sss = ((int)$deduction->sss / 100 ) * (22 * round($x,2));

                            // compute total payroll of employee
                            $user = ((22 * round($x,2)) / (22 / $payroll[$key]->count) - $sss) - (int)$deduction->pag_ibig;
                            
                            Payroll::create([
                                'emp_id'=>$value->emp_id,
                                'mp_id'=>$Mainpayroll->id,
                                'salary'=>(22 * $x),
                                'sss'=>$deduction->sss,
                                'pag_ibig'=>$deduction->pag_ibig,
                                'total'=>round($user,2),
                                'payroll_date'=>$req->from.' '.'TO'.' '.$req->to,
                                'attendance'=>$payroll[$key]->count,
                                'created_at'=>$now
                            ]);
                           
                    }
                      return response()->json('success',201);
            }else{
                return response()->json('only 30 and 31 days');
            }
        }
  
        return response()->json($req->all());
    }

    public function employees()
    {
        $data = Employee::all();

        return response()->json($data);
    }

    public function destroy($id)
    {
        Mainpayroll::whereRaw('id = ?',$id)->delete();
        return response('success');
    }
}
