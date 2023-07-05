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

class ProjectController extends Controller
{
 
    public function index(): View
    {
        // $projects = DB::table('projects')->select('projects.*','users.name')
        // ->leftJoin('users', 'users.id', '=', 'projects.created_by')->get();
        $users = User::all();
        // dd();
        // dd(Session::get('role'));
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
        // dd($user_id);
        return view ('projects.index',compact('projects','users'));
    }
 
    public function store(Request $request): RedirectResponse
    {
        // $input = $request->all();
        // dd($input);
        // $penanggung_jawab = '|';
        // foreach($request->pj as $item){
        //     $penanggung_jawab .= $item.'|';
        // }
        $data = [
            'nama_project' => $request->nama_project,
            // 'waktu_mulai' => $request->waktu_mulai,
            // 'waktu_selesai' => $request->waktu_selesai,
            // 'penanggung_jawab' => $penanggung_jawab,
            // 'deadline_plan' => $request->deadline_plan,
            // 'deadline_design' => $request->deadline_design,
            // 'deadline_implementasi' => $request->deadline_implementasi,
            // 'deadline_evolution' => $request->deadline_evolution,
            'created_by' => Auth::user()->id,
        ];
        Project::create($data);
        // dd($data);
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
        // $penanggung_jawab = '|';
        // foreach($request->pj as $item){
        //     $penanggung_jawab .= $item.'|';
        // }
        $data = [
            'nama_project' => $request->nama_project,
            // 'waktu_mulai' => $request->waktu_mulai,
            // 'waktu_selesai' => $request->waktu_selesai,
            // 'penanggung_jawab' => $penanggung_jawab,
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
        $data = DB::table('project_detail')->where('project_id',$id)->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')->get();
        $users = User::all();
        return view('projects.detail',compact('data','id','users'));
    }
    public function task()
    {
        $id = Auth::user()->id;
        $data = DB::table('projects')
        ->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.result','project_test.actual_result','project_test.file_test','project_test.comments','projects.nama_project')
        ->leftJoin('project_detail', 'projects.id', '=', 'project_detail.project_id')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')
        ->where('project_detail.assigned_to',$id)->get();
        $users = User::all();
        return view('projects.task',compact('data','id','users'));
    }
    public function task_detail(string $id)
    {
        // $data = DB::table('projects')->select('projects.*','project_detail.*')
        // ->leftJoin('project_detail', 'project_detail.project_id', '=', 'projects.id')->get();
        $data = DB::table('project_detail')->where('project_id',$id)->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')->get();
        $users = User::all();
        return view('projects.task_detail',compact('data','id','users'));
    }
    public function monitoring(string $id)
    {
        // $data = DB::table('projects')->select('projects.*','project_detail.*')
        // ->leftJoin('project_detail', 'project_detail.project_id', '=', 'projects.id')->get();
        $data = DB::table('project_detail')->where('project_id',$id)->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.created_by as qa_by','project_test.tested_by as tested','project_detail.id as pid')
        ->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')->get();
        $project_test = DB::table('project_test')->select('project_test.*','project_detail.id as pid','project_detail.description as desc')->leftJoin('project_detail','project_detail.id','project_test.project_detail_id')->where('project_detail.project_id',$id)->where('project_test.actual_result_qa','Pass')->get();
        
        // dd($data);
        $users = User::all();
        return view('projects.monitoring',compact('data','id','users','project_test'));
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
        $id = DB::table('project_detail')->insertGetId($data);

        $checklist = explode('|',$request->checklist);
        foreach($checklist as $item){
            $data1 = [
                'project_detail_id' => $id,
                'isi' => $item
            ];
            DB::table('project_detail_checklist')->insert($data1);
        }
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
        $checklist = explode('|',$request->checklist);
        DB::table('project_detail_checklist')->where('project_detail_id', $request->project_detail_id)->delete();
        foreach($checklist as $item){
            $data1 = [
                'project_detail_id' => $request->project_detail_id,
                'isi' => $item
            ];
            DB::table('project_detail_checklist')->insert($data1);
        }
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
    public function update_checklist(Request $request)
    {
        // dd($request);
        $data = [
            'status' => null
        ];
        DB::table('project_detail_checklist')->where('project_detail_id',$request->project_detail_id)->update($data);
        foreach($request->project_checklist as $item){
            $data1 = [
                'status' => 1
            ];
            DB::table('project_detail_checklist')->where('id',$item)->update($data1);
        }
        $error = '';
        $file_name = '';

        // dd($request->hasFile('file'));
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

        $data2 = '';
        if($file_name !== ''){
            $data2 = [
                'file_dev' => $file_name,
            ];
            DB::table('project_detail')->where('id', $request->project_detail_id)->update($data2);
        }

        // DB::table('project_detail')->where('id',$request->project_detail_id)->update($data);
        // $checklist = explode('|',$request->checklist);
        // DB::table('project_detail_checklist')->where('project_detail_id', $request->project_detail_id)->delete();
        // foreach($checklist as $item){
        //     $data1 = [
        //         'project_detail_id' => $request->project_detail_id,
        //         'isi' => $item
        //     ];
        //     DB::table('project_detail_checklist')->insert($data1);
        // }
        return redirect()->back()->with('success', 'Tested Addedd!');
    }

    public function status_timeline($id,$jenis)
    {
        return view('projects.status_timeline',compact('jenis','id'));
    }
    public function status_timeline_store(Request $request)
    {
        // dd($request);
        $jenis = $request->status_jenis;
        $id = $request->status_id;
        $data = '';
        if($jenis == 'terima'){
            $data = [
                'status' => '1',
                'desc_update' => $request->desc_update,
                'updated_by' => Auth::user()->id,
                'updated_at' => now(),
            ];
        }else{
            $data = [
                'status' => '2',
                'desc_update' => $request->desc_update,
                'updated_by' => Auth::user()->id,
                'updated_at' => now(),
            ];
        }
        DB::table('project_timeline')->where('id',$id)->update($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }

    public function timeline(string $id): View
    {
        $project = Project::find($id);
        $users = User::all();
        
        $task = DB::table('project_detail')->where('project_id',$id)->get();
        $plan = DB::table('project_timeline')->where('jenis_timeline','planning')->where('project_id',$id)->first();
        $status_plan = DB::table('project_timeline')->where('jenis_timeline','planning')->where('project_id',$id)->first();
        $all_plan = DB::table('project_timeline')->where('jenis_timeline','planning')->where('project_id',$id)->get();

        // $design = DB::table('project_timeline')->where('jenis_timeline','design')->where('project_id',$id)->get();
        // $status_design = DB::table('project_timeline')->where('jenis_timeline','design')->where('project_id',$id)->where('status','1')->first();
        // $all_design = DB::table('project_timeline')->where('jenis_timeline','design')->where('project_id',$id)->get();

        $project_test = DB::table('project_test')->select('project_test.*','project_detail.id as pid')->leftJoin('project_detail','project_detail.id','project_test.project_detail_id')->where('project_detail.project_id',$id)->get();

        // $implementasi = DB::table('project_timeline')->where('jenis_timeline','implementasi')->where('project_id',$id)->get();
        // $status_implementasi = DB::table('project_timeline')->where('jenis_timeline','implementasi')->where('project_id',$id)->where('status','1')->first();

        $evolution = DB::table('project_timeline')->where('jenis_timeline','evolution')->where('project_id',$id)->get();
        // $status_evolution = DB::table('project_timeline')->where('jenis_timeline','evolution')->where('project_id',$id)->where('status','1')->first();
        // $all_evolution = DB::table('project_timeline')->where('jenis_timeline','evolution')->where('project_id',$id)->get();
        // dump($project_test);
        return view('projects.timeline',compact('project','users','id','plan','status_plan','all_plan','project_test','task','evolution'));
    }
    public function hapus_document(string $id): RedirectResponse
    {
        DB::table('project_timeline')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Data deleted!');
    }
    public function update_plan(string $id): RedirectResponse
    {
        $data = [
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];
        DB::table('project_timeline')->where('project_id',$id)->where('jenis_timeline','planning')->update($data);
        return redirect()->back()->with('success', 'Data deleted!');
    }
    public function planning_store(Request $request): RedirectResponse
    {
        // dd($request);
        $task = '';
        $scope = '';
        if(isset($request->task)){
            $task = $request->task;
        }
        if(isset($request->scope)){
            $scope = $request->scope;
        }


        if(empty($request->plan_id)){
            $data = [
                'project_id' => $request->project_id,
                'scope' => $scope,
                'task' => $task,
                'jenis_timeline' => 'planning',
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ];
            DB::table('project_timeline')->insert($data);

            $data1 = [
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'updated_at' => now(),
            ];
            DB::table('projects')->where('id',$request->project_id)->update($data1);
        }else{
            $data = [
                'project_id' => $request->project_id,
                'scope' => $scope,
                'task' => $task,
                'jenis_timeline' => 'planning',
            ];
            DB::table('project_timeline')->where('id',$request->plan_id)->update($data);

            $data1 = [
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'updated_at' => now(),
            ];
            DB::table('projects')->where('id',$request->project_id)->update($data1);
        }
        // $error = "";
        // $file_name= '';
        // if($request->hasFile('file')){
        //     $semua_file = "";
        //     // foreach($request->file as $file){
        //         // dd($file->getClientMimeType());
        //     $file= $request->file;
        //         if(in_array($file->getClientMimeType(),['image/jpg','image/jpeg','image/png','image/svg','application/zip','application/xls','application/xlsx','application/docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/pdf'])){
        //             $file_name = round(microtime(true) * 1000).'-'.str_replace(' ','-',$file->getClientOriginalName());
        //             // $name = Auth::user()->pegawai_id;
        //             $file->move(public_path('document_timeline/'), $file_name);
        //             // array_push($nama_file_surat, $file_name);
        //         }else{
        //             $error .= $file->getClientOriginalName()."File anda tidak dapat kami simpan cek kembali extensi dan besar filenya"."<br>";
        //         }
        //     // }
        //     // dd($nama_file_surat);
        //     if($error !== ""){
        //         return Redirect::back()->with(['error' => $error]);
        //     }
        // }
        // $data = [
        //     'desc_timeline' => $request->desc_timeline,
        //     'project_id' => $request->project_id,
        //     'jenis_timeline' => 'planning',
        //     'file_upload' => $file_name,
        //     'status' => '0',
        //     'created_by' => Auth::user()->id,
        //     'created_at' => now(),
        // ];
        // DB::table('project_timeline')->insert($data);
        return redirect()->back()->with('success', 'Data berhasil di simpan!');
    }
    public function alokasi_resource(Request $request): RedirectResponse
    {
        $penanggung_jawab = '|';
        foreach($request->pj as $item){
            $penanggung_jawab .= $item.'|';
        }
        $data1 = [
            'penanggung_jawab' => $penanggung_jawab,
        ];
        DB::table('projects')->where('id',$request->project_id)->update($data1);
        return redirect()->back()->with('success', 'Berhasil Mengalokasikan Resource!');
    }
    public function plan_doc(Request $request){
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
        $data = '';
        if($file_name == ''){
            $data = [
                'desc_timeline' => $request->desc_timeline,
                'project_id' => $request->project_id,
                'scope' => $request->scope,
                'jenis_timeline' => 'planning',
                'created_by' => Auth::user()->id,
            ];
        }else{
            $data = [
                'desc_timeline' => $request->desc_timeline,
                'project_id' => $request->project_id,
                'scope' => $request->scope,
                'jenis_timeline' => 'planning',
                'file_upload' => $file_name,
                'created_by' => Auth::user()->id,
            ];
        }
        DB::table('project_timeline')->insert($data);
        return redirect()->back()->with('success', 'Data Berhasil di upload!');

    }
    public function design_store(Request $request): RedirectResponse
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
            'jenis_timeline' => 'design',
            'file_upload' => $file_name,
            'status' => '0',
            'created_by' => Auth::user()->id,
            'created_at' => now(),
        ];
        DB::table('project_timeline')->insert($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
    public function implementasi_store($project_id): RedirectResponse
    {
        // dd($request);
    
        $data = [
            'desc_timeline' => 'Berhasil di testing',
            'project_id' => $project_id,
            'jenis_timeline' => 'implementasi',
            'file_upload' => '-',
            'status' => '1',
            'created_by' => Auth::user()->id,
            'created_at' => now(),
        ];
        DB::table('project_timeline')->insert($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
    public function evolution_store(Request $request): RedirectResponse
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
            'jenis_timeline' => 'evolution',
            'file_upload' => $file_name,
            'created_by' => Auth::user()->id,
            'created_at' => now(),
        ];
        DB::table('project_timeline')->insert($data);
        return redirect()->back()->with('success', 'Tested Addedd!');
    }
}