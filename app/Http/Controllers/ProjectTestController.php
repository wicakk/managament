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
use Illuminate\Support\Facades\Session;

class ProjectTestController extends Controller
{
 
    public function index(): View
    {
        $projects = DB::table('projects')->select('projects.*','users.name')
        ->leftJoin('users', 'users.id', '=', 'projects.created_by')
        ->get();
        if(Session::get('role') !== "" && Session::get('role') !== "PM"){
            $user_id = '%|'.Auth::user()->id.'|%';
            $projects = DB::table('projects')->select('projects.*','users.name')
            ->leftJoin('users', 'users.id', '=', 'projects.created_by')
            // ->whereIn('penanggung_jawab', $pj)
            ->where('penanggung_jawab','LIKE',$user_id)
            ->get();
        }
        // $projects = DB::table('projects')->select('projects.*','users.name')
        // ->leftJoin('users', 'users.id', '=', 'projects.created_by')->get();
        $users = User::all();
        // dd($projects);
        return view ('projects.index',compact('projects','users'));
    }
 
    public function store(Request $request): RedirectResponse
    {
        $error = '';
        $file_name = '';
        if($request->hasFile('file')){
            $semua_file = "";
            // foreach($request->file as $file){
                // dd($file->getClientMimeType());
            $file= $request->file;
                if(in_array($file->getClientMimeType(),['image/jpg','image/jpeg','image/png','image/svg','application/zip','application/xls','application/xlsx','application/docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/pdf'])){
                    $file_name = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    // $name = Auth::user()->pegawai_id;
                    $file->move(public_path('document_testing/'), $file_name);
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
        if(isset($request->project_test_id)){
            $data = [
                'uat_test_desc' => $request->uat_test_desc,
                'uat_test_detail' => $request->uat_test_detail,
                'steps_for_uat_test' => $request->steps_for_uat_test,
                'expected_result' => $request->expected_result,
                'project_detail_id' => $request->project_detail_id,
                'actual_result_qa' => $request->actual_result_qa,
                'result_qa' => $request->result_qa,
                'comments_qa' => $request->comments_qa,
                'url_test' => $request->url_test,
                'file_test_qa' => $file_name,
            ];
            $hasil = DB::table('project_test')->where('id',$request->project_test_id)->update($data);
            // dd($request->project_detail_id);
        }else{
            $data = [
                'uat_test_desc' => $request->uat_test_desc,
                'uat_test_detail' => $request->uat_test_detail,
                'steps_for_uat_test' => $request->steps_for_uat_test,
                'expected_result' => $request->expected_result,
                'project_detail_id' => $request->project_detail_id,
                'actual_result_qa' => $request->actual_result_qa,
                'result_qa' => $request->result_qa,
                'comments_qa' => $request->comments_qa,
                'url_test' => $request->url_test,
                'file_test_qa' => $file_name,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
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

    public function accept_test(Request $request)
    {
        // dd($request);
        $project_id = $request->project_id;
        if(isset($request->project_test[0])){
            foreach($request->project_test as $item){
                $id = $item;
                // $data = DB::select("SELECT max(uat_test_case) as nourut FROM project_test WHERE ");
                $project_test = DB::table('project_test')->select('project_test.*','project_detail.id as pid')->leftJoin('project_detail','project_detail.id','project_test.project_detail_id')->where('project_detail.project_id',$project_id)->max('uat_test_case');
                // dd($project_test);
                $urutan = (int) substr($project_test, 4, 3);
                // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                $urutan++;
                $huruf = "CMS-";
                $notis = $huruf . sprintf("%03s", $urutan);
                // dump($notis);
                $data = [
                    'uat_test_case' => $notis,
                ];
                DB::table('project_test')->where('id',$id)->update($data);
            }

        }
        // $data = '';
        return redirect()->back()->with('success', 'Tested Addedd!');
    }

    public function uat_test()
    {
        $id = '|'.Auth::user()->id.'|';
        $data = DB::table('projects')
        ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.result','project_test.actual_result','project_test.file_test','project_test.comments')
        ->leftJoin('project_detail', 'projects.id', '=', 'project_detail.project_id')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('projects.penanggung_jawab','LIKE','%'.$id.'%')
        ->whereNotNull('project_test.uat_test_case')->get();
        $users = User::all();
        // dd($data);
        return view ('projects.uat',compact('data','users'));
    }
    public function store_uat(Request $request)
    {
        $id = Auth::user()->id;
        $file_name = '';
        $error = '';
        if($request->hasFile('file')){
            $semua_file = "";
            // foreach($request->file as $file){
                $file= $request->file;
                // dd($file->getClientMimeType());
                if(in_array($file->getClientMimeType(),['video/webm','image/jpg','image/jpeg','image/png','image/svg','application/zip','application/xls','application/xlsx','application/docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/pdf'])){
                    $file_name = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
                    // $name = Auth::user()->pegawai_id;
                    $file->move(public_path('document_testing/'), $file_name);
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
            'actual_result' => $request->actual_result,
            'result' => $request->result,
            'comments' => $request->comments,
            'file_test' => $file_name,
            'tested_by' => Auth::user()->id,
        ];
        DB::table('project_test')->where('id',$request->project_test_id)->update($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
}