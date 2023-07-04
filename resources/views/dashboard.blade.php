@extends('layouts.app')
@section('content')
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
</div>
@endsection