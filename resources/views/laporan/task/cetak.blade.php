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
                <th>No</th>
                <th>Task Name</th>
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
                $no = 1;
            @endphp
            @foreach($data as $item)
            <tr>
                <th>{{ $no }}</th>
                <th>{{ $item->task_name }}</th>
                <th>{!! nl2br($item->description) !!}</th>
                <td>{{ $item->uat_test_detail }}</td>
                <td>{!! nl2br($item->steps_for_uat_test) !!}</td>
                <td>{!! nl2br($item->expected_result) !!}</td>
                <td>{!! nl2br($item->actual_result) !!}</td>
                <td>{!! nl2br($item->comments) !!}</td>
                {{-- <td>{{ $item->due_dates }}</td>
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
                </td> --}}
            </tr>
            @php $no++ @endphp
            @endforeach
        </tbody>
    </table>

</body>

</html>