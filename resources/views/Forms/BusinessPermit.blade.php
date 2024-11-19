<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Permit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            line-height: 1.5;
            margin-top: 20px;
        }

        .header img {
            height: 120px;
            opacity: 0.5;
        }

        .header img.left {
            float: left;
            margin-top: -50px;
        }

        .header img.right {
            float: right;
            margin-top: -50px;
        }

        .background-watermark {
            position: absolute;
            top: 170px;
            left: -45px;
            z-index: -1;
            opacity: 0.2;
            height: 600px;
        }

        .main-content {
            margin-top: 150px;
        }

        .certification-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .certification-body {
            margin: 0 auto;
            line-height: 1.8;
            width: 80%;
        }

        .footnote {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
            font-style: italic;
        }

        .signatories {
            margin-top: 100px;
            text-align: right;
            margin-right: 50px;
        }

        .signatories p {
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('img/logo.png') }}" class="left" alt="Barangay Logo">
            <img src="{{ public_path('img/logomanila.png') }}" class="right" alt="Manila Logo">
            <p>Republic of the Philippines</p>
            <p>City of Manila</p>
            <p><u>OFFICE OF THE PUNONG BARANGAY</u></p>
            <p>Barangay 378 Zone 38, District III</p>
            <hr style="width: 85%; margin: 10px auto; opacity: 0.75;">
        </div>

        <!-- Background Watermark -->
        <img src="{{ public_path('img/logomanila.png') }}" class="background-watermark" alt="Barangay Watermark">

        <!-- Title -->
        <div class="certification-title">
            <h2>Barangay Clearance</h2>
        </div>

        <!-- Body -->
        <div class="certification-body">
            <p>To whom it may concern:</p>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that
                @if ($post->gender == 1) Mr.
                @else
                    Ms. @if ($post->civilStatus == 'Married')
                        Mrs.
                    @endif
                @endif
                <b>{{ $post->Resident->lastName }}, {{ $post->Resident->firstName }}
                    {{ $post->Resident->middleName }}</b>
                is hereby granted to operate the business of
                <b>{{ $post->name }}</b> located at
                <b>{{ $post->street }} {{ $post->brgy }} {{ $post->city }}</b>,
                which is within the territorial jurisdiction of this barangay, pursuant to the provision of Section 1520
                of Republic Act No. 7180.
            </p>

            <p align="center">This clearance is issued upon the request of the subject.</p>

            <!-- Footnote -->
            <div class="footnote">
                <p>*This certification is not valid without the official seal of this barangay.</p>
            </div>
        </div>

        <!-- Signatories -->
        <div class="signatories">
            <p>{{ $cman->Resident->lastName }}, {{ $cman->Resident->firstName }} {{ $cman->Resident->middleName }}
            </p>
            <p>{{ $cman->position }}</p>
        </div>
    </div>
</body>

</html>
