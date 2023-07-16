@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Riwayat Proyek</h5>
                    <div class="d-flex flex-wrap align-items-center">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row p-3">
                    <center><h2 class="text-center mb-3">Judul Proyek : {{ $data->nama_project }}</h2></center>
                    <br>
                    <table class="table table-striped mb-3">
                        <tr>
                            <th>Di buat Oleh</th>
                            <td>{{ $data->name }}</td>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $data->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Mulai</th>
                            <td>{{ $data->waktu_mulai }}</td>
                            <th>Waktu Selesai</th>
                            <td>{{ $data->waktu_selesai }}</td>
                        </tr>
                        <tr>
                            <th>Kolaborator</th>
                            <td colspan="3">
                                @php
                                    $kolaborator = explode('|',$data->penanggung_jawab);
                                    // dump($kolaborator);
                                    foreach($kolaborator as $item)
                                    {
                                        $data1 = DB::table('users')->leftJoin('profile', 'profile.user_id', '=', 'users.id')->where('users.id',$item)->first();
                                        if(isset($data1)){
                                            echo($data1->name. ' | '. $data1->role . '<br><br>');
                                        }
                                    }
                                    $all_plan = DB::table('project_timeline')->where('jenis_timeline','planning')->where('project_id',$id)->get();
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <th>Menentukan Scope</th>
                            <td>
                                @if($data->scope == 1) <div class="text-success">Sudah di buat</div> @else <div class="text-danger">Belum di buat</div>  @endif 
                            </td>
                            <th>Mengindetifikasi Task</th>
                            <td>
                                @if($data->task == 1) <div class="text-success">Sudah di buat</div> @else <div class="text-danger">Belum di buat</div>  @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumen Start Projek</th>
                            <td>
                                @foreach($all_plan as $item3)
                                    Jenis Dokumen : {{ $item3->scope }} <br><br>
                                    Deskripsi :
                                    {{ $item3->desc_timeline }}<br><br>
                                    Foto :
                                    <a href="{{ url('document_timeline/'.$item3->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a> <br>
                                    <br>
                                @endforeach
                            </td>
                            <th>Waktu Selesai</th>
                            <td>
                            </td>
                        </tr>
                    </table>
                    {{-- <h5 class="mb-3">Dokumen Projek</h5> --}}
                    <hr>
                    <h5 class="mb-3">Detail Projek</h5>
                    <hr>
                    @php
                        $project_id = $data->id;
                        $data2 = DB::table('project_detail')->where('project_id',$id)->select('project_detail.*','project_test.id as project_test_id','project_test.steps_for_uat_test','project_test.expected_result','project_test.result_qa','project_test.comments_qa','project_test.actual_result_qa','project_test.url_test','project_test.file_test_qa','project_test.created_by as qa_by','project_test.tested_by as tested','project_detail.id as pid','project_test.uat_test_case as cms','project_test.uat_test_desc as desc_uat','project_test.uat_test_detail as uat_det','project_test.actual_result as uat_act','project_test.result as uat_result','project_test.file_test','project_test.comments as uat_comments')->leftJoin('project_test', 'project_test.project_detail_id', '=', 'project_detail.id')->get();
                        // dump($data2);
                    @endphp
                    <div class="row">
                        @php
                            $no = 0;
                        @endphp
                        @foreach($data2 as $item2)
                        <div class="col-lg-12">
                            <div class="card card-widget task-card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                @php
                                                    $cekstatus = DB::table('project_detail_checklist')->where('project_detail_id', $item2->pid)->whereNotNull('status')->first();
                                                @endphp
                                                <h5 class="mb-2">{{ $item2->task_name }}
                                                    @if($item2->actual_result_qa == 'Pass')
                                                    <span class="badge badge-success text-white">PASS</span>
                                                    @elseif($item2->actual_result_qa == 'Fail')
                                                    <span class="badge badge-danger text-white">FAIL</span>
                                                    @elseif(isset($cekstatus))
                                                    <span class="badge badge-info text-white">On Progress</span>
                                                    @endif
                                                </h5>
                                                <div class="media align-items-center">
                                                    <div class="btn bg-body mr-3">Dibuat Oleh :
                                                        @php
                                                            $dibuat = DB::table('users')->where('id',$item2->created_by)->first();
                                                            if(isset($dibuat->name)){
                                                                echo $dibuat->name;
                                                            }
    
                                                        @endphp
                                                    </div>
                                                    <div class="btn bg-body">Di Kerjakan Oleh :
                                                        @php
                                                        $dikerjakan = DB::table('users')->where('id',$item2->assigned_to)->first();
                                                        if(isset($dikerjakan->name)){
                                                            echo $dikerjakan->name;
                                                        }
    
                                                        @endphp
                                                    </div>
                                                    <div class="btn bg-body">Di Testing oleh :
                                                        @php
                                                        $diqa = DB::table('users')->where('id',$item2->qa_by)->first();
                                                        if(isset($diqa->name)){
                                                            echo $diqa->name;
                                                        }
    
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media align-items-center mt-md-0 mt-3">
                                            <a class="btn bg-secondary-light" data-toggle="collapse" href="#collapseEdit{{ $no }}" role="button" aria-expanded="false" aria-controls="collapseEdit1">DETAIL</a> &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="collapseEdit{{ $no }}">
                                <div class="card card-list task-card">
                                    <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                        <div class="header-title">
                                            <h5>Detail Progress</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-2">UAT Test Description</h5>
                                                        <p class="mb-2">{{ $item2->description }}</p>
                                                        <h5 class="mb-2">Checklist/UAT Test Detail</h5>
                                                        <p class="mb-2">
                                                            {!! nl2br($item2->checklist) !!}
                                                        </p>
                                                        @isset($item2->file_dev)
                                                        <h5 class="mb-2">Bukti Pekerjaan Programmer</h5>
                                                        <p class="mb-0"><a href="{{ url('asset/document_timeline/'.$item2->file_dev) }}">Lihat Disini</a></p>
                                                        @endisset
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-2">Steps For UAT Test</h5>
                                                        <p>
                                                            {!! nl2br($item2->steps_for_uat_test) !!}
                                                        </p>
                                                        <h5 class="mb-2">Expected Result</h5>
                                                        <p>
                                                            {!! nl2br($item2->expected_result) !!}
                                                        </p>
                                                        @isset($item2->file_test_qa)
                                                        <h5 class="mb-2">Bukti Testing QA</h5>
                                                        <p class="mb-0"><a href="{{ url('asset/document_testing/'.$item2->file_test_qa) }}">Lihat Disini</a></p>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-2">UAT TEST CASE</h5>
                                                        <p class="mb-2">{{ $item2->cms }}</p>
                                                        <h5 class="mb-2">UAT TEST DESC</h5>
                                                        <p class="mb-2">
                                                            {!! nl2br($item2->desc_uat) !!}
                                                        </p>
                                                        <h5 class="mb-2">UAT TEST DETAIL</h5>
                                                        <p class="mb-2">
                                                            {!! nl2br($item2->uat_det) !!}
                                                        </p>
                                                        <h5 class="mb-2">URL TEST</h5>
                                                        <p class="mb-2">
                                                            {!! nl2br($item2->url_test) !!}
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-2">Actual Result</h5>
                                                        <p>
                                                            {!! nl2br($item2->uat_act) !!}
                                                        </p>
                                                        <h5 class="mb-2">UAT Result</h5>
                                                        <p>
                                                            {!! nl2br($item2->uat_result) !!}
                                                        </p>
                                                        <h5 class="mb-2">UAT Comments</h5>
                                                        <p>
                                                            {!! nl2br($item2->uat_comments) !!}
                                                        </p>
                                                        @isset($item2->file_test)
                                                        <h5 class="mb-2">Bukti UAT</h5>
                                                        <p class="mb-0"><a href="{{ url('asset/document_testing/'.$item2->file_test) }}">Lihat Disini</a></p>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $no++ @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
