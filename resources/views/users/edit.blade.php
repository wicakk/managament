@extends('layouts.app')
@section('content')
    <form action="{{ url('users/' . $users->id) }}" method="post">
        {!! csrf_field() !!}
        @method('PATCH')
        <div class="card card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="exampleInputText01" class="h5">Nama*</label>
                        <input type="text" name="name" class="form-control" id="exampleInputText01"
                            placeholder="name" value="{{ $users->name }}" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="exampleInputText01" class="h5">Email*</label>
                        <input type="text" name="email" class="form-control" id="exampleInputText01"
                            placeholder="Email" value="{{ $users->email }}" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="exampleInputText2" class="h5">Role*</label>
                        <select name="role" class="selectpicker form-control" data-style="py-0">
                            <option value="PM" @if($users->role == "PM") selected @endif>Project Manager</option>
                            <option value="QA" @if($users->role == "QA") selected @endif>Quality Assurance</option>
                            <option value="client" @if($users->role == "client") selected @endif>Client</option>
                            <option value="developer" @if($users->role == "developer") selected @endif>Programmer</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <em>Jika Ingin Mengubah password silahkan mengisi inputan di bawah</em>
                </div>
                <div class="col-12"><hr></div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="exampleInputText2" class="h5">Password*</label>
                        <input type="password" name="password" class="form-control" id="exampleInputText01"
                            placeholder="Pasword" />
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{ Crypt::encrypt($users->id) }}">
                <div class="col-12"><hr></div>
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-2">
                        <input class="btn btn-success gap-2" type="submit" value="Update">
                        <div class="btn btn-primary" data-dismiss="modal">
                            Cancel
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
