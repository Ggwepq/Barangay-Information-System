<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification to File Action</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
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

        .header-content {
            line-height: 1;
            margin-top: -50px
        }

        .main-content {
            margin: 50px auto 0;
        }

        .case-number {
            text-align: center;
        }

        .parties {
            text-align: center;
            margin: 50px 0;
        }

        .certification-title {
            text-align: center;
            margin: 11px 0;
        }

        .certification-body {
            margin: 0 auto;
            line-height: 1.8;
            width: 80%;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.9rem;
        }

        .signatories {
            margin-top: 100px;
            display: flex;
            justify-content: flex-end;
            text-align: center;
        }

        .signatories div {
            display: block;
            vertical-align: middle;
        }

        .footnote {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path($settings->logo) }}" class="left" alt="Barangay Logo">
            <img src="{{ public_path('img/logomanila.png') }}" class="right" alt="Manila Logo">
            <div class="header-content">
                <p>Republic of the Philippines</p>
                <p>City of {{ ucwords(strtolower(str_replace('CITY', '', $settings->city))) }}</p>
                <p><u>OFFICE OF THE PUNONG BARANGAY</u></p>
                <p>{{ ucwords(strtolower($settings->barangay_name)) }} Zone {{ $settings->zone }}, District
                    {{ $settings->district }}</p>
                <hr style="width: 85%; margin: 10px auto; opacity: 0.75;">
            </div>
        </div>

        <!-- Case Details -->
        <div class="main-content">
            <div class="case-number">
                <?php $caseNo = str_pad($post->id, 5, '0', STR_PAD_LEFT); ?>
                <p>Barangay Case No. <span style="color:Red;">{{ $caseNo }}</span></p>
            </div>


            <!-- Certification Title -->
            <div class="certification-title">
                <h3>CERTIFICATION TO FILE ACTION</h3>
            </div>

            <!-- Certification Body -->
            <div class="certification-body">
                <p>THIS IS TO CERTIFY THAT:</p>
                <p>No settlement/conciliation was reached by both parties and therefore the responding complaint may now
                    be filed in court.</p>
                <p>Issued on <strong>{{ Carbon\Carbon::now()->toFormattedDateString() }}</strong> at
                    {{ ucwords(strtolower($settings->barangay_name)) }}, City of
                    {{ ucwords(strtolower(str_replace('CITY', '', $settings->city))) }}, Philippines.</p>
            </div>

            <!-- Footer -->
            <div class="footnote">
                <p>*This certification is not valid without the official seal of this barangay.</p>
            </div>
            <!-- Parties -->
            <div class="parties">
                <div>
                    <p><strong>{{ $post->com->lastName }}, {{ $post->com->firstName }}</strong></p>
                    <p>Complainant</p>
                </div>
                <div>
                    <p><strong>{{ $post->comRes->lastName }}, {{ $post->comRes->firstName }}</strong></p>
                    <p>Respondent</p>
                </div>
            </div>

            <!-- Signatories -->
            <div class="signatories">
                <div>
                    <p>{{ $cman->Resident->lastName }}, {{ $cman->Resident->firstName }}
                        {{ $cman->Resident->middleName }}</p>
                    <p>{{ $cman->position->position_name }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
