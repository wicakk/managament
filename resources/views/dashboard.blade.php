@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Projek</h5>
                    <span class="badge badge-primary">Monthly</span>
                </div>
                <h3><span class="counter">35000</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>User</h5>
                    <span class="badge badge-warning">Anual</span>
                </div>
                <h3><span class="counter">25100</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Task</h5>
                    <span class="badge badge-success">Today</span>
                </div>
                <h3><span class="counter">33000</span></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Profit</h5>
                    <span class="badge badge-info">Testing</span>
                </div>
                <h3><span class="counter">2500</span></h3>
            </div>
        </div>
    </div>
</div>
@endsection