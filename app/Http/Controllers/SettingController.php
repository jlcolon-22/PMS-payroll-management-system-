<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deduction;
class SettingController extends Controller
{
    
    public function index()
    {
        return view('admin.setting');
    }

    public function deduction()
    {
        $data = Deduction::get();

        return response()->json($data);
    }

    public function update(Request $req,$id)
    {
        $data = Deduction::whereRaw('id = ?',$id)->update([
            'pag_ibig'=>$req->pag_ibig,
            'sss'=>$req->sss
        ]);

        return response('success');
    }
}
