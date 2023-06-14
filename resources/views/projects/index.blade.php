@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>Project</h5>
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="list-grid-toggle d-flex align-items-center mr-3">
                                <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                    <div class="grid-icon mr-3">
                                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="14" width="7" height="7"></rect>
                                            <rect x="3" y="14" width="7" height="7"></rect>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-3 border-left btn-new">
                                @php
                                    $role = ['PM',''];
                                @endphp
                                @if(in_array(Session::get('role'),$role) )
                                <a href="#" class="btn btn-primary" data-target="#new-project-modal"
                                    data-toggle="modal">Add Project</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif 
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif 
    <div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
        <div class="row">
            @foreach ($projects as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-1">{{ $item->nama_project }}</h5>
                                <a href="{{ url('projects/timeline/'. $item->id) }}" class="btn bg-warning-light">
                                    <svg class="svg-icon" id="p-dash016" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    Detail
                                </a>
                            </div>
                            <p class="mb-3 badge badge-secondary">
                                {{-- {{ dump(Carbon::create($item->waktu_selesai) < Carbon::now()) }} --}} 
                                @if(Carbon::create($item->waktu_selesai) < Carbon::now())
                                    Sudah Selesai
                                @elseif(Carbon::create($item->waktu_mulai) > Carbon::now())
                                    Belum Mulai
                                @elseif(Carbon::create($item->waktu_mulai) <= Carbon::now())
                                Deadline {{ Carbon::parse(Carbon::now())->diffInDays($item->waktu_selesai) }} Hari Lagi
                                @endif
                            </p>
                            <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                <div class="iq-media-group">
                                    <span href="#" class="iq-media">
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
                                        <span>Kolaborator: {{ $hasil }}</span>
                                    </span>
                                </div>
                                @if(in_array(Session::get('role'),$role))
                                <span>
                                    {{-- <a href="{{ url('projects/task/'. $item->id) }}" class="btn bg-primary-light">Task</a>
                                    <a href="{{ url('projects/detail/'. $item->id) }}" class="btn bg-success-light">Testing</a> --}}
                                    <form method="POST" action="{{ url('/projects' . '/' . $item->id) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-white text-primary link-shadow bg-danger " title="Delete Student"
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
                                    <a href="{{ url('/projects/' . $item->id . '/edit') }}" title="Edit Student"
                                        type="submit"
                                        class="btn btn-white text-primary link-shadow bg-warning text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Page end  -->


{{-- MODAL CREATE --}}
<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-project-modal">
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
                        {{-- <div class="col-lg-6">
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
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Deadline Planning*</label>
                                <input type="date" name="deadline_plan" class="form-control" id="exampleInputText01"
                                placeholder="Deadline Planning" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Deadline Design*</label>
                                <input type="date" name="deadline_design" class="form-control" id="exampleInputText01"
                                placeholder="Deadline Design" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Deadline Implementasi & Testing*</label>
                                <input type="date" name="deadline_implementasi" class="form-control" id="exampleInputText01"
                                placeholder="Deadline Implementasi & Testing" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Deadline Evolution*</label>
                                <input type="date" name="deadline_evolution" class="form-control" id="exampleInputText01"
                                placeholder="Deadline Evolution" />
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
                        </div> --}}

                        
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
