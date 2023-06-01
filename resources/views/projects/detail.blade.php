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
                                                <div class="btn bg-body">Di Kerjaakan : 
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
                                        <a class="btn bg-primary-light" onclick="return edit_detail('{{ $item->id }}')" aria-expanded="false" >EDIT</a>
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
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <p>
                                                        {!! nl2br($item->checklist) !!}    
                                                    </p>                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ url('project_test') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="project_detail_id" value="{{ $item->id }}">
                                                <input type="hidden" name="project_test_id" value="{{ $item->project_test_id }}">
                                                <input type="hidden" name="uat_test_desc" value="{{ $item->category }}">
                                                <input type="hidden" name="uat_test_detail" value="{{ $item->checklist }}">
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Steps For UAT Test</label>
                                                    <textarea name="steps_for_uat_test" id="steps_for_uat_test" cols="10" rows="3" class="form-control">{{ $item->steps_for_uat_test }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Expected Result</label>
                                                    <textarea name="expected_result" id="expected_result" cols="10" rows="3" class="form-control">{{ $item->expected_result }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Actual Result</label>
                                                    <select name="actual_result_qa" id="actual_result" class="form-control">
                                                        <option value="Pass">Pass</option>
                                                        <option value="Fail">Fail</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Result</label>
                                                    <textarea name="result_qa" id="result_qa" cols="10" rows="3" class="form-control">{{ $item->result_qa }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Catatan</label>
                                                    <textarea name="comments_qa" id="comments_qa" cols="10" rows="3" class="form-control">{{ $item->comments_qa }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100" >Kirim Hasil Testing</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                    @php $no++ @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-task-modal">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle">New Task</h3>
            </div>
            <div class="modal-body">
                <form action="{{ url('project_detail/store') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">
                        <input type="hidden" name="project_id" value="{{ $id }}">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText02" class="h5">Task Name</label>
                                <input type="text" name="task_name" class="form-control" id="exampleInputText02" placeholder="Enter task Name">
                                <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Assigned to</label>
                                <select class="selectpicker form-control" name="assigned_to" data-style="py-0">
                                    @foreach($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="exampleInputText05" class="h5">Due Dates*</label>
                                <input type="date" class="form-control" id="exampleInputText05" name="due_dates" value="">
                            </div>                        
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="exampleInputText2" class="h5">Category</label>
                                <input type="text" class="form-control" id="exampleInputText05" name="category" value="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText040" class="h5">Description</label>
                                <textarea class="form-control" name="description" id="exampleInputText040" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText005" class="h5">Checklist</label>
                                <textarea class="form-control" name="checklist" id="exampleInputText040" rows="2"></textarea>
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
                        <input type="hidden" name="project_id" value="{{ $id }}">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">UAT Test Case*</label>
                                <input type="text" name="uat_test_case" class="form-control" id="exampleInputText01"
                                    placeholder="UAT Test Case" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">UAT Test Desc*</label>
                                <input type="text" name="uat_test_desc" class="form-control" id="exampleInputText01"
                                    placeholder="UAT Test Desc" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">UAT Test Details*</label>
                                <input type="text" name="uat_test_detail" class="form-control" id="exampleInputText01"
                                    placeholder="UAT Test Details" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">Steps For UAT Test*</label>
                                <textarea name="steps_for_uat_test" id="" cols="20" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputText01" class="h5">Expected Result*</label>
                                <textarea name="expected_result" id="" cols="20" rows="3" class="form-control"></textarea>
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
</div>




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