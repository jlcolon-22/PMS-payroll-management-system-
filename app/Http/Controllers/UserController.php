<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logging(Request $req)
    {
       if(Auth::attempt(['username' => $req->username, 'password' => $req->password]))
       {
            $req->session()->regenerate();
            return response('success');
       }else{
            return response()->json('error',401);
       }
    }

    public function loggingout(Request $req)
    {
     $req->session()->invalidate();
     $req->session()->regenerateToken();

     Auth::logout();

     return redirect('/');
    }
}
