@extends('layouts.app')

@push('styles')
<!-- fullcalendar css  -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />
@endpush
@section('content')

@php
    $role = ['PM',''];
@endphp
<div class="row">
    <div class="col-12">
        <div class="card card-block card-stretch card-height bg-info">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between text-white">
                    <h5 class="text-white">Selamat Datang, {{ Auth::user()->name }} </h5>
                    <span class="badge badge-primary"></span>
                </div>
                <h3 class="text-white">Di Aplikasi Management Projek</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Projek</h5>
                    <span class="badge badge-primary"></span>
                </div>
                <h3><span class="counter">{{ $project }}</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>User</h5>
                    <span class="badge badge-warning"></span>
                </div>
                <h3><span class="counter">{{ $user }}</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Task</h5>
                    <span class="badge badge-success"></span>
                </div>
                <h3><span class="counter">{{ $task }}</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>UAT</h5>
                </div>
                <h3><span class="counter">{{ $uat }}</span></h3>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <center><h2>Task Hari Ini</h2></center>
                    </div>
                    <hr>
                    <br>
                    @php
                        $no = 0;
                    @endphp
                    @if(isset($hari_ini[0]))
                        @foreach($hari_ini as $item)
                        <div class="col-lg-12">
                            <div class="card card-widget task-card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h5 class="mb-2">{{ $item->task_name }} <span class="badge badge-warning"> Batas Akhir : {{ $item->due_dates }}</span></h5>
                                                <div class="media align-items-center">
                                                    <div class="btn bg-body mr-3">Dibuat Oleh :
                                                        @php
                                                            $dibuat = DB::table('users')->where('id',$item->created_by)->first();
                                                            echo $dibuat->name;

                                                        @endphp
                                                    </div>
                                                    <div class="btn bg-body">Di Kerjakan Oleh :
                                                        @php
                                                        $dibuat = DB::table('users')->where('id',$item->assigned_to)->first();
                                                        echo $dibuat->name;

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
                                            <h2>Detail</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-2">Category</h5>
                                                        <p class="mb-0">{{ $item->category }}</p>
                                                        <h5 class="mb-2">Description</h5>
                                                        <p class="mb-0">{{ $item->description }}</p>
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                @if(Session::get('role') == "developer")
                                                @if(Carbon::create($item->due_dates) >= Carbon::now())
                                                <form action="{{ url('project_detail_checklist') }}" method="post" enctype="multipart/form-data">
                                                @endif
                                                    @csrf
                                                    <input type="hidden" required name="project_detail_id" value="{{ $item->id }}">
                                                    <h5 class="mb-2">UAT Test Detail</h5>
                                                    <div class="row">
                                                        @php
                                                            $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                                        @endphp
                                                        @foreach($checklist as $check)
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" value="{{ $check->id }}" name="project_checklist[]" class="custom-control-input" id="customCheck{{ $check->id }}" @if($check->status == 1) checked @endif>
                                                                <label class="custom-control-label mb-1" for="customCheck{{ $check->id }}">{{ $check->isi }}</label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>  <br>
                                                    @if(Carbon::create($item->due_dates) >= Carbon::now())
                                                    <button type="submit" class="btn btn-primary w-100" >Update Progress</button>
                                                    @endif
                                                </form>
                                                @else
                                                <h5 class="mb-2">UAT Test Detail</h5>
                                                <p>
                                                    @php
                                                        $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                                    @endphp
                                                    <ol>
                                                        @foreach($checklist as $check)
                                                            <li>{{ $check->isi }} @if($check->status == 1) <span class="badge badge-primary">Selesai</span>  @endif</li>
                                                        @endforeach
                                                    </ol>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $no++ @endphp
                        @endforeach
                    @else
                    <div class="alert alert-danger w-100">
                        Tidak Ada Data
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <center><h2>Task Gagal</h2></center>
                    </div>
                    <hr>
                    <br>
                    @php
                        $no = 0;
                    @endphp
                    @if(isset($gagal[0]))
                        @foreach($gagal as $item)
                        <div class="col-lg-12">
                            <div class="card card-widget task-card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h5 class="mb-2">{{ $item->task_name }} <span class="badge badge-warning"> Batas Akhir : {{ $item->due_dates }}</span></h5>
                                                <div class="media align-items-center">
                                                    <div class="btn bg-body mr-3">Dibuat Oleh :
                                                        @php
                                                            $dibuat = DB::table('users')->where('id',$item->created_by)->first();
                                                            echo $dibuat->name;

                                                        @endphp
                                                    </div>
                                                    <div class="btn bg-body">Di Kerjakan Oleh :
                                                        @php
                                                        $dibuat = DB::table('users')->where('id',$item->assigned_to)->first();
                                                        echo $dibuat->name;

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
                                            <h2>Detail</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-2">Category</h5>
                                                        <p class="mb-0">{{ $item->category }}</p>
                                                        <h5 class="mb-2">Description</h5>
                                                        <p class="mb-0">{{ $item->description }}</p>
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h5 class="mb-2">Comment QA</h5>
                                                        <p class="mb-0">{{ $item->comments_qa }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                @if(Session::get('role') == "developer")
                                                @if(Carbon::create($item->due_dates) >= Carbon::now())
                                                <form action="{{ url('project_detail_checklist') }}" method="post" enctype="multipart/form-data">
                                                @endif
                                                    @csrf
                                                    <input type="hidden" required name="project_detail_id" value="{{ $item->id }}">
                                                    <h5 class="mb-2">UAT Test Detail</h5>
                                                    <div class="row">
                                                        @php
                                                            $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                                        @endphp
                                                        @foreach($checklist as $check)
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" value="{{ $check->id }}" name="project_checklist[]" class="custom-control-input" id="customCheck{{ $check->id }}" @if($check->status == 1) checked @endif>
                                                                <label class="custom-control-label mb-1" for="customCheck{{ $check->id }}">{{ $check->isi }}</label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>  <br>
                                                    @if(Carbon::create($item->due_dates) >= Carbon::now())
                                                    <button type="submit" class="btn btn-primary w-100" >Update Progress</button>
                                                    @endif
                                                </form>
                                                @else
                                                <h5 class="mb-2">UAT Test Detail</h5>
                                                <p>
                                                    @php
                                                        $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                                    @endphp
                                                    <ol>
                                                        @foreach($checklist as $check)
                                                            <li>{{ $check->isi }} @if($check->status == 1) <span class="badge badge-primary">Selesai</span>  @endif</li>
                                                        @endforeach
                                                    </ol>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $no++ @endphp
                        @endforeach
                    @else
                    <div class="alert alert-danger w-100">
                        Tidak Ada Data
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-body">
            <div id="calendar"></div>
        </div>
    </div>
    
</div>
@endsection


@push('scripts')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach($taskdet as $item)
                {
                    title: '{{ $item->task_name }}',
                    start:'{{ $item->due_dates }}',
                    end:'{{ $item->due_dates }}',
                    backgroundColor: '#931F1D'
                },
                @endforeach
            ],
            eventClick: function(info) {
                info.jsEvent.preventDefault(); // don't let the browser navigate
                console.log(info.event.title)
                alert(info.event.title);
                // if (info.event.url) {
                // window.open(info.event.url);
                // alert(info.event.title);
                // }
            },
            // selectOverlap: function (event) {
            //     return event.rendering === 'background';
            // }
        });

        calendar.render();
    });
</script>

@endpush