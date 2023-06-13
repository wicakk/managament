<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        // dd(Session::get('role'));
        return view('dashboard');
    }
}
