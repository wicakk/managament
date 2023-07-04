<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        // dd(Session::get('role'));
        $project = DB::table('projects')->count();
        $user = DB::table('users')->count();
        $task = DB::table('project_test')->count();
        $uat = DB::table('project_detail_uat')->count();
        return view('dashboard', compact('project','user','task','uat'));
    }
}
