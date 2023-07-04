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
                    <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped" >
                            <thead>
                                <tr>
                                    <th>UAT Test Case</th>
                                    <th>Description</th>
                                    <th>UAT Test Detail</th>
                                    <th>Step For UAT</th>
                                    <th>Expected Result</th>
                                    <th>Actual Result</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($data as $item)
                                <tr>
                                    <th>{{ $item->uat_test_case }} </th>
                                    <th>{{ nl2br($item->uat_test_desc) }}
                                        @if($item->actual_result == 'Pass')
                                        <span class="badge badge-success text-white">PASS</span>
                                        @elseif($item->actual_result == 'Fail')
                                        <span class="badge badge-danger text-white">FAIL</span>
                                        @endif
                                        @isset($item->file_test)
                                            <a href="{{ url('document_testing/'.$item->file_test) }}" target="_blank" class="badge badge-info text-center">Lihat Hasil Testing</a>
                                        @endisset
                                    </th>
                                    <td>{{ $item->uat_test_detail }}</td>
                                    <td>{{ nl2br($item->steps_for_uat_test) }}</td>
                                    <td>{{ nl2br($item->expected_result) }}</td>
                                    <td>{{ nl2br($item->actual_result) }}</td>
                                    <td>{{ nl2br($item->comments) }}</td>
                                    {{-- <td>
                                        @php
                                        $dibuat = DB::table('users')->where('id',$item->tested_by)->first();
                                        if(isset($dibuat->name)){
                                            echo $dibuat->name;
                                        }
                                        @endphp
                                    </td> --}}
                                    {{-- <td>
                                        @php
                                            $checklist = DB::table('project_detail_checklist')->where('project_detail_id', $item->id)->get();
                                        @endphp
                                        <ol>
                                            @foreach($checklist as $check) 
                                                <li>{{ $check->isi }} @if($check->status == 1) <span class="badge badge-primary">Selesai</span>  @endif</li>
                                            @endforeach
                                        </ol>
                                        
                                    </td> --}}
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