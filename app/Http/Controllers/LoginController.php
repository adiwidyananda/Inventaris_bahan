<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Admin;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    function checklogin(Request $request)
    {
    $Username = $request->username;
    $password = $request->password;
  

     $data = Admin::where('Username',$Username)->first();
        if($data){ 
            if(Hash::check($password,$data->Password)){
                Session::put('id',$data->id);
                Session::put('username',$data->Username);         
            return redirect('kategori');
            }else{
                Session::flash('message', 'Password Salah'); 
                return view('login');
            }
        }else{
            Session::flash('message', 'Username Salah'); 
            return view('login');
        }
    }
    public function logout(){
        Session::flush();
        Session::flash('message', 'Anda sudah logout');
        return redirect('');
    }
}
