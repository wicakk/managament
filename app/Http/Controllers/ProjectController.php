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

class ProjectController extends Controller
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
        $data = DB::table('project_detail')->where('project_id',$id)->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')->get();
        $users = User::all();
        return view('projects.detail',compact('data','id','users'));
    }

    public function simpan_detail(Request $request): RedirectResponse
    {
        // dd($request);
        $data = [
            'task_name' => $request->task_name,
            'assigned_to' => $request->assigned_to,
            'due_dates' => $request->due_dates,
            'category' => $request->category,
            'description' => $request->description,
            'checklist' => $request->checklist,
            'project_id' => $request->project_id,
            'created_by' => Auth::user()->id,
        ];
        DB::table('project_detail')->insert($data);
        return redirect()->back()->with('success', 'Task Addedd!');
    }
    public function edit_detail(string $id): View
    {
        $data = Project_Detail::find($id);
        $users = User::all();
        return view('modal_content.edit_task',compact('data','users'));
    }
    public function update_detail(Request $request): RedirectResponse
    {
        $data = [
            'task_name' => $request->task_name,
            'assigned_to' => $request->assigned_to,
            'due_dates' => $request->due_dates,
            'category' => $request->category,
            'description' => $request->description,
            'checklist' => $request->checklist,
            'created_by' => Auth::user()->id,
            'updated_at' => now(),
        ];
        DB::table('project_detail')->where('id',$request->project_detail_id)->update($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
    public function status_timeline($jenis, $id)
    {
        $data = '';
        if($jenis == 'terima'){
            $data = [
                'status' => '1',
                'updated_by' => Auth::user()->id,
                'updated_at' => now(),
            ];
        }else{
            $data = [
                'status' => '2',
                'updated_by' => Auth::user()->id,
                'updated_at' => now(),
            ];
        }
        DB::table('project_timeline')->where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }

    public function timeline(string $id): View
    {
        $projects = Project::find($id);
        $users = User::all();

        $plan = DB::table('project_timeline')->where('project_id',$id)->whereNull('status')->orWhere('status','1')->get();
        $status_plan = DB::table('project_timeline')->where('project_id',$id)->where('status','1')->first();
        // dump($plan);
        return view('projects.timeline',compact('projects','users','id','plan','status_plan'));
    }
    public function planning_store(Request $request): RedirectResponse
    {
        // dd($request);
        $error = "";
        $file_name= '';
        if($request->hasFile('file')){
            $semua_file = "";
            // foreach($request->file as $file){
                // dd($file->getClientMimeType());
            $file= $request->file;
                if(in_array($file->getClientMimeType(),['image/jpg','image/jpeg','image/png','image/svg','application/zip','application/xls','application/xlsx','application/docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/pdf'])){
                    $file_name = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    // $name = Auth::user()->pegawai_id;
                    $file->move(public_path('document_timeline/'), $file_name);
                    // array_push($nama_file_surat, $file_name);
                }else{
                    $error .= $file->getClientOriginalName()."File anda tidak dapat kami simpan cek kembali extensi dan besar filenya"."<br>";
                }
            // }
            // dd($nama_file_surat);
            if($error !== ""){
                return Redirect::back()->with(['error' => $error]);
            }
        }
        $data = [
            'desc_timeline' => $request->desc_timeline,
            'project_id' => $request->project_id,
            'jenis_timeline' => 'planning',
            'file_upload' => $file_name,
            'created_by' => Auth::user()->id,
            'created_at' => now(),
        ];
        DB::table('project_timeline')->insert($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
        // dd($data);
        // $data = [
        //     'actual_result' => $request->actual_result,
        //     'result' => $request->result,
        //     'comments' => $request->comments,
        //     'project_detail_id' => $request->project_detail_id,
        //     'tested_by' => Auth::user()->id,
        // ];
        // DB::table('project_detail')->where('id',$request->project_detail_id)->update($data);
    }
}