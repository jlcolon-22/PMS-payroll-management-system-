<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('admin.position');
    }

    public function departments()
    {
        $data = Department::all();

        return response()->json($data,200);
    }

    public function store(Request $req)
    {
        $pos = Position::create([
            'dep_id'=>$req->departmentName,
            'pos_name'=>$req->positionName
        ]);

        if($pos)
        {
            return response('success',201);
        }
    }

    public function positions()
    {
        $data = Position::with('departments')->paginate(10);

        return response()->json($data,200);
    }

    public function destroy($id)
    {
        $del = Position::where('id','=',$id)->delete();

        if($del)
        {
             return response()->json('success', 200);
        }
    }

    public function update(Request $req,$id)
    {
        $pos = Position::where('id','=',$id)->update([
            'dep_id'=>$req->departmentName,
            'pos_name'=>$req->positionName
        ]);

        if($pos)
        {
            return response('success',200);
        }
    }
}
