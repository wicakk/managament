@extends('layouts.app')
@section('content')
    <div class="container-fluid timeline-page">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Small Dots Timeline</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                            <ul class="list-inline p-0 m-0">
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-primary text-primary"></div>
                                    <h6 class="float-left mb-1">Planing & Organizing 
                                        
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
                                            data-toggle="modal"><span class="badge badge-warning">Upload</span></a>
                                        @endif
                                    </h6>
                                    <small class="float-right mt-1">23 November 2019</small>
                                    <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-primary text-primary"></div>
                                    <h6 class="float-left mb-1">Implementasi & Testing <a href="#" data-target="#implementasi"
                                        data-toggle="modal"><span class="badge badge-danger">Pending</span></a></h6>
                                    <small class="float-right mt-1">19 November 2019</small>
                                    <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-dots timeline-dot1 border-warning text-warning"></div>
                                    <h6 class="float-left mb-1">Evolution <a href="#" data-target="#evolution"
                                        data-toggle="modal"><span class="badge badge-danger">Pending</span></a></h6>
                                    <small class="float-right mt-1">15 November 2019</small>
                                    <div class="d-inline-block w-100">
                                        <p>Bonbon macaroon jelly beans gummi bears jelly lollipop apple</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                        <input type="hidden" name="project_id" value="{{ $id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
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
                                        <label for="exampleInputText01" class="h5">Catatan*</label>
                                        <textarea name="desc_timeline" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
                                    @foreach($plan as $item)
                                        
                                        <tr>
                                            <th>{{ $item->desc_timeline }}</th>
                                            <td><a href="{{ url('document_timeline/'.$item->file_upload) }}" target="_blank" class="btn btn-primary">Lihat File </a></td>
                                            <td>
                                                @if($item->status == 1)
                                                    <a href="#" class="btn btn-success">Diterima</a>
                                                @elseif($item->status == 2)
                                                    <a href="#" class="btn btn-danger">Ditolak</a>
                                                @else
                                                    <a onclick="return confirm('Apakah anda yakin ingin di terima?')" href="{{ url('project_timeline/status/terima/'.$item->id) }}" class="btn btn-primary">Accept</a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin di Tolak?')" href="{{ url('project_timeline/status/tolak/'.$item->id) }}" class="btn btn-danger">Reject</a>
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
                    <h3 class="modal-title" id="exampleModalCenterTitle02">
                        Design Analysis
                    </h3>
                </div>
                <form action="{{ url('project/design') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="project_id" value="{{ $id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">File*</span>
                                    </div>
                                    <div class="custom-file">
                                       <input type="file" name="file_planning" class="custom-file-input" id="inputGroupFile01">
                                       <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                 </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputText01" class="h5">Catatan*</label>
                                    <textarea name="catatan_planing" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="implementasi">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="exampleModalCenterTitle02">
                        Planning & Organizing
                    </h3>
                </div>
                <form action="{{ url('projects') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="project_id" value="{{ $id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">File*</span>
                                    </div>
                                    <div class="custom-file">
                                       <input type="file" name="file_planning" class="custom-file-input" id="inputGroupFile01">
                                       <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                 </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputText01" class="h5">Catatan*</label>
                                    <textarea name="catatan_planing" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="evolution">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bttom">
                    <h3 class="modal-title" id="exampleModalCenterTitle02">
                        Planning & Organizing
                    </h3>
                </div>
                <form action="{{ url('projects') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="project_id" value="{{ $id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">File*</span>
                                    </div>
                                    <div class="custom-file">
                                       <input type="file" name="file_planning" class="custom-file-input" id="inputGroupFile01">
                                       <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                 </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputText01" class="h5">Catatan*</label>
                                    <textarea name="catatan_planing" id="catatan_planing" cols="30" rows="4" class="form-control"></textarea>
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
@endsection

@push('script')
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
</script>

@endpush