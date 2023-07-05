@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Monitoring</h5>
                    <div class="media align-items-center mt-md-0 mt-3">
                        @if(Session::get('role') == 'PM' || Session::get('role') == '')
                            <a class="btn bg-primary-light" href="#" data-target="#implementasi"
                            data-toggle="modal">UAT</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @php
                        $no = 0;
                    @endphp
                    @foreach($data as $item)
                    <div class="col-lg-12">
                        <div class="card card-widget task-card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            @php
                                                $cekstatus = DB::table('project_detail_checklist')->where('project_detail_id', $item->pid)->whereNotNull('status')->first();
                                            @endphp
                                            <h5 class="mb-2">{{ $item->task_name }}
                                                @if($item->actual_result_qa == 'Pass')
                                                <span class="badge badge-success text-white">PASS</span>
                                                @elseif($item->actual_result_qa == 'Fail')
                                                <span class="badge badge-danger text-white">FAIL</span>
                                                @elseif(isset($cekstatus))
                                                <span class="badge badge-info text-white">On Progress</span>
                                                @endif
                                            </h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3">Dibuat Oleh :
                                                    @php
                                                        $dibuat = DB::table('users')->where('id',$item->created_by)->first();
                                                        if(isset($dibuat->name)){
                                                            echo $dibuat->name;
                                                        }

                                                    @endphp
                                                </div>
                                                <div class="btn bg-body">Di Kerjakan Oleh :
                                                    @php
                                                    $dikerjakan = DB::table('users')->where('id',$item->assigned_to)->first();
                                                    if(isset($dikerjakan->name)){
                                                        echo $dikerjakan->name;
                                                    }

                                                    @endphp
                                                </div>
                                                <div class="btn bg-body">Di Testing oleh :
                                                    @php
                                                    $diqa = DB::table('users')->where('id',$item->qa_by)->first();
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
                                                    <p class="mb-2">{{ $item->description }}</p>
                                                    <h5 class="mb-2">Checklist/UAT Test Detail</h5>
                                                    <p class="mb-2">
                                                        {!! nl2br($item->checklist) !!}
                                                    </p>
                                                    @isset($item->file_dev)
                                                    <h5 class="mb-2">File Progress Programmer</h5>
                                                    <p class="mb-0"><a href="{{ url('asset/document_timeline/'.$item->file_dev) }}">Lihat Disini</a></p>
                                                    @endisset
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Steps For UAT Test</h5>
                                                    <p>
                                                        {!! nl2br($item->steps_for_uat_test) !!}
                                                    </p>
                                                    <h5 class="mb-2">Expected Result</h5>
                                                    <p>
                                                        {!! nl2br($item->expected_result) !!}
                                                    </p>
                                                    @isset($item->file_test_qa)
                                                    <h5 class="mb-2">File Testing QA</h5>
                                                    <p class="mb-0"><a href="{{ url('asset/document_testing/'.$item->file_test_qa) }}">Lihat Disini</a></p>
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">UAT Test Description</h5>
                                                    <p class="mb-0">{{ $item->description }}</p>
                                                    <h5 class="mb-2">Checklist/UAT Test Detail</h5>
                                                    <p>
                                                        {!! nl2br($item->checklist) !!}
                                                    </p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Steps For UAT Test</h5>
                                                    <p>
                                                        {!! nl2br($item->steps_for_uat_test) !!}
                                                    </p>
                                                    <h5 class="mb-2">Expected Result</h5>
                                                    <p>
                                                        {!! nl2br($item->expected_result) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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

<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="implementasi">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle02">
                    Implementasi & Testing
                </h3>
            </div>
            <form action="{{ url('project_test/accept_test') }}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" required name="project_id" value="{{ $id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table mb-0 table-borderless tbl-server-info">
                                <thead>
                                    <tr class="ligth">
                                        <th scope="col">#</th>
                                       <th scope="col">UAT Test Desc</th>
                                       <th scope="col">Di UAT oleh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project_test as $item)

                                        <tr>
                                            <td>
                                                <input type="checkbox" @if(isset($item->uat_test_case)) checked disabled @endif name="project_test[]" value="{{ $item->id }}">
                                            </td>
                                            <td>{{ $item->desc }}</td>
                                            <td>
                                                @php
                                                    if($item->tested_by !== null){
                                                        $dibuat = DB::table('users')->where('id',$item->tested_by)->first();
                                                        echo $dibuat->name;
                                                    }else{
                                                        echo "Belum di UAT";
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-2">
                                <input class="btn btn-success" type="submit" value="Save">
                                <div class="btn btn-primary" data-dismiss="modal">
                                    Cancel
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


