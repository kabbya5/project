<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 10px;
        }
        th, td {
            word-wrap: break-word;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;"> Time Log Report</h2>

<table>
    <thead>
        <tr>
            <th>Project</th>
            <th>Start Time </th>
            <th>End Time </th>
            <th> Hours </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($time_logs as $time_log)
            <tr>
                <td>{{ $time_log->project }}</td>
                <td>{{ \Carbon\Carbon::parse($time_log->start_time)->format('l, d M Y h:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($time_log->end_time)->format('l, d M Y h:i A') }}</td>
                <td>{{ $time_log->hours }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
