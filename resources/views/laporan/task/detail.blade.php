@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Task Project</h5>
                    <div class="d-flex flex-wrap align-items-center">
                        <a href="#" class="btn btn-primary" data-target="#new-task-modal" data-toggle="modal">New Task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @php
                        $no = 0;
                    @endphp
                    @foreach($data as $item)
                    <div class="table-responsive">
                        <table class="table table-boreder">
                            <thead>
                                <tr>
                                    <th>Task Name</th>
                                    <th>Due Dates</th>
                                    <th>Category</th>
                                    <th>Created By</th>
                                    <th>Checklist</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $item->task_name }}</th>
                                    <td>{{ $item->due_dates }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->created_by }}</td>
                                    <td>
                                        @php
                                            $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                        @endphp
                                        <ol>
                                            @foreach($checklist as $check) 
                                                <li>{{ $check->isi }} @if($check->status == 1) <span class="badge badge-primary">Selesai</span>  @endif</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @php $no++ @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-task-modal">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle">New Task</h3>
            </div>
            <div class="modal-body">
                <form action="{{ url('project_detail/store') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">
                        <input type="hidden" required name="project_id" value="{{ $id }}">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText02" class="h5">Task Name</label>
                                <input type="text" required name="task_name" class="form-control" id="exampleInputText02" placeholder="Enter task Name">
                                <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Assigned to</label>
                                <select class="selectpicker form-control" required name="assigned_to" data-style="py-0">
                                    @foreach($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="exampleInputText05" class="h5">Due Dates*</label>
                                <input type="date" class="form-control" id="exampleInputText05" required name="due_dates" value="">
                            </div>                        
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Category</label>
                                <input type="text" class="form-control" id="exampleInputText05" required name="category" value="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText040" class="h5">Description</label>
                                <textarea class="form-control" required name="description" id="exampleInputText040" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText005" class="h5">Checklist</label>
                                <textarea class="form-control" required name="checklist" id="exampleInputText040" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-4">
                                <button class="btn btn-primary mr-3" type="submit">Save</button>
                                <div class="btn btn-danger" data-dismiss="modal">Cancel</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-task-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle02">
                    New Test Case
                </h3>
            </div>
            <form action="{{ url('project_detail/store') }}" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" required name="project_id" value="{{ $id }}">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">UAT Test Case*</label>
                                <input type="text" required name="uat_test_case" class="form-control" id="exampleInputText01"
                                    placeholder="UAT Test Case" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">UAT Test Desc*</label>
                                <input type="text" required name="uat_test_desc" class="form-control" id="exampleInputText01"
                                    placeholder="UAT Test Desc" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">UAT Test Details*</label>
                                <input type="text" required name="uat_test_detail" class="form-control" id="exampleInputText01"
                                    placeholder="UAT Test Details" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">Steps For UAT Test*</label>
                                <textarea required name="steps_for_uat_test" id="" cols="20" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">Expected Result*</label>
                                <textarea required name="expected_result" id="" cols="20" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
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


<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="editModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle02">
                    Edit
                </h3>
            </div>
            <div class="modal-body">
                <div id="tampildata"></div>
            </div>
        </div>
    </div>
</div> --}}




@endsection




@push('scripts')
<script>
    function edit_detail(id) {
        $.ajax({
            type: 'get',
            url: "{{ url('project_detail/edit_detail') }}/"+id,
            // data:{'id':id}, 
            beforeSend: function() {
                var url = "{{ url('assets/dist/img/Loading_2.gif') }}";
                
            },
            success: function(tampil) {
                $('#tampildata').html(tampil);
                $('#editModal').modal('show');
            }
        })
    }
</script>

@endpush