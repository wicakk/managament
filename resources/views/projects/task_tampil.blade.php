@php
$role = ['PM',''];
    $no = 0;
@endphp
@foreach($data as $item)
<div class="col-lg-12">
    <div class="card card-widget task-card">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-2">{{ $item->task_name }} <span class="badge badge-warning">{{ $item->checklist }} <br> Batas Akhir : {{ $item->due_dates }}</span></h5>
                        <div class="media align-items-center">
                            <div class="btn bg-body mr-3">Created By :
                                @php
                                    $dibuat = DB::table('users')->where('id',$item->created_by)->first();
                                    echo $dibuat->name;
                                @endphp
                            </div>
                            <div class="btn bg-body">worked by :
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
                    @if(Carbon::create($item->due_dates) >= Carbon::now() && in_array(Session::get('role'),$role) )
                    <a class="btn bg-primary-light" onclick="return edit_detail('{{ $item->id }}')" aria-expanded="false" >EDIT</a>
                    @endif
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

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if(Session::get('role') == "developer")
                        @if(Carbon::create($item->due_dates) >= Carbon::now())
                        <form action="{{ url('project_detail_checklist') }}" method="post" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <input type="hidden" required name="project_detail_id" value="{{ $item->id }}">
                            <h5 class="mb-2">UAT Test Detail/Detail</h5>
                            <div class="row">
                                @php
                                    $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                @endphp
                                @foreach($checklist as $check)
                                <div class="col-lg-6">
                                    <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                        <input type="checkbox" value="{{ $check->id }}" name="project_checklist[]" class="custom-control-input" id="customCheck{{ $check->id }}" @if($check->status == 1) checked @endif>
                                        <label class="custom-control-label mb-1" for="customCheck{{ $check->id }}">{{ $check->isi }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>  <br>
                            @if(Carbon::create($item->due_dates) >= Carbon::now())
                            <button type="submit" class="btn btn-primary w-100" >Update Progress</button>
                            @endif
                        </form>
                        @else
                        <h5 class="mb-2">UAT Test Detail/Checklist</h5>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php $no++ @endphp
@endforeach
