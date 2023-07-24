<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Project_Detail;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
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
    public function project()
    {
        $user_id = Auth::user()->id;
        $projects = DB::table('projects')->select('projects.*','users.name')
        ->leftJoin('users', 'users.id', '=', 'projects.created_by')
        // ->where('penanggung_jawab','LIKE','%|'.$user_id.'|%')
        ->get();
        $users = User::all();
        // dump($projects);
        return view ('laporan.project.index',compact('projects','users'));
    }

    public function taskdetail(string $id)
    {
        $data = DB::table('project_detail')
        // ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa')
        ->select('project_detail.*'
        ,'project_test.id as project_test_id',
        'project_test.uat_test_case',
        'project_test.uat_test_desc',
        'project_test.uat_test_detail',
        'project_test.steps_for_uat_test',
        'project_test.expected_result',
        'project_test.result',
        'project_test.comments',
        'project_test.comments_qa',
        'project_test.actual_result',
        'project_test.actual_result_qa',
        'project_test.result_qa',
        'project_test.url_test',
        'project_test.file_test',
        'project_test.tested_by')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_id',$id)
        ->get();

        $project = Project::find($id);
        // dump($data);
        $users = User::all();
        return view('laporan.task.detail',compact('data','id','users','project'));
    }
    public function taskcetak(string $id)
    {
        $data = DB::table('project_detail')
        // ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa')
        ->select('project_detail.*'
        ,'project_test.id as project_test_id',
        'project_test.uat_test_case',
        'project_test.uat_test_desc',
        'project_test.uat_test_detail',
        'project_test.steps_for_uat_test',
        'project_test.expected_result',
        'project_test.result',
        'project_test.comments',
        'project_test.comments_qa',
        'project_test.actual_result',
        'project_test.actual_result_qa',
        'project_test.result_qa',
        'project_test.url_test',
        'project_test.file_test',
        'project_test.tested_by')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_id',$id)
        ->get();
        $project = Project::find($id);
        // dd($data);
        // $details =['data' => $data];
        // $pdf = PDF::loadView('laporan.task.cetak', $details);
        // $pdf = PDF::loadView('laporan/task/cetak', array('data' =>  $data))->setPaper('a4', 'portrait');
        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('laporan.task.cetak', compact('data','project'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->dowload('test.pdf');
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
        'project_test.created_at as dibuat',
        'project_test.url_test',
        'project_test.file_test',
        'project_test.tested_by')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        // ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_id',$id)
        ->whereNotNull('uat_test_case')
        ->get();
        // dd($data);
        $project = Project::find($id);
        $users = User::all();
        return view('laporan.test.detail',compact('data','id','users','project'));
    }
    public function testcetak(string $id)
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
        'project_test.created_at as dibuat',
        'project_test.actual_result',
        'project_test.url_test',
        'project_test.file_test',
        'project_test.tested_by')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_id',$id)
        ->whereNotNull('uat_test_case')
        ->get();
        $project = Project::find($id);
        // dd($data);
        // $details =['data' => $data];
        // $pdf = PDF::loadView('laporan.task.cetak', $details);
        // $pdf = PDF::loadView('laporan/task/cetak', array('data' =>  $data))->setPaper('a4', 'portrait');
        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('laporan.test.cetak', compact('data','project'))->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return $pdf->dowload('test.pdf');
    }
 
    
}