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
                                                <div class="btn bg-body">Di Kerjakan :
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
                                        {{-- @if(Carbon::create($item->due_dates) >= Carbon::now())
                                        <a class="btn bg-primary-light" onclick="return edit_detail('{{ $item->id }}')" aria-expanded="false" >EDIT</a>
                                        @endif --}}
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
                                                    <h5 class="mb-2">UAT Test Description</h5>
                                                    <p class="mb-0">{{ $item->description }}</p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Checklist</h5>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            @if(Carbon::create($item->due_dates) >= Carbon::now())
                                            <form action="{{ url('project_test') }}" method="post" enctype="multipart/form-data">
                                            @endif
                                                @csrf
                                                <input type="hidden" required name="project_detail_id" value="{{ $item->id }}">
                                                <input type="hidden" required name="project_test_id" value="{{ $item->project_test_id }}">
                                                <input type="hidden" required name="uat_test_desc" value="{{ $item->category }}">
                                                <input type="hidden" required name="uat_test_detail" value="{{ $item->checklist }}">
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Steps For UAT Test</label>
                                                    <textarea required name="steps_for_uat_test" required id="steps_for_uat_test" cols="10" rows="3" class="form-control">{{ $item->steps_for_uat_test }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Expected Result</label>
                                                    <textarea required name="expected_result" required id="expected_result" cols="10" rows="3" class="form-control">{{ $item->expected_result }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Actual Result</label>
                                                    <select required name="actual_result_qa" required id="actual_result" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <option value="Pass">Pass</option>
                                                        <option value="Fail">Fail</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Result</label>
                                                    <textarea required name="result_qa" required id="result_qa" cols="10" rows="3" class="form-control">{{ $item->result_qa }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Comment</label>
                                                    <textarea required name="comments_qa" required  id="comments_qa" cols="10" rows="3" class="form-control">{{ $item->comments_qa }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Url Testing</label>
                                                    <input type="text" required required name="url_test" class="form-control" id="url_test" value="{{ $item->url_test }}">
                                                </div>
                                                <img src="{{ url('document_testing/'.$item->file_test_qa) }}" alt="Hasil Test" class="img-fluid" width="200">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload Hasil Testing*</span>
                                                    </div>
                                                    <div class="custom-file">
                                                    <input type="file" required required name="file" class="custom-file-input" id="inputGroupFile01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                </div>
                                                @if(Carbon::create($item->due_dates) >= Carbon::now())
                                                <button type="submit" class="btn btn-primary w-100" >Kirim Hasil Testing</button>
                                                @endif
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
