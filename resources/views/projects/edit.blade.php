@extends('layouts.app')
@section('content')

<form action="{{ url('projects/' . $projects->id) }}" method="post">
    {!! csrf_field() !!}
    @method('PATCH')
<div class="card bg-white card-list task-card">
    <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
        <div class="header-title">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="customCheck05">
                <label class="custom-control-label h5" for="customCheck05">Mark as done</label>
            </div>
        </div>
        <div><a href="#" class="btn bg-secondary-light">Design</a></div>
    </div>
    <div class="card-body">
        <div class="form-group mb-3 position-relative">
            <h5>Name Project :</h5>
            <input type="text" name="nama_project" class="form-control bg-white" value="{{$projects->nama_project}}">
            <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label for="exampleInputText3" class="h5">Waktu Mulai*</label>
                            <input type="date" name="waktu_mulai" class="form-control" id="exampleInputText3" value="{{$projects->waktu_mulai}}">
                        </div>                        
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label for="exampleInputText3" class="h5">Waktu Selesai*</label>
                            <input type="date"  name="waktu_selesai" class="form-control" id="exampleInputText3" value="{{$projects->waktu_selesai}}">
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-3 position-relative">
            <h5>Penanggung Jawab :</h5>
            <input type="text" name="pananggung_jawab" class="form-control bg-white" value="{{$projects->penanggung_jawab}}">
            <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
        </div>
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-2">
                <input class="btn btn-success gap-2" name="submit" type="submit" value="Update">
                <div class="btn btn-primary" data-dismiss="modal">
                    Cancel
                </div>
            </div>
        </div>
    </div>
</div>  
</form>


@endsection