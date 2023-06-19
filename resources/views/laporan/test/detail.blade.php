@extends('layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>RIWAYAT UAT</h5>
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
                    <div class="table-responsive">
                        <table class="table table-boreder">
                            <thead>
                                <tr>
                                    <th>Task Name</th>
                                    <th>Due Dates</th>
                                    <th>Result</th>
                                    <th>Comments</th>
                                    <th>Created By</th>
                                    <th>Checklist</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ $item->task_name }}
                                        @if($item->actual_result == 'Fail')
                                        <span class="btn btn-danger text-white">FAIL</span>
                                        @else
                                        <span class="btn btn-success">PASS</span>
                                        @endif
                                    </th>
                                    <td>{{ $item->due_dates }}</td>
                                    <td>{{ nl2br($item->result) }}</td>
                                    <td>{{ nl2br($item->comments) }}</td>
                                    <td>
                                        @php
                                        $dibuat = DB::table('users')->where('id',$item->tested_by)->first();
                                        if(isset($dibuat->name)){
                                            echo $dibuat->name;
                                        }
                                        
                                        @endphp
                                    </td>
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
                            </tbody>
                        </table>
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