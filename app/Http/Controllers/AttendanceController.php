<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('admin.attendance');
    }

    public function scan()
    {
        return view('admin.scan');
    }

    public function store(Request $req)
    {
        $req->validate([
            'emp_id'=>'required',
            'type'=>'required',
            'dateTime'=>'required',

        ]);
        $time = explode('T',$req->dateTime)[1];
        $date = explode('T',$req->dateTime)[0];
        $h = explode(':',$time)[0];
        $m = explode(':',$time)[1];
        $hm =$h.'.'.$m;

        $atten = Attendance::whereRaw('emp_id = ?',$req->emp_id)->whereRaw('created_at = ?',$date)->first();
        
        if($atten == null && $req->type == '1')
        {
            return response()->json('TIME IN FIRST', 206);
        }
        if($req->type == '1')
        {
                if((float)$hm > 17.00)
                {
                    $status = false;
                }else{
                    $status = true;
                }
            if($atten->time_out == null)
            {
                Attendance::whereRaw('emp_id = ?',$req->emp_id)->whereRaw('created_at = ?',$date)->update([
                'time_out'=>$time,
                'out_status'=>$status
                ]);
                return response()->json('success time out',203);
            }
            return response()->json('already time out',204);

        }

        if($req->type === '0'){
           if(!$atten)
           {
                if((float)$hm > 8.00)
                {
                    $status = false;
                }else{
                    $status = true;
                }
                Attendance::create([
                    'emp_id'=>$req->emp_id,
                    'time_in'=>$time,
                    'created_at'=>$date,
                    'in_status'=>$status
                ]);
                return response()->json('time in Successfully',201);
           }
           return response()->json('Time in already', 202);
        }
      

        
        
    }

    public function attendances()
    {
        $data = Attendance::with('employee')->orderBy('id','desc')->paginate(10);

        return response()->json($data, 200);
    }

    public function update(Request $req,$id)
    {
        $time = explode('T',$req->time_in)[1];
        $timeO = explode('T',$req->time_out)[1];
        $h = explode(':',$time)[0];
        $m = explode(':',$time)[1];
        $hm =$h.'.'.$m;

    

        if((float)$hm > 8.00)
        {
            $status = false;
        }else{
            $status = true;
        }
        if ($timeO != 'null') {
            $hO = explode(':',$timeO)[0];
        $mO = explode(':',$timeO)[1];
        $hmO =$hO.'.'.$mO;
        if((float)$hmO > 17.00)
        {
            $statusO = false;
        }else{
            $statusO = true;
        }
        }

        $data = Attendance::whereRaw('id = ?',$id)->update([
            'time_in'=>$time,
            'emp_id'=>$req->emp_id,
            'in_status'=>$status,
            
        ]);
        if($timeO != 'null')
        {
            Attendance::whereRaw('id = ?',$id)->update([
            'time_out'=>$timeO,
            'out_status'=>$statusO,         
            ]);
        }
        
      
    }

    public function destroy($id)
    {
        Attendance::whereRaw('id = ?',$id)->delete();
    }
}
