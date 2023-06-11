@extends('layouts.app')
@section('content')

<form action="{{ url('projects/' . $projects->id) }}" method="post">
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
        <div class="form-group mb-3 position-relative">
            <h5>Name Project :</h5>
            <input type="text" name="nama_project" class="form-control bg-white" value="{{$projects->nama_project}}">
            <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
        </div>
        {{-- <div class="form-group mb-3 row">
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
        <div class="form-group mb-3 position-relative">
            <label for="exampleInputText01" class="h5">Penanggung Jawab*</label>
            @php
                $penanggung_jawab = explode('|',$projects->penanggung_jawab);
            @endphp
            <select class="select2 form-control" id="select2" name="pj[]" data-placeholder="CC (Tidak harus dipilih)" style="width: 100%;" multiple> 
                @foreach($users as $item)
                    @if(array_search(strval($item->id),$penanggung_jawab,true))
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a> 
        </div> --}}
        <div class="col-lg-12">
            <input class="btn btn-primary w-100" name="submit" type="submit" value="Update">
        </div>
    </div>
</div>  
</form>


@endsection