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

class ProjectTestController extends Controller
{
 
    public function index(): View
    {
        $projects = DB::table('projects')->select('projects.*','users.name')
        ->leftJoin('users', 'users.id', '=', 'projects.created_by')->get();
        $users = User::all();
        // dd($projects);
        return view ('projects.index',compact('projects','users'));
    }
 
    public function store(Request $request): RedirectResponse
    {
        // dd($request->project_test_id);
        if(isset($request->project_test_id)){
            $data = [
                'uat_test_desc' => $request->uat_test_desc,
                'uat_test_detail' => $request->uat_test_detail,
                'steps_for_uat_test' => $request->steps_for_uat_test,
                'expected_result' => $request->expected_result,
                'project_detail_id' => $request->project_detail_id,
                'tested_by' => Auth::user()->id,
            ];
            DB::table('project_test')->where('id',$request->project_detail_id)->update($data);
        }else{
            $data = [
                'uat_test_desc' => $request->uat_test_desc,
                'uat_test_detail' => $request->uat_test_detail,
                'steps_for_uat_test' => $request->steps_for_uat_test,
                'expected_result' => $request->expected_result,
                'project_detail_id' => $request->project_detail_id,
                'tested_by' => Auth::user()->id,
            ];
            DB::table('project_test')->insert($data);
        }
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
 
    public function show(string $id): View
    {
        $Project = Project::find($id);
        return view('projects.show')->with('projects', $Project);
    }
 
    public function edit(string $id): View
    {
        $projects = Project::find($id);
        $users = User::all();
        return view('projects.edit',compact('projects','users'));
    }
 
    public function update(Request $request, string $id): RedirectResponse
    {
        $Project = Project::find($id);
        $penanggung_jawab = '|';
        foreach($request->pj as $item){
            $penanggung_jawab .= $item.'|';
        }
        $data = [
            'nama_project' => $request->nama_project,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'penanggung_jawab' => $penanggung_jawab,
            'created_by' => Auth::user()->id,
        ];
        $Project->update($data);
        return redirect('projects')->with('success', 'Project Updated!');
    }
 
    
    public function destroy(string $id): RedirectResponse
    {
        Project::destroy($id);
        return redirect('projects')->with('success', 'Project deleted!');
    }

    public function detail(string $id)
    {
        // $data = DB::table('projects')->select('projects.*','project_detail.*')
        // ->leftJoin('project_detail', 'project_detail.project_id', '=', 'projects.id')->get();
        $data = DB::table('project_detail')->where('project_id',$id)->get();
        $users = User::all();
        return view('projects.detail',compact('data','id','users'));
    }

    public function simpan_detail(Request $request): RedirectResponse
    {
        // dd($request);
        if(isset($request->project_test_id)){
            $data = [
                'uat_test_case' => $request->uat_test_case,
                'uat_test_description' => $request->uat_test_description,
                'uat_test_detail' => $request->uat_test_detail,
                'steps_for_uat' => $request->steps_for_uat,
                'expected_result' => $request->expected_result,
                'checklist' => $request->checklist,
                'project_detail_id' => $request->project_detail_id,
                'created_by' => Auth::user()->id,
            ];
            DB::table('project_test')->where('id',$request->project_detail_id)->update($data);
        }else{
            $data = [
                'uat_test_case' => $request->uat_test_case,
                'uat_test_description' => $request->uat_test_description,
                'uat_test_detail' => $request->uat_test_detail,
                'steps_for_uat' => $request->steps_for_uat,
                'expected_result' => $request->expected_result,
                'checklist' => $request->checklist,
                'project_detail_id' => $request->project_detail_id,
                'created_by' => Auth::user()->id,
            ];

            DB::table('project_detail')->insert($data);
            return redirect()->back()->with('success', 'Task Addedd!');
        }
    }
    public function update_detail(Request $request): RedirectResponse
    {
        $data = [
            'actual_result' => $request->actual_result,
            'result' => $request->result,
            'comments' => $request->comments,
            'tested_by' => Auth::user()->id,
        ];
        DB::table('project_detail')->where('id',$request->project_detail_id)->update($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }

    public function timeline(string $id): View
    {
        $projects = Project::find($id);
        $users = User::all();
        return view('projects.timeline',compact('projects','users'));
    }
}