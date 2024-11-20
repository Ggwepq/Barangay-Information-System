<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Case Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .header p {
            margin: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            font-size: 0.9rem;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        .case-number {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <p>Republic of the Philippines</p>
        <p>City of Manila</p>
        <p>District III, Barangay 378</p>
        <p>Period Covered:
            {{ Carbon\Carbon::parse($start)->toFormattedDateString() }} -
            {{ Carbon\Carbon::parse($end)->toFormattedDateString() }}
        </p>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Case No.</th>
                <th>Complainant</th>
                <th>Complained Resident</th>
                <th>Date of Filing</th>
                <th>Person-in-Charge</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $posts)
                <tr>
                    <?php $caseNo = str_pad($posts->id, 5, '0', STR_PAD_LEFT); ?>
                    <td class="case-number">{{ $caseNo }}</td>
                    <td>{{ $posts->com->firstName }} {{ $posts->com->middleName }} {{ $posts->com->lastName }}</td>
                    <td>{{ $posts->comRes->firstName }} {{ $posts->comRes->middleName }} {{ $posts->comRes->lastName }}
                    </td>
                    <td>{{ Carbon\Carbon::parse($posts->created_at)->toFormattedDateString() }}</td>
                    <td>{{ $posts->officerCharge }}</td>
                    <td>
                        @if ($posts->status == 1)
                            Pending
                        @elseif ($posts->status == 2)
                            Ongoing
                        @elseif ($posts->status == 3)
                            Resolved Issue
                        @else
                            File to Action
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
