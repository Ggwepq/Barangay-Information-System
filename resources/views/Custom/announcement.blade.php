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
            color: #0056b3;
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
            <h1>📢 {{ $title }}</h1>
        </div>
        <div class="content">
            {!! $content !!}
        </div>
        <div class="footer">
            <p>Stay updated via the Barangay Information System!</p>
        </div>
    </div>
</body>

</html>
