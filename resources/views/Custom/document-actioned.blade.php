<!DOCTYPE html>
<html>

<head>
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 90%;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            color: #28a745;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📄 Document Update</h1>
        </div>
        <div class="content">
            <p>Your request for the document <strong>{{ $docType }}</strong> has been
                <strong>{{ $actioned }}</strong> by the Barangay Office.
            </p>
            <p>Please check the system for more details.</p>
        </div>
        <div class="footer">
            <p>Thank you for using the Barangay Information System!</p>
        </div>
    </div>
</body>

</html>
