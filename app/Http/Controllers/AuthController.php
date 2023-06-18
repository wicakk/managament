<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // public function register()
    // {
    //     return view('register');
    // } 

    // public function registerPost(Request $request)
    // {
    //     $user = new User();

    //     $user->name= $request->name;
    //     $user->email= $request->email;
    //     $user->password= Hash::make($request->password);

    //     $user->save();
    //     return back()->with('success', 'Register Successfully');
    // }

    public function login()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {
       $credetials =[
        'email' => $request->email,
        'password' => $request->password,
       ];
       if(Auth::attempt($credetials)){
            $data = DB::table('profile')->where('user_id', Auth::user()->id)->first();
            $role = '';
            if(isset($data->role)){
                $role = $data->role;
            }
            $request->session()->put('role',$role);

            return redirect('/dashboard')->with('success', 'login success');
       }
       
       return back()->with('error', 'Akun tidak ditemukan');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
