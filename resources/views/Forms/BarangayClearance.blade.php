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

        .main-content {
            margin: 25px auto 0;
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
            <img src="{{ public_path($settings->logo) }}" class="left" alt="Barangay Logo">
            <img src="{{ public_path('img/logomanila.png') }}" class="right" alt="Manila Logo">

            <p>Republic of the Philippines</p>
            <p>City of {{ ucwords(strtolower(str_replace('CITY', '', $settings->city))) }}</p>
            <p><u>OFFICE OF THE PUNONG BARANGAY</u></p>
            <p>{{ ucwords(strtolower($settings->barangay_name)) }} Zone {{ $settings->zone }}, District
                {{ $settings->district }}</p>
            <hr style="width: 85%; margin: 10px auto; opacity: 0.75;">
        </div>

        <!-- Watermark -->
        <img src="{{ public_path('img/logomanila.png') }}" class="watermark" height="600px" alt="Watermark">

        <!-- Main Content -->
        <div class="main-content">
            <h2>Office of the Barangay Chairman</h2>
            <h3>Barangay Clearance</h3>
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
                <b>{{ $post->street }} {{ $post->brgy }} {{ $post->city }}</b>. They are known to me to be of
                good
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
                Given this <b>{{ Carbon\Carbon::now()->toFormattedDateString() }}</b> at
                {{ ucwords(strtolower($settings->barangay_name)) }}, City of
                {{ ucwords(strtolower(str_replace('CITY', '', $settings->city))) }},
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
