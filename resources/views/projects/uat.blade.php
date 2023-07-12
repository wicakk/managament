@extends('layouts.app')
@section('content')


<video controls width="600" style="display: none"></video>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>UAT Task</h5>
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
                                            <h5 class="mb-2">{{ $item->task_name }} <span id="testing{{ $item->id }}" class="badge badge-warning"> Testing & Record</span>
                                            @isset($item->file_test)
                                                <a href="{{ url('document_testing/'.$item->file_test) }}" target="_blank" class="badge badge-info">Lihat Hasil Testing</a>

                                            @endisset
                                            </h5>
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
                                                    <h5 class="mb-2">UAT Test Detail</h5>
                                                    <p>
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
                                                    </p> 
                                                    <h5 class="mb-2">Description</h5>
                                                    <p class="mb-0">{{ $item->description }}</p>
                                                </div>
                                                <div class="col-lg-6">                                      
                                                    <h5 class="mb-2">Steps For UAT Test</h5>
                                                    <p>
                                                        {!! nl2br($item->steps_for_uat_test) !!}    
                                                    </p> 
                                                    <h5 class="mb-2">Expected Result</h5>
                                                    <p>
                                                        {!! nl2br($item->expected_result) !!}    
                                                    </p>              
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            @if(empty($item->comments))
                                            <form action="{{ url('project_test_uat/store_uat') }}" method="post" enctype="multipart/form-data">
                                            @endif
                                                @csrf
                                                <input type="hidden" name="project_test_id" value="{{ $item->project_test_id }}">
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Actual Result</label>
                                                    <select name="actual_result" required id="actual_result" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <option value="Pass">Pass</option>
                                                        <option value="Fail">Fail</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Result</label>
                                                    <textarea name="result" required id="result" cols="10" rows="3" class="form-control">{{ $item->result }}</textarea>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Comments</label>
                                                    <textarea name="comments" required id="comments" cols="10" rows="3" class="form-control">{{ $item->comments }}</textarea>
                                                </div>
                                                {{-- <img src="{{ url('document_testing/'.$item->file_test) }}" alt="Hasil Test" class="img-fluid" width="200"> --}}
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload Hasil Testing*</span>
                                                    </div>
                                                    <div class="custom-file">
                                                    <input type="file" required name="file" class="custom-file-input" id="inputGroupFile01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                </div>
                                                @if(empty($item->comments))
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

                    <script>
                        // let idbtn = '{{ $item->id }}'
                        var btn = document.querySelector('#testing{{ $item->id }}')
                        btn.addEventListener('click', async function (){
                            let stream = await navigator.mediaDevices.getDisplayMedia({
                                video: true
                            })
                            const mime = MediaRecorder.isTypeSupported("video/webm; codecs=vp9") 
                            ? "video/webm; codecs=vp9" 
                            : "video/webm"
                            let mediaRecorder = new MediaRecorder(stream, {
                                mimeType: mime
                            })
                            // console.log('2')
                            window.open('{{ $item->url_test }}','_blank')
                            
                            let chunks = []
                            mediaRecorder.addEventListener('dataavailable', function(e) {
                                // console.log('3')
                                chunks.push(e.data)
                                // console.log('4')
                            })
                    
                            mediaRecorder.addEventListener('stop', function(){
                                let blob = new Blob(chunks, {
                                    type: chunks[0].type
                                })
                    
                                let video = document.querySelector("video")
                                video.src = URL.createObjectURL(blob)
                    
                                let a = document.createElement('a')
                                a.href = URL.createObjectURL(blob)
                                a.download = 'record_screen.webm'
                                a.click()

                                // window.close();
                            })
                    
                            mediaRecorder.start()
                        })
                </script>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')


@endpush