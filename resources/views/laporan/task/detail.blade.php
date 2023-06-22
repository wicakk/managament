@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Riwayat Task</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="container">
                        <table id="datatable" class="table data-table table-striped" >
                            <thead>
                                <tr>
                                    <th>Task Name</th>
                                    <th>Due Dates</th>
                                    <th>Actual Result</th>
                                    <th>Comments</th>
                                    <th>Checklist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($data as $item)
                                <tr>
                                    <th>{{ $item->task_name }}</th>
                                    <td>{{ $item->due_dates }}</td>
                                    <td>{{ nl2br($item->actual_result_qa) }}</td>
                                    <td>{{ nl2br($item->comments_qa) }}</td>
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
                                @php $no++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


