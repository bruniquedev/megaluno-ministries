<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\admin;
use Session;
use DB;//import if you want to use sql commands directly
use Hash;
use Response;
use App\Mail\SendPasswordResetEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function ShowAdminLogin()
    {
        return view('auth.adminlogin');
    }  


    public function postAdminLogin(Request $request)
    {

        $salt="Oimoiumoi701310265";
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        //var_dump($credentials); die();
       // if(Auth::attempt($credentials)){ // login attempt
       //register admin guard in the config\auth.php  
        if (Auth::guard('megalunaadmin')->attempt($credentials)) {
            return redirect()->intended('manage-visitors')
                        ->withSuccess('You have Successfully loggedin');
        }

            //admin route login page redirect
       return redirect("admin")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function Logout()
    {
    
        if(Auth::guard('megalunaadmin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('megalunaadmin')->logout();
            return redirect()->route('adminlogin');
        }
    
     return redirect()->route('adminlogin');
   
    } 
    
    
    
    
    
    
   
    
    
    
    
    
    
    
    
    }
    