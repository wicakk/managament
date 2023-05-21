@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Your Project</h5>
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="dropdown dropdown-project mr-3">
                            <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                            <div class="btn bg-body"><span class="h6">Project :</span> webkit Project<i class="ri-arrow-down-s-line ml-2 mr-0"></i></div>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton03">
                                <a class="dropdown-item" href="#"><i class="ri-mic-line mr-2"></i>In Progress</a>
                                <a class="dropdown-item" href="#"><i class="ri-attachment-line mr-2"></i>Priority</a>
                                <a class="dropdown-item" href="#"><i class="ri-file-copy-line mr-2"></i>Category</a> 
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary" data-target="#new-task-modal" data-toggle="modal">New Task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($projects as $item)
                    <div class="col-lg-12">
                        <div class="card card-widget task-card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h5 class="mb-2">{{$item->nama_project}}</h5>
                                            <div class="media align-items-center">
                                                <div class="vr px-2">Waktu Mulai :</div>
                                                <div class="btn bg-body mr-3"><i class="ri-align-justify mr-2"></i>{{$item->waktu_mulai}}</div>
                                                <div class="vr px-2">Waktu Selesai :</div>
                                                <div class="btn bg-body"><i class="ri-survey-line mr-2"></i>{{$item->waktu_selesai}}</div>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                                <span>Penanggung Jawab :
                                                    @php
                                                    $hasil = '';
                                                    if(isset($item->penanggung_jawab)){
                                                        $user_id = explode('|',$item->penanggung_jawab);
                                                        $jumSub = count($user_id);
                                                        for ($i=0; $i<=$jumSub-1; $i++)
                                                        {
                                                            $data1 = DB::table('users')->where('id',$user_id[$i])->first();
                                                            if(isset($data1)){
                                                                $hasil .= $data1->name. ', ';

                                                            }
                                                            // dump( );
                                                        }
                                                    }
                                                    @endphp
                                                    <h5 class="mb-2">{{$hasil}}</h5>
                                                </span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media align-items-center mt-md-0 mt-3">
                                        <a href="#" class="btn bg-secondary-light mr-3">Detail</a>
                                        <a href="{{ url('/projects/' . $item->id . '/edit') }}" class="btn bg-warning text-white "role="button"><i class="ri-edit-box-line m-0"></i></a>
                                        <form method="POST" action="{{ url('/projects' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-white text-primary link-shadow bg-secondary-light " title="Delete Student"
                                                type="submit" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>  
                            </div>
                        </div>                                                                                                             
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



{{-- MODAL CREATE --}}
<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-task-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle02">
                    New Project
                </h3>
            </div>
            <form action="{{ url('projects') }}" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">Nama Project*</label>
                                <input type="text" name="nama_project" class="form-control" id="exampleInputText01"
                                    placeholder="Nama" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Waktu Mulai*</label>
                                <input type="date" name="waktu_mulai" class="form-control" id="exampleInputText01"
                                placeholder="Waktu Mulai" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Waktu Selesai*</label>
                                <input type="date" name="waktu_selesai" class="form-control" id="exampleInputText01"
                                placeholder="Waktu Selesai" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">Penanggung Jawab*</label>
                                <select class="select2 form-control" id="select2" name="pj[]" data-placeholder="CC (Tidak harus dipilih)" style="width: 100%;" multiple> 
                                    @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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