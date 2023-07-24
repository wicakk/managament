<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 18px;
        }


    </style>

</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        {{-- <div style="width: 10%; float:left; margin-right: 20px;">
            <img src="{{ asset('assets/images/logo.jpeg') }}" width="100%"  alt="">
        </div>
        <div style="width: 50%; float: left;">
        </div> --}}
        <h1>Riwayat Task <u>PROJEK : {{ $project->nama_project }}</u></h1>
    </div>

    <table style="position: relative;">
        <thead>
            <tr>
                <th>UAT Test Case</th>
                <th>Description</th>
                <th>Dibuat Pada</th>
                <th>UAT Test Detail</th>
                <th>Step For UAT</th>
                <th>Expected Result</th>
                <th>Actual Result</th>
                <th>Result</th>
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
                <th>{!! nl2br($item->description) !!} <br>
                    @if($item->actual_result == 'Pass')
                    <span class="badge badge-success text-white">PASS</span>
                    @elseif($item->actual_result == 'Fail')
                    <span class="badge badge-danger text-white">FAIL</span>
                    @endif
                </th>
                <td>{{ $item->dibuat }} </td>
                <td>{{ $item->uat_test_detail }}</td>
                <td>{!! nl2br($item->steps_for_uat_test) !!}</td>
                <td>{!! nl2br($item->expected_result) !!}</td>
                <td>{!! nl2br($item->actual_result) !!}</td>
                <td>{!! nl2br($item->result) !!}</td>
                <td>{!! nl2br($item->comments) !!}</td>
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

</body>

</html>