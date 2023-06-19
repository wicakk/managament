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
                                <a href="{{ url('laporan/task/detail/'. $item->id) }}" class="btn bg-warning-light">
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

    
@endsection
