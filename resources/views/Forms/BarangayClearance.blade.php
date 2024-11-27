<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Certification</title>
    <style>
        .container {
            position: relative;
            padding: 10px;
        }

        .header {
            text-align: center;
        }

        .header-content {
            margin-top: 20px;
        }

        .header p {
            margin: 0;
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

        .watermark {
            position: absolute;
            top: 170px;
            right: 75px;
            z-index: -1;
            opacity: 0.3;
        }

        .main-content {
            margin: 150px auto 0;
            text-align: center;
            line-height: 1.5;
        }

        .content {
            margin-top: 50px;
            text-align: justify;
        }

        .certification-details {
            margin: 20px 0;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }

        .row::after {
            content: "";
            display: table;
            clear: both;
        }

        li {
            list-style-type: none;
        }

        .footer {
            margin-top: 100px;
            display: flex;
            justify-content: space-between;
        }

        .footer p {
            margin: 0;
            line-height: 1.5;
            text-align: center;
        }

        .dry-seal {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('img/logo.png') }}" class="left" alt="Barangay Logo">
            <img src="{{ public_path('img/logomanila.png') }}" class="right" alt="Manila Logo">

            <div class="header-content">
                <p>Republic of the Philippines</p>
                <p>City of Manila</p>
                <p>District III, Barangay 378</p>
            </div>
        </div>

        <!-- Watermark -->
        <img src="{{ public_path('img/logomanila.png') }}" class="watermark" height="600px" alt="Watermark">

        <!-- Main Content -->
        <div class="main-content">
            <h2>Office of the Barangay Chairman</h2>
            <h3>Barangay Certification</h3>
        </div>

        <div class="content">
            <p>To whom it may concern:</p>
            <p>
                This is to certify that
                @if ($post->gender == 1) Mr.
                @else
                    Ms.
                    @if ($post->civilStatus == 'Married')
                        Mrs.
                    @endif
                @endif
                <b>{{ $post->lastName }}, {{ $post->firstName }} {{ $post->middleName }}</b>, of legal age, is a bona
                fide resident of this barangay, residing at
                <b>{{ $post->street }} {{ $post->brgy }} {{ $post->city }}</b>. They are known to me to be of good
                moral character.
            </p>
            <p>
                Further, as per records in this office, the subject
                @if ($post->isDerogatory == 1)
                    has no derogatory record
                @else
                    had a derogatory record(s)
                @endif
                as of this date.
            </p>
            <p>
                This certification is issued upon the request of the aforementioned person for:
            </p>

            <!-- Purpose List -->
            <div class="row">
                <div class="column">
                    <li>__ Local Employment</li>
                    <li>__ Travel Abroad</li>
                    <li>__ Loan Purpose</li>
                    <li>__ Open Account</li>
                    <li>__ Tricycle Franchise</li>
                </div>
                <div class="column">
                    <li>__ Local Employment</li>
                    <li>__ Travel Abroad</li>
                    <li>__ Loan Purpose</li>
                    <li>__ Open Account</li>
                    <li>__ Tricycle Franchise</li>
                </div>
            </div>

            <p class="certification-details">
                Given this <b>{{ Carbon\Carbon::now()->toFormattedDateString() }}</b> at Barangay 378, City of Manila,
                Philippines.
            </p>
        </div>

        <!-- Dry Seal Notice -->
        <p class="dry-seal">NOT VALID WITHOUT THE BARANGAY DRY SEAL</p>

        <!-- Footer -->
        <div class="footer">
            <div>
                <p>{{ $sec->Resident->lastName }}, {{ $sec->Resident->firstName }} {{ $sec->Resident->middleName }}
                </p>
                <p>{{ $sec->position->position_name }}</p>
            </div>
            <div>
                <p>{{ $cman->Resident->lastName }}, {{ $cman->Resident->firstName }}
                    {{ $cman->Resident->middleName }}</p>
                <p>{{ $cman->position->position_name }}</p>
            </div>
        </div>
    </div>
</body>

</html>
