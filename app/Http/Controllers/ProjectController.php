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

class ProjectController extends Controller
{
 
    public function index(): View
    {
        $projects = DB::table('projects')->select('projects.*','users.name')
        ->leftJoin('users', 'users.id', '=', 'projects.created_by')->get();
        $users = User::all();
        return view ('projects.project',compact('projects','users'));
    }
 
    public function store(Request $request): RedirectResponse
    {
        // $input = $request->all();
        // dd($input);
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
        Project::create($data);
        return redirect('projects')->with('success', 'Project Addedd!');
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
        return view('projects.detail',compact('data','id'));
    }

    public function simpan_detail(Request $request): RedirectResponse
    {
        $data = [
            'uat_test_case' => $request->uat_test_case,
            'uat_test_desc' => $request->uat_test_desc,
            'uat_test_detail' => $request->uat_test_detail,
            'steps_for_uat_test' => $request->steps_for_uat_test,
            'expected_result' => $request->expected_result,
            'project_id' => $request->project_id,
            'created_by' => Auth::user()->id,
        ];
        DB::table('project_detail')->insert($data);
        return redirect()->back()->with('success', 'UAT Addedd!');
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
}