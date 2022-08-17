<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    //

    public function index()
    {
        return view('admin.employee');
    }

    public function departments()
    {
        $data = Department::with('positions')->get();

        return response()->json($data, 200);
    }

    public function store(Request $req)
    {
        $req->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'location'=>'required',
            'number'=>'required',
            'email'=>'required|unique:employees',
            'salary'=>'required',
            'photo'=>'required',
            'departmentName'=>'required',
            'positionName'=>'required',
        ]);
        $image = time().'.'.$req->photo->extension();
        $data = Employee::create([
            'firstname'=>ucfirst($req->firstname),
            'middlename'=>ucfirst($req->middlename),
            'lastname'=>ucfirst($req->lastname),
            'location'=>ucfirst($req->location),
            'number'=>$req->number,
            'email'=>$req->email,
            'salary'=>$req->salary,
            'photo'=>$image,
            'dep_id'=>$req->departmentName,
            'pos_id'=>$req->positionName,
        ]);
       if($data)
       {
         $req->photo->move('employees-image',$image);
         return response()->json('success', 201);
       }
    }

    public function employees()
    {
        $data = Employee::with('department')->with('position')->paginate(4);

        return response()->json($data, 200);
    }

    public function update(Request $req ,$id)
    {
        $req->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'location'=>'required',
            'number'=>'required',
            'email'=>'required',
            'salary'=>'required',
            'departmentName'=>'required',
            'positionName'=>'required',
        ]);
        // return response()->json($req->all(), 200);
        if($req->photo == null)
        {
           $image = $req->oldphoto;
        }else{
            $image = time().'.'.$req->photo->extension();
        }
        $data = Employee::whereRaw('id = ?',$id)->update([
            'firstname'=>ucfirst($req->firstname),
            'middlename'=>ucfirst($req->middlename),
            'lastname'=>ucfirst($req->lastname),
            'location'=>ucfirst($req->location),
            'number'=>$req->number,
            'email'=>$req->email,
            'salary'=>$req->salary,
            'photo'=>$image,
            'dep_id'=>$req->departmentName,
            'pos_id'=>$req->positionName,
        ]);

        if($data)
        {
            if($req->photo != null)
            {
                if (File::exists('employees-image/'.$req->oldphoto)) {
                    unlink('employees-image/'.$req->oldphoto);
                }
               
                $req->photo->move('employees-image',$image);
               
            }

            return response('success',200);
        }
    }

    public function destroy($id)
    {
        $user = Employee::whereRaw('id = ?',$id)->first();
        if (File::exists('employees-image/'.$user->photo)) {
            unlink('employees-image/'.$user->photo);
        }
        $user->delete();
        return response()->json('success', 200);
    }
}
