<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.department');
    }

    public function store(Request $req)
    {
        $dep = Department::create([
            'dep_name'=>$req->departmentName
        ]);

        if($dep)
        {
            return response()->json('success',201);
        }
    }

    public function departments()
    {
        $data = Department::paginate(10);
        return response()->json($data,200);
    }

    public function destroy($id)
    {
        $del = Department::where('id','=',$id)->delete();

        if($del)
        {
            return response('success',200);
        }
        
    }

    public function update(Request $req, $id)
    {
        $dep = Department::where('id','=',$id)->update([
            'dep_name'=>$req->departmentName
        ]);

        if($dep)
        {
            return response()->json('success',200);
        }
    }
}
