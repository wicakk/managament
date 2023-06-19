@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                        <h5>RIWAYAT UAT</h5>
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
                                <a href="{{ url('laporan/test/detail/'. $item->id) }}" class="btn bg-warning-light">
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
