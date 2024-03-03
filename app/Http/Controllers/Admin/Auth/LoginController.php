<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login()
    {
        if (Auth::guard('admin')->check() && auth()->guard('admin')->user()->status == 1) {
            flash()->addSuccess('Welcome to Admin Dashboard');
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    
    function loginCheck(Request $request){
        $credentials = $request->only('email', 'password');
        $check = Admin::where('email', $request->email)->first();

        if(isset($check)){
            if($check->status == 1){
                if (Auth::guard('admin')->attempt($credentials)) {
                    flash()->addSuccess('Welcome to Admin Dashboard');
                    return redirect()->route('admin.dashboard');
                }
                flash()->addError('Invalid credentials');
            }else{
                flash()->addError('Your account has been disabled. Please contact support.');
            }
        }else{
            flash()->addError('Admin Not Found');
        }
        return redirect()->route('admin.login');
    }
}
