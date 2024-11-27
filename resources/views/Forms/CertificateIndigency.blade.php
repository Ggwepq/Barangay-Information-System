<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Indigency</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            position: relative;
        }

        .header {
            text-align: center;
        }

        .header img {
            height: 120px;
            opacity: 0.5;
        }

        .header img.left {
            float: left;
        }

        .header img.right {
            float: right;
        }

        .header-title {
            position: relative;
            text-align: center;
            margin-top: 100px;
        }

        .header-title h2 {
            margin: 0;
            font-size: 1.8rem;
        }

        .watermark {
            position: absolute;
            top: 170px;
            right: 75px;
            z-index: -1;
            opacity: 0.3;
        }

        .content {
            margin: 50px auto 0;
            text-align: center;
            line-height: 1.8;
        }

        .footnote {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
            font-style: italic;
        }

        .footer {
            margin-top: 100px;
            display: flex;
            justify-content: flex-end;
            text-align: center;
        }

        .footer p {
            margin: 0;
            line-height: 1.5;
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

        <!-- Watermark -->
        <img src="{{ public_path('img/logomanila.png') }}" class="watermark" height="600px" alt="Watermark">

        <!-- Certificate Title -->
        <div class="header-title">
            <h2>Certificate of Indigency</h2>
        </div>

        <!-- Main Content -->
        <div class="content">
            <p>To whom it may concern:</p>
            <p>
                This is to certify that <b>{{ $post->lastName }}, {{ $post->firstName }} {{ $post->middleName }}</b>,
                of legal age, presently residing at <b>{{ $post->street }} {{ $post->brgy }} {{ $post->city }}</b>,
                is a bona fide resident of Barangay 378, Zone 38, 3rd District, Manila.
            </p>
            <p>
                @if ($post->gender == 1)
                    He
                @else
                    She
                @endif is known to be a person of good moral character and a law-abiding citizen.
            </p>
            <p>
                For further information, _____________________ belongs to the indigent families of this barangay.
            </p>
            <p>
                This certification is issued upon the bearer's request for whatever legal purposes it may serve best.
            </p>
            <p>
                Issued on <b>{{ Carbon\Carbon::now()->toFormattedDateString() }}</b> at Barangay 378, City of Manila,
                Philippines.
            </p>

            <!-- Footnote -->
            <p class="footnote">*This certification is not valid without the official seal of this barangay.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>
                <p>{{ $cman->Resident->lastName }}, {{ $cman->Resident->firstName }}
                    {{ $cman->Resident->middleName }}</p>
                <p>{{ $cman->position->position_name }}</p>
            </div>
        </div>
    </div>
</body>

</html>
