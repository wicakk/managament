@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Testing</h5>
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
                    @foreach($data as $item)
                    <div class="col-lg-12">
                        <div class="card card-widget task-card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h5 class="mb-2">{{ $item->uat_test_case }}</h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3">Dibuat Oleh : 
                                                    @php
                                                        $dibuat = DB::table('users')->where('id',$item->created_by)->first();
                                                        echo $dibuat->name;
                                                        
                                                    @endphp
                                                </div>
                                                <div class="btn bg-body">Di Testing Oleh : 
                                                    @php
                                                    $dibuat = DB::table('users')->where('id',$item->tested_by)->first();
                                                    echo $dibuat->name;
                                                    
                                                    @endphp
                                                </div>
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
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Description</h5>
                                                    <p class="mb-0">{{ $item->uat_test_desc }}</p>
                                                    <hr>
                                                    <h5 class="mb-2">Details</h5>
                                                    <p class="mb-0">{{ $item->uat_test_detail }}</p>
                                                </div>
                                                <div class="col-lg-6">                                      
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <p>
                                                        {!! nl2br($item->steps_for_uat_test) !!}    
                                                    </p>                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ url('project_detail/update') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="project_detail_id" value="{{ $item->id }}">
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Actual Result</label>
                                                    <select name="actual_result" id="" class="form-control">
                                                        <option @if($item->actual_result == "Pass") selected @endif value="Pass">Pass</option>
                                                        <option @if($item->actual_result == "Fail") selected @endif value="Fail">Fail</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Result</label>
                                                    <input type="text" name="result" class="form-control" value="{{ $item->result }}">
                                                </div>
                                                <div class="form-group mb-3 position-relative">
                                                    <label for="">Comments</label>
                                                    <textarea name="comments" id="comments" cols="10" rows="3" class="form-control">{{ $item->comments }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100" >Kirim Hasil Testing</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                    @endforeach
                    {{-- <div class="col-lg-12">
                        <div class="card card-widget task-card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="custom-control custom-task custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2"></label>
                                        </div>
                                        <div>
                                            <h5 class="mb-2">Create unique style of inner pages</h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3"><i class="ri-align-justify mr-2"></i>5/10</div>
                                                <div class="btn bg-body"><i class="ri-survey-line mr-2"></i>3</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media align-items-center mt-md-0 mt-3">
                                        <a href="#" class="btn bg-success-light mr-3">Design</a>
                                        <a class="btn bg-success-light" data-toggle="collapse" href="#collapseEdit2" role="button" aria-expanded="false" aria-controls="collapseEdit2"><i class="ri-edit-box-line m-0"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                                       
                        <div class="collapse" id="collapseEdit2">                                            
                            <div class="card card-list task-card">
                                <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                    <div class="header-title">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck006">
                                            <label class="custom-control-label h5" for="customCheck006">Mark as done</label>
                                        </div>
                                    </div>
                                    <div><a href="#" class="btn bg-secondary-light">Design</a></div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3 position-relative">
                                        <input type="text" class="form-control bg-white" placeholder="Design landing page of webkit">
                                        <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText2" class="h5">Memebers</label>
                                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                                            <option>Memebers</option>
                                                            <option>Kianna Septimus</option>
                                                            <option>Jaxson Herwitz</option>
                                                            <option>Ryan Schleifer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText4" class="h5">Due Dates*</label>
                                                        <input type="date" class="form-control" id="exampleInputText4" value="">
                                                    </div>                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">                                                        
                                                    <h5 class="mb-2">Description</h5>
                                                    <p class="mb-0">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                                </div>
                                                <div class="col-lg-6">                                      
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                                <label class="custom-control-label mb-1" for="customCheck4">Design mobile version</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck07">
                                                                <label class="custom-control-label mb-1" for="customCheck07">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck6">
                                                                <label class="custom-control-label" for="customCheck6">Vector images of small size.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                                <label class="custom-control-label mb-1" for="customCheck7">Design mobile version of landing page</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck8">
                                                                <label class="custom-control-label mb-1" for="customCheck8">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck9">
                                                                <label class="custom-control-label" for="customCheck9">Vector images of small size..</label>
                                                            </div>
                                                        </div>
                                                    </div>                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="exampleInputText01" class="h5">Attachments</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile002">
                                            <label class="custom-file-label" for="inputGroupFile002">Upload media</label>
                                        </div>
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
                                        <div class="custom-control custom-task custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck10">
                                            <label class="custom-control-label" for="customCheck10"></label>
                                        </div>
                                        <div>
                                            <h5 class="mb-2">Activate from WordPress Dashboard</h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3"><i class="ri-align-justify mr-2"></i>5/10</div>
                                                <div class="btn bg-body"><i class="ri-survey-line mr-2"></i>3</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media align-items-center mt-md-0 mt-3">
                                        <a href="#" class="btn bg-primary-light mr-3">Design</a>
                                        <a class="btn bg-primary-light" data-toggle="collapse" href="#collapseEdit3" role="button" aria-expanded="false" aria-controls="collapseEdit3"><i class="ri-edit-box-line m-0"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                                       
                        <div class="collapse" id="collapseEdit3">                                            
                            <div class="card card-list task-card">
                                <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                    <div class="header-title">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck11">
                                            <label class="custom-control-label h5" for="customCheck11">Mark as done</label>
                                        </div>
                                    </div>
                                    <div><a href="#" class="btn bg-secondary-light">Design</a></div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3 position-relative">
                                        <input type="text" class="form-control bg-white" placeholder="Design landing page of webkit">
                                        <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText2" class="h5">Memebers</label>
                                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                                            <option>Memebers</option>
                                                            <option>Kianna Septimus</option>
                                                            <option>Jaxson Herwitz</option>
                                                            <option>Ryan Schleifer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText5" class="h5">Due Dates*</label>
                                                        <input type="date" class="form-control" id="exampleInputText5" value="">
                                                    </div>                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">                                                        
                                                    <h5 class="mb-2">Description</h5>
                                                    <p class="mb-0">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                                </div>
                                                <div class="col-lg-6">                                      
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck12">
                                                                <label class="custom-control-label mb-1" for="customCheck12">Design mobile version</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck13">
                                                                <label class="custom-control-label mb-1" for="customCheck13">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck14">
                                                                <label class="custom-control-label" for="customCheck14">Vector images of small size.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck15">
                                                                <label class="custom-control-label mb-1" for="customCheck15">Design mobile version of landing page</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck16">
                                                                <label class="custom-control-label mb-1" for="customCheck16">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck17">
                                                                <label class="custom-control-label" for="customCheck17">Vector images of small size..</label>
                                                            </div>
                                                        </div>
                                                    </div>                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="exampleInputText01" class="h5">Attachments</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                                            <label class="custom-file-label" for="inputGroupFile03">Upload media</label>
                                        </div>
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
                                        <div class="custom-control custom-task custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck18">
                                            <label class="custom-control-label" for="customCheck18"></label>
                                        </div>
                                        <div>
                                            <h5 class="mb-2">Add code to output Post Title & Text</h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3"><i class="ri-align-justify mr-2"></i>5/10</div>
                                                <div class="btn bg-body"><i class="ri-survey-line mr-2"></i>3</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media align-items-center mt-md-0 mt-3">
                                        <a href="#" class="btn bg-info-light mr-3">Design</a>
                                        <a class="btn bg-info-light" data-toggle="collapse" href="#collapseEdit4" role="button" aria-expanded="false" aria-controls="collapseEdit4"><i class="ri-edit-box-line m-0"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                                       
                        <div class="collapse" id="collapseEdit4">                                            
                            <div class="card card-list task-card">
                                <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                    <div class="header-title">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck19">
                                            <label class="custom-control-label h5" for="customCheck19">Mark as done</label>
                                        </div>
                                    </div>
                                    <div><a href="#" class="btn bg-secondary-light">Design</a></div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3 position-relative">
                                        <input type="text" class="form-control bg-white" placeholder="Design landing page of webkit">
                                        <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText2" class="h5">Memebers</label>
                                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                                            <option>Memebers</option>
                                                            <option>Kianna Septimus</option>
                                                            <option>Jaxson Herwitz</option>
                                                            <option>Ryan Schleifer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText6" class="h5">Due Dates*</label>
                                                        <input type="date" class="form-control" id="exampleInputText6" value="">
                                                    </div>                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">                                                        
                                                    <h5 class="mb-2">Description</h5>
                                                    <p class="mb-0">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                                </div>
                                                <div class="col-lg-6">                                      
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck20">
                                                                <label class="custom-control-label mb-1" for="customCheck20">Design mobile version</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck21">
                                                                <label class="custom-control-label mb-1" for="customCheck21">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck22">
                                                                <label class="custom-control-label" for="customCheck22">Vector images of small size.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck23">
                                                                <label class="custom-control-label mb-1" for="customCheck23">Design mobile version of landing page</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck24">
                                                                <label class="custom-control-label mb-1" for="customCheck24">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck25">
                                                                <label class="custom-control-label" for="customCheck25">Vector images of small size..</label>
                                                            </div>
                                                        </div>
                                                    </div>                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="exampleInputText01" class="h5">Attachments</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile04">
                                            <label class="custom-file-label" for="inputGroupFile04">Upload media</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-widget task-card mb-0">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="custom-control custom-task custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck26">
                                            <label class="custom-control-label" for="customCheck26"></label>
                                        </div>
                                        <div>
                                            <h5 class="mb-2">Add Header and Footer To Template</h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3"><i class="ri-align-justify mr-2"></i>5/10</div>
                                                <div class="btn bg-body"><i class="ri-survey-line mr-2"></i>3</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media align-items-center mt-md-0 mt-3">
                                        <a href="#" class="btn bg-secondary-light mr-3">Design</a>
                                        <a class="btn bg-secondary-light" data-toggle="collapse" href="#collapseEdit5" role="button" aria-expanded="false" aria-controls="collapseEdit5"><i class="ri-edit-box-line m-0"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                                                                       
                        <div class="collapse" id="collapseEdit5">                                            
                            <div class="card card-list task-card">
                                <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                    <div class="header-title">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="customCheck27">
                                            <label class="custom-control-label h5" for="customCheck27">Mark as done</label>
                                        </div>
                                    </div>
                                    <div><a href="#" class="btn bg-secondary-light">Design</a></div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3 position-relative">
                                        <input type="text" class="form-control bg-white" placeholder="Design landing page of webkit">
                                        <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText2" class="h5">Memebers</label>
                                                        <select name="type" class="selectpicker form-control" data-style="py-0">
                                                            <option>Memebers</option>
                                                            <option>Kianna Septimus</option>
                                                            <option>Jaxson Herwitz</option>
                                                            <option>Ryan Schleifer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-0">
                                                        <label for="exampleInputText7" class="h5">Due Dates*</label>
                                                        <input type="date" class="form-control" id="exampleInputText7" value="">
                                                    </div>                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">                                                        
                                                    <h5 class="mb-2">Description</h5>
                                                    <p class="mb-0">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                                </div>
                                                <div class="col-lg-6">                                      
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck28">
                                                                <label class="custom-control-label mb-1" for="customCheck28">Design mobile version</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck29">
                                                                <label class="custom-control-label mb-1" for="customCheck29">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck30">
                                                                <label class="custom-control-label" for="customCheck30">Vector images of small size.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck31">
                                                                <label class="custom-control-label mb-1" for="customCheck31">Design mobile version of landing page</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck32">
                                                                <label class="custom-control-label mb-1" for="customCheck32">Use images of unsplash.com</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck33">
                                                                <label class="custom-control-label" for="customCheck33">Vector images of small size..</label>
                                                            </div>
                                                        </div>
                                                    </div>                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="exampleInputText01" class="h5">Attachments</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile05">
                                            <label class="custom-file-label" for="inputGroupFile05">Upload media</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> --}}
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


@endsection