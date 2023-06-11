@extends('layouts.app')


@push('styles')
<!-- fullcalendar css  -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />
@endpush

@section('content')

    <div class="container-fluid timeline-page">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Timeline</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                            <ul class="list-inline p-0 m-0">
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-primary text-primary"></div>
                                    <h6 class="float-left mb-1">Planing & Organizing 
                                        @if(Carbon::create($projects->deadline_plan) >= Carbon::today() || isset($plan[0]))
                                        <a href="#" data-target="#planning"
                                        data-toggle="modal"><span class="badge badge-success">
                                            @if(empty($plan[0]))
                                                Upload 
                                            @else
                                            {{-- kesini --}}
                                                @foreach($plan as $item)
                                                    @if($item->status == 1)
                                                        Accept
                                                    @elseif($item->status == 2)
                                                        Ditolak
                                                    @else
                                                        On Progress
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span></a>
                                        @endif
                                        <span class="badge badge-danger ">
                                            {{ $projects->deadline_plan }}
                                        </span>
                                    </h6>
                                    <small class="float-right mt-1">
                                        @if(isset($status_plan)) 
                                           Dibuat pada : {{ $status_plan->created_at }} Diterima pada : {{ $status_plan->updated_at }}                                       
                                        @endif
                                    </small>
                                    <div class="d-inline-block w-100">
                                        @if(isset($status_plan)) 
                                            Dibuat Oleh : 
                                            @php
                                                $dibuat = DB::table('users')->where('id',$status_plan->created_by)->first();
                                                echo $dibuat->name;
                                            @endphp
                                            &nbsp;&nbsp;
                                            Diterima Oleh :
                                            @php
                                                $dibuat = DB::table('users')->where('id',$status_plan->updated_by)->first();
                                                echo $dibuat->name;
                                            @endphp
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-success text-success"></div>
                                    <h6 class="float-left mb-1">Design Analysis 
                                        @if(isset($status_plan))
                                            <a href="#" data-target="#design"
                                            data-toggle="modal"><span class="badge badge-success">
                                                @if(empty($design[0]))
                                                    Upload
                                                @else
                                                {{-- kesini --}}
                                                    @foreach($design as $item)
                                                        @if($item->status == 1)
                                                            Accept
                                                        @elseif($item->status == 2)
                                                            Ditolak
                                                        @else
                                                            On Progress
                                                        @endif
                                                    @endforeach
                                                @endif    
                                            </span></a>
                                        @endif

                                        <span class="badge badge-danger ">
                                            {{ $projects->deadline_design }}
                                        </span>
                                    </h6>
                                    <small class="float-right mt-1">
                                        @if(isset($status_design)) 
                                           Dibuat pada : {{ $status_plan->created_at }} Diterima pada : {{ $status_plan->updated_at }}                                       
                                        @endif
                                    </small>
                                    <div class="d-inline-block w-100">
                                        <p>
                                            @if(isset($status_design)) 
                                            Dibuat Oleh : 
                                            @php
                                                $dibuat = DB::table('users')->where('id',$status_design->created_by)->first();
                                                echo $dibuat->name;
                                            @endphp
                                            &nbsp;&nbsp;
                                            Diterima Oleh :
                                            @php
                                                $dibuat = DB::table('users')->where('id',$status_design->updated_by)->first();
                                                echo $dibuat->name;
                                            @endphp
                                        @endif
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-primary text-primary"></div>
                                    <h6 class="float-left mb-1">Implementasi & Testing 
                                        @if(isset($status_design))
                                        <a href="#" data-target="#implementasi"
                                        data-toggle="modal"><span class="badge badge-success">
                                            @if(empty($implementasi[0]))
                                                Testing
                                            @else
                                            {{-- kesini --}}
                                                @foreach($implementasi as $item)
                                                    @if($item->status == 1)
                                                        Accept
                                                    @elseif($item->status == 2)
                                                        Ditolak
                                                    @else
                                                        On Progress
                                                    @endif
                                                @endforeach
                                            @endif 
                                        </span>
                                        @endif
                                        <span class="badge badge-danger ">
                                            {{ $projects->deadline_implementasi }}
                                        </span>
                                    </a></h6>
                                    <small class="float-right mt-1">
                                        @if(isset($status_implementasi)) 
                                           Dibuat pada : {{ $status_implementasi->created_at }} Diterima pada : {{ $status_implementasi->updated_at }}                                       
                                        @endif
                                    </small>
                                    <div class="d-inline-block w-100">
                                        <p>
                                            @if(isset($status_implementasi)) 
                                                Dibuat Oleh : 
                                                @php
                                                    $dibuat = DB::table('users')->where('id',$status_implementasi->created_by)->first();
                                                    echo $dibuat->name;
                                                @endphp
                                                &nbsp;&nbsp;
                                                Diterima Oleh :
                                                @php
                                                    // $dibuat = DB::table('users')->where('id',$status_implementasi->updated_by)->first();
                                                    // echo $dibuat->name;
                                                @endphp
                                            @endif
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-warning text-warning"></div>
                                    <h6 class="float-left mb-1">Evolution 
                                        @if(isset($status_implementasi))
                                        <a href="#" data-target="#evolution"
                                        data-toggle="modal"><span class="badge badge-success">
                                            @if(empty($evolution[0]))
                                                Upload
                                            @else
                                            {{-- kesini --}}
                                                @foreach($evolution as $item)
                                                    @if($item->status == 1)
                                                        Accept
                                                    @elseif($item->status == 2)
                                                        Ditolak
                                                    @else
                                                        On Progress
                                                    @endif
                                                @endforeach
                                            @endif

                                        </span></a>
                                        @endif
                                        <span class="badge badge-danger ">
                                            {{ $projects->deadline_evolution }}
                                        </span>
                                    </h6>
                                    <small class="float-right mt-1">
                                        @if(isset($status_evolution)) 
                                           Dibuat pada : {{ $status_evolution->created_at }} Diterima pada : {{ $status_evolution->updated_at }}                                       
                                        @endif
                                    </small>
                                    <div class="d-inline-block w-100">
                                        <p>
                                            @if(empty($evolution[0]))
                                                Upload
                                            @else
                                            {{-- kesini --}}
                                                @foreach($evolution as $item)
                                                    @if($item->status == 1)
                                                        Accept
                                                    @elseif($item->status == 2)
                                                        Ditolak
                                                    @else
                                                        On Progress
                                                    @endif
                                                @endforeach
                                            @endif  
                                        </p>
                                    </div>
                                </li>
                            </ul>
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

    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="planning">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="planningShow">
                        Planning & Organizing
                    </h3>
                </div>
                @if(empty($plan[0]))
                    <form action="{{ url('project/planning_store') }}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" required name="project_id" value="{{ $id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">File*</span>
                                        </div>
                                        <div class="custom-file">
                                        <input type="file" required name="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputText01" class="h5">Catatan*</label>
                                        <textarea required name="desc_timeline" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
                @endif
                @if(isset($all_plan[0]))
                {{-- kesini --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table mb-0 table-borderless tbl-server-info">
                                <thead>
                                    <tr class="ligth">
                                       <th scope="col">Deskripsi</th>
                                       <th scope="col">Komentar</th>
                                       <th scope="col">File</th>
                                       <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_plan as $item)
                                        
                                        <tr>
                                            <td>{{ $item->desc_timeline }}</td>
                                            <td>{{ $item->desc_update }}</td>
                                            <td><a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a></td>
                                            <td>
                                                @if($item->status == 1)
                                                    <a href="#" class="btn btn-success">Diterima</a>
                                                @elseif($item->status == 2)
                                                    <a href="#" class="btn btn-danger">Ditolak</a>
                                                @else
                                                    <a class="btn btn-primary text-white" onclick="return status_timeline('{{ $item->id }}','terima')">Accept</a>
                                                    <a class="btn btn-danger text-white" onclick="return status_timeline('{{ $item->id }}','tolak')">Reject</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="design">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="designShow">
                        Design Analysis
                    </h3>
                </div>
                @if(empty($design[0]))
                    <form action="{{ url('project/design_store') }}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" required name="project_id" value="{{ $id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">File*</span>
                                        </div>
                                        <div class="custom-file">
                                        <input type="file" required name="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputText01" class="h5">Catatan*</label>
                                        <textarea required name="desc_timeline" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
                @endif
                @if(isset($all_design[0]))
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table mb-0 table-borderless tbl-server-info">
                                <thead>
                                    <tr class="ligth">
                                       <th scope="col">Deskripsi</th>
                                       <th scope="col">Komentar</th>
                                       <th scope="col">File</th>
                                       <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_design as $item)
                                        
                                        <tr>
                                            <td>{{ $item->desc_timeline }}</td>
                                            <td>{{ $item->desc_update }}</td>
                                            <td><a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a></td>
                                            <td>
                                                @if($item->status == 1)
                                                    <a href="#" class="btn btn-success">Diterima</a>
                                                @elseif($item->status == 2)
                                                    <a href="#" class="btn btn-danger">Ditolak</a>
                                                @else
                                                    <a class="btn btn-primary text-white" onclick="return status_timeline('{{ $item->id }}','terima')">Accept</a>
                                                    <a class="btn btn-danger text-white" onclick="return status_timeline('{{ $item->id }}','tolak')">Reject</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
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
                            <div class="col-lg-12">
                                <a class="btn btn-primary" href="{{ url('project/implementasi_store/'.$id) }}">APPROVE</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="evolution">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="exampleModalCenterTitle02">
                        Evolution
                    </h3>
                </div>
                @if(empty($evolution[0]))
                    <form action="{{ url('project/evolution_store') }}" method="post" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" required name="project_id" value="{{ $id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">File*</span>
                                        </div>
                                        <div class="custom-file">
                                        <input type="file" required name="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="exampleInputText01" class="h5">Catatan*</label>
                                        <textarea required name="desc_timeline" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
                @else
                {{-- kesini --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table mb-0 table-borderless tbl-server-info">
                                <thead>
                                    <tr class="ligth">
                                       <th scope="col">Deskripsi</th>
                                       <th scope="col">File</th>
                                       <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_evolution as $item)
                                        
                                        <tr>
                                            <th>{{ $item->desc_timeline }}</th>
                                            <td><a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a></td>
                                            <td>
                                                @if($item->status == 1)
                                                    <a href="#" class="btn btn-success">Diterima</a>
                                                @elseif($item->status == 2)
                                                    <a href="#" class="btn btn-danger">Ditolak</a>
                                                @else
                                                    <a class="btn btn-primary text-white" onclick="return status_timeline('{{ $item->id }}','terima')">Accept</a>
                                                    <a class="btn btn-danger text-white" onclick="return status_timeline('{{ $item->id }}','tolak')">Reject</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
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
                {
                    title: 'Deadline Planning',
                    start:'{{ $projects->deadline_plan }}',
                    end:'{{ $projects->deadline_plan }}',
                    backgroundColor: '#931F1D'
                },
                {
                    title: 'Deadline Design',
                    start:'{{ $projects->deadline_design }}',
                    end:'{{ $projects->deadline_design }}',
                    backgroundColor: '#931F1D'
                },{
                    title: 'Deadline Testing',
                    start:'{{ $projects->deadline_implementasi }}',
                    end:'{{ $projects->deadline_implementasi }}',
                    backgroundColor: '#931F1D'
                },
                {
                    title: 'Deadline Evolution',
                    start:'{{ $projects->deadline_evolution }}',
                    end:'{{ $projects->deadline_evolution }}',
                    backgroundColor: '#931F1D'
                },
                {
                    title: '{{ $projects->nama_project }}',
                    start:'{{ $projects->waktu_mulai }}',
                    end:'{{ $projects->waktu_selesai }}',
                },
            ],
            selectOverlap: function (event) {
                return event.rendering === 'background';
            }
        });

        calendar.render();
    });
</script>
@endpush