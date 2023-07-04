<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Project_Detail;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

// use Carbon\Carbon;

class LaporanController extends Controller
{
 
    public function task()
    {
        $user_id = Auth::user()->id;
        $projects = DB::table('projects')->select('projects.*','users.name')
        ->leftJoin('users', 'users.id', '=', 'projects.created_by')
        // ->where('penanggung_jawab','LIKE','%|'.$user_id.'|%')
        ->get();
        $users = User::all();
        // dump($projects);
        return view ('laporan.task.index',compact('projects','users'));
    }

    public function taskdetail(string $id)
    {
        $data = DB::table('project_detail')
        ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_id',$id)
        ->get();
        // dump($data);
        $users = User::all();
        return view('laporan.task.detail',compact('data','id','users'));
    }
    public function test()
    {
        $user_id = Auth::user()->id;
        $projects = DB::table('projects')->select('projects.*','users.name')
        ->leftJoin('users', 'users.id', '=', 'projects.created_by')
        // ->where('penanggung_jawab','LIKE','%|'.$user_id.'|%')
        ->get();
        $users = User::all();
        // dump($projects);
        return view ('laporan.test.index',compact('projects','users'));
    }

    public function testdetail(string $id)
    {
        $data = DB::table('project_detail')
        ->select('project_detail.*'
        ,'project_test.id as project_test_id',
        'project_test.uat_test_case',
        'project_test.uat_test_desc',
        'project_test.uat_test_detail',
        'project_test.steps_for_uat_test',
        'project_test.expected_result',
        'project_test.result',
        'project_test.comments',
        'project_test.actual_result',
        'project_test.url_test',
        'project_test.file_test',
        'project_test.tested_by')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        // ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_id',$id)
        ->get();
        $users = User::all();
        return view('laporan.test.detail',compact('data','id','users'));
    }
 
    
}