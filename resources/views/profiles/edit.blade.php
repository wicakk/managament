@extends('profiles.layout')
@section('content')

<form action="{{ url('profiles/' .$profiles->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label
                                            for="exampleInputText01"
                                            class="h5"
                                            >Username*</label
                                        >
                                        <input
                                            type="text"
                                            name="username"
                                            class="form-control"
                                            id="exampleInputText01"
                                            placeholder="username"
                                            value="{{$profiles->username}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label
                                            for="exampleInputText01"
                                            class="h5"
                                            >Email*</label
                                        >
                                        <input
                                            type="text"
                                            name="email"
                                            class="form-control"
                                            id="exampleInputText01"
                                            placeholder="Email"
                                            value="{{$profiles->email}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label
                                            for="exampleInputText2"
                                            class="h5"
                                            >Password*</label
                                        >
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            id="exampleInputText01"
                                            placeholder="Pasword"
                                            value="{{$profiles->password}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label
                                            for="exampleInputText2"
                                            class="h5"
                                            >Confirm Password*</label
                                        >
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            id="exampleInputText01"
                                            placeholder="Pasword"
                                            value="{{$profiles->password}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label
                                            for="exampleInputText2"
                                            class="h5"
                                            >Role*</label
                                        >
                                        <select
                                            name="type"
                                            name="role"
                                            class="selectpicker form-control"
                                            data-style="py-0"
                                            value="{{$profiles->role}}"
                                        >
                                            <option>Admin</option>
                                            <option>Petugas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div
                                        class="d-flex flex-wrap align-items-ceter justify-content-center mt-2"
                                    >
                                        <input
                                            class="btn btn-success gap-2"
                                            type="submit"
                                            value="Update"
                                        >
                                        <div
                                            class="btn btn-primary"
                                            data-dismiss="modal"
                                        >
                                            Cancel
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

@endsection