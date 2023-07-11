<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $id = Auth::user()->id;

        if(in_array(Session::get('role'),['PM',''])){
            $hari_ini = DB::table('project_detail')
            // ->where('assigned_to',$id)
            ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.created_by as qa_by','project_test.tested_by as tested','project_detail.id as pid')
            ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
            ->whereDate('project_test.created_at', Carbon::today())->get();
            $gagal = DB::table('project_detail')->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.created_by as qa_by','project_test.tested_by as tested','project_detail.id as pid')
            ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
            // ->where('assigned_to',$id)
            ->whereDate('project_test.created_at', Carbon::today())
            ->where('actual_result_qa','Fail')->get();
        }else{
            $hari_ini = DB::table('project_detail')
            ->where('assigned_to',$id)
            ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.created_by as qa_by','project_test.tested_by as tested','project_detail.id as pid')
            ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
            ->whereDate('project_test.created_at', Carbon::today())->get();
            $gagal = DB::table('project_detail')->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.created_by as qa_by','project_test.tested_by as tested','project_detail.id as pid')
            ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
            // ->where('assigned_to',$id)
            ->whereDate('project_test.created_at', Carbon::today())
            ->where('actual_result_qa','Fail')->get();
        }

        return view('dashboard', compact('project','user','task','uat','hari_ini','gagal'));
    }
}
