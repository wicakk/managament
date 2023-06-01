@extends('layouts.app')
@section('content')

<form action="{{ url('project_timeline/update_status') }}" method="post">
    {!! csrf_field() !!}
    @method('PATCH')
<div class="card bg-white card-list task-card">
    <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
        <div class="header-title">
            <div class="custom-control custom-checkbox custom-control-inline">
                <label class="custom-control-label h5" for="customCheck05">Edit Projek</label>
            </div>
        </div>
        <div><a href="#" class="btn bg-secondary-light">Detail</a></div>
    </div>
    <div class="card-body">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="jenis" value="{{ $jenis }}">
        <div class="form-group mb-3 position-relative">
            <h5>Catatan</h5>
            <input type="text" name="desc_update" class="form-control bg-white">
        </div>
        <div class="col-lg-12">
            <input class="btn btn-primary w-100" name="submit" type="submit" value="SIMPAN">
        </div>
    </div>
</div>  
</form>


@endsection