@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Monitoring</h5>
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
                                            <h5 class="mb-2">{{ $item->task_name }} </h5>
                                            <div class="media align-items-center">
                                                <div class="btn bg-body mr-3">Dibuat Oleh : 
                                                    @php
                                                        $dibuat = DB::table('users')->where('id',$item->created_by)->first();
                                                        if(isset($dibuat->name)){
                                                            echo $dibuat->name;
                                                        }
                                                        
                                                    @endphp
                                                </div>
                                                <div class="btn bg-body">Di Kerjaakan : 
                                                    @php
                                                    $dikerjakan = DB::table('users')->where('id',$item->assigned_to)->first();
                                                    if(isset($dikerjakan->name)){
                                                        echo $dikerjakan->name;
                                                    }
                                                    
                                                    @endphp
                                                </div>
                                                <div class="btn bg-body">Di QA oleh : 
                                                    @php
                                                    $diqa = DB::table('users')->where('id',$item->qa_by)->first();
                                                    if(isset($diqa->name)){
                                                        echo $diqa->name;
                                                    }
                                                    
                                                    @endphp
                                                </div>
                                                <div class="btn bg-body">Di Testing Oleh: 
                                                    @php
                                                    $ditesting = DB::table('users')->where('id',$item->tested_by)->first();
                                                    if(isset($ditesting->name)){
                                                        echo $ditesting->name;
                                                    }
                                                    
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
                                        <h5>Detail Progress</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <p>
                                                        {!! nl2br($item->checklist) !!}    
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
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h5 class="mb-2">Checklist</h5>
                                                    <p>
                                                        {!! nl2br($item->checklist) !!}    
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


