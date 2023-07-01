@extends('layouts.app')


@push('styles')
<!-- fullcalendar css  -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />
@endpush

@section('content')

    @php
        $status_projek = '';
    if(isset($all_plan[0]->updated_by)){
        $status_projek = 'ok';
    }
    @endphp

    <div class="container-fluid timeline-page">
        <div class="row">
            {{-- <div class="col-lg-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Timeline</h4>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div> --}}
            @php
                $role = ['PM','','client'];
            @endphp
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if(in_array(Session::get('role'),$role) )
                            <div class="col-lg-12">
                                <div class="card card-widget task-card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="mb-2">Planning & Organizing
                                                    </h5>
                                                    <div class="media align-items-center">
                                                        meliputi menentukan scope project, develop sebuah project plan, mengidentifikasi task, menentukan deadline, dan alokasi resources
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-md-0 mt-3">
                                                <a class="btn bg-secondary-light" data-toggle="collapse" href="#collapseEdit1" role="button" aria-expanded="false" aria-controls="collapseEdit1">DETAIL</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseEdit1">
                                    <div class="card card-list task-card">
                                        <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                            <div class="header-title">
                                                <h2>Detail</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{ url('project/planning_store') }}" method="post" enctype="multipart/form-data">

                                                        @csrf
                                                        <input type="hidden" required name="project_id" value="{{ $id }}">
                                                        <h5 class="mb-2">UAT Test Detail</h5>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                    <input type="checkbox" @isset($status_plan->id) @if($status_plan->scope == 1) checked  @endif @endif value="1" name="scope" class="custom-control-input" id="customCheck1">
                                                                    <label class="custom-control-label mb-1" for="customCheck1">Menentukan Scope</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                    <input type="checkbox" @isset($status_plan->id) @if($status_plan->task == 1) checked  @endif @endif value="1" name="task" class="custom-control-input" id="customCheck2">
                                                                    <label class="custom-control-label mb-1" for="customCheck2">Mengindetifikasi Task</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><hr>
                                                        <input type="hidden" value="@isset($status_plan->id) {{ $status_plan->id }} @endif" name="plan_id">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="exampleInputText2" class="h5">Waktu Mulai*</label>
                                                                    <input required type="date" value="@isset($project){{$project->waktu_mulai}}@endif" name="waktu_mulai" class="form-control" id="exampleInputText01"
                                                                    placeholder="Waktu Mulai" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="exampleInputText2" class="h5">Waktu Selesai*</label>
                                                                    <input required type="date" name="waktu_selesai"  value="@isset($project){{ $project->waktu_selesai }}@endif" class="form-control" id="exampleInputText01"
                                                                    placeholder="Waktu Selesai" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary w-100" >Upload Progress</button>

                                                    </form>
                                                    <hr>
                                                    <form action="{{ url('project/alokasi_resource') }}" method="post" enctype="multipart/form-data">

                                                        @csrf
                                                        <input type="hidden" required name="project_id" value="{{ $id }}">
                                                        <input type="hidden" value="@isset($status_plan->id) {{ $status_plan->id }} @endif" name="plan_id">
                                                        <h5 class="mb-2">Alokasi Resource</h5>
                                                        <div class="form-group mb-3 position-relative">
                                                            <label for="exampleInputText01" class="h5">Penanggung Jawab*</label>
                                                            @php
                                                                $penanggung_jawab = explode('|',$project->penanggung_jawab);
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
                                                            {{-- <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a> --}}
                                                        </div>
                                                        <p class="mb-0">*Pilih orang yang ikut proyek</p>
                                                        <button type="submit" class="btn btn-primary w-100" >Update Resource</button>

                                                    </form>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h5 class="mt-2 mb-2">Riwayat Dokumen Planning & Organizing</h5>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <table class="table mb-0 table-borderless tbl-server-info">
                                                                <thead>
                                                                    <tr class="ligth">
                                                                        <th scope="col">Jenis Dokumen</th>
                                                                        <th scope="col">Deskripsi</th>
                                                                        <th scope="col">File</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($all_plan as $item)

                                                                        <tr>
                                                                            <td>{{ $item->scope }}</td>
                                                                            <td>{{ $item->desc_timeline }}</td>
                                                                            <td>
                                                                                @if($item->updated_by == null)
                                                                                <a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a>
                                                                                <a href="{{ url('projects_timeline/hapus_document/'.$item->id) }}" class="btn btn-danger">Hapus </a>
                                                                                @else
                                                                                <a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-success">Sudah Di Approve </a>
                                                                                @php
                                                                                    $status_projek = 'ok';
                                                                                @endphp
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <form action="{{ url('project/plan_doc') }}" method="post" enctype="multipart/form-data">

                                                        @csrf
                                                        <input type="hidden" required name="project_id" value="{{ $id }}">
                                                        <input type="hidden" value="@isset($status_plan->id) {{ $status_plan->id }} @endif" name="plan_id">
                                                        <h5 class="mb-2">Dokumen Planning & Organizing</h5>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text">File*</span>
                                                            </div>
                                                            <div class="custom-file">
                                                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputText01" class="h5">Jenis Dokumen*</label>
                                                            <select name="scope" id="scope" class="form-control">
                                                                <option value="Project Scope Statement">Project Scope Statement</option>
                                                                <option value="Project Plan">Project Plan</option>
                                                                <option value="Task List">Task List</option>
                                                                <option value="Resource Allocation Plan">Resource Allocation Plan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputText01" class="h5">Comment*</label>
                                                            <textarea required name="desc_timeline" @isset($status_plan->id) {{ $status_plan->desc_timeline }} @endisset id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary w-100" >Upload dokumen</button>

                                                    </form>


                                                </div>
                                                <br>
                                            </div>
                                            @if(Session::get('role') == 'client')
                                            <a onclick="return confirm('Apakah anda yakin ingin di approve semua dokumen planning ini?')" href="{{ url('projects_timeline/update_plan/'.$id) }}" class="btn btn-danger w-100">APPROVE PLANNING </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-12">
                                <div class="card card-widget task-card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="mb-2">Mengelola Progres</h5>
                                                    <div class="media align-items-center">
                                                            Pembagian Tugas
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-md-0 mt-3">

                                                @if($status_projek == 'ok')
                                                @if(Session::get('role') == 'QA')
                                                <a class="btn bg-secondary-light" target="_blank" href="{{ url('projects/detail/'.$id) }}" >DETAIL</a>
                                                @else
                                                <a class="btn bg-secondary-light" target="_blank" href="{{ url('projects/task/'.$id) }}" >DETAIL</a>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(in_array(Session::get('role'),$role) )
                            <div class="col-lg-12">
                                <div class="card card-widget task-card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="mb-2">Monitoring Proyek</h5>
                                                    <div class="media align-items-center">
                                                        kegiatan ini meliputi melacak tugas proyek, deadline, resource, dan membuat penyesuaian jika diperlukan untuk memastikan bahwa proyek tetap berjalan dengan baik
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-md-0 mt-3">
                                                @if($status_projek == 'ok')

                                                    &nbsp;<a class="btn bg-secondary-light" target="_blank" href="{{ url('projects/monitoring/'.$id) }}" >DETAIL</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-widget task-card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h5 class="mb-2">Dokumentasi Proyek </h5>
                                                    <div class="media align-items-center">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media align-items-center mt-md-0 mt-3">
                                                @if($status_projek == 'ok')
                                                <a class="btn bg-secondary-light" data-toggle="collapse" href="#collapseEdit3" role="button" aria-expanded="false" aria-controls="collapseEdit1">DETAIL</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseEdit3">
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
                                                        <div class="col-lg-12">
                                                            <table class="table mb-0 table-borderless tbl-server-info">
                                                                <thead>
                                                                    <tr class="ligth">
                                                                       <th scope="col">Deskripsi</th>
                                                                       <th scope="col">File</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($evolution as $item)

                                                                        <tr>
                                                                            <th>{{ $item->desc_timeline }}</th>
                                                                            <td><a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a>
                                                                                <a href="{{ url('projects_timeline/hapus_document/'.$item->id) }}" class="btn btn-danger">Hapus </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{ url('project/evolution_store') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" required name="project_id" value="{{ $id }}">
                                                        <input type="hidden" value="@isset($status_plan->id) {{ $status_plan->id }} @endif" name="plan_id">
                                                        <h5 class="mb-2">Dokumentasi Projek</h5>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text">File*</span>
                                                            </div>
                                                            <div class="custom-file">
                                                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="exampleInputText01" class="h5">Comment*</label>
                                                            <textarea required name="desc_timeline" @isset($status_plan->id) {{ $status_plan->desc_timeline }} @endisset id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary w-100" >Update Progress</button>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="editModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="exampleModalCenterTitle02">
                        Apakah kamu yakin ingin mengubah status ini?
                    </h3>
                </div>
                <div class="modal-body">
                    <form action="{{ url('project_timeline/update_status') }}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" required name="status_id" id="status_id">
                        <input type="hidden" required name="status_jenis" id="status_jenis">
                        <div class="form-group  position-relative">
                            <label for="">Komentar</label>
                            <textarea required name="desc_update" class="form-control" id="" cols="30" rows="3"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <input class="btn btn-primary w-100" required name="submit" type="submit" value="SIMPAN">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="implementasi">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="exampleModalCenterTitle02">
                        Implementasi & Testing
                    </h3>
                </div>
                <form action="{{ url('project_test/accept_test') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" required name="project_id" value="{{ $id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table mb-0 table-borderless tbl-server-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th scope="col">#</th>
                                           <th scope="col">UAT Test Desc</th>
                                           <th scope="col">Di UAT oleh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($project_test as $item)

                                            <tr>
                                                <td>
                                                    <input type="checkbox" @if(isset($item->uat_test_case)) checked disabled @endif required name="project_test[]" value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $item->uat_test_desc }}</td>
                                                <td>
                                                    @php
                                                        if($item->tested_by !== null){
                                                            $dibuat = DB::table('users')->where('id',$item->tested_by)->first();
                                                            echo $dibuat->name;
                                                        }else{
                                                            echo "Belum di UAT";
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
@endsection

@push('scripts')
<script>
    function edit_detail(id) {
        $.ajax({
            type: 'get',
            url: "{{ url('project_detail/edit') }}/"+id,
            // data:{'id':id},
            beforeSend: function() {
                var url = "{{ url('assets/dist/img/Loading_2.gif') }}";
            },
            success: function(tampil) {

            }
        })
    }
    function status_timeline(id, jenis) {
        $('#status_id').val(id);
        $('#status_jenis').val(jenis);
        $('#editModal').modal('show');
        // $.ajax({
        //     type: 'get',
        //     url: "{{ url('project_timeline/status') }}/"+id+"/"+jenis,
        //     // data:{'id':id},
        //     success: function(tampil) {
        //         $('#tampildata').html(tampil);
        //     }
        // })
        // console.log('ok')
    }
</script>

{{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach($task as $item)
                {
                    title: '{{ $item->task_name }}',
                    start:'{{ $item->due_dates }}',
                    end:'{{ $item->due_dates }}',
                    backgroundColor: '#931F1D'
                },
                @endforeach
                // {
                //     title: 'Deadline Design',
                //     start:'{{ $project->deadline_design }}',
                //     end:'{{ $project->deadline_design }}',
                //     backgroundColor: '#931F1D'
                // },{
                //     title: 'Deadline Testing',
                //     start:'{{ $project->deadline_implementasi }}',
                //     end:'{{ $project->deadline_implementasi }}',
                //     backgroundColor: '#931F1D'
                // },
                // {
                //     title: 'Deadline Evolution',
                //     start:'{{ $project->deadline_evolution }}',
                //     end:'{{ $project->deadline_evolution }}',
                //     backgroundColor: '#931F1D'
                // },
                // {
                //     title: '{{ $project->nama_project }}',
                //     start:'{{ $project->waktu_mulai }}',
                //     end:'{{ $project->waktu_selesai }}',
                // },
            ],
            selectOverlap: function (event) {
                return event.rendering === 'background';
            }
        });

        calendar.render();
    });
</script>
@endpush
