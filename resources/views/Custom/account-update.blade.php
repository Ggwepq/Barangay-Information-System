        <!DOCTYPE html>
        <html lang='en'>

        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>{{ $subject }}</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                    color: #333;
                    line-height: 1.6;
                    margin: 0;
                    padding: 0;
                }

                .email-container {
                    max-width: 600px;
                    margin: 20px auto;
                    background: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                }

                .header {
                    background-color: #007bff;
                    color: white;
                    padding: 20px;
                    text-align: center;
                    font-size: 24px;
                }

                .content {
                    padding: 20px;
                }

                .content h2 {
                    color: #333;
                }

                .content p {
                    margin: 10px 0;
                }

                .content .details {
                    background: #f1f1f1;
                    padding: 15px;
                    border-radius: 5px;
                    font-size: 16px;
                }

                .footer {
                    text-align: center;
                    padding: 10px;
                    background-color: #f1f1f1;
                    color: #555;
                    font-size: 14px;
                }
            </style>
        </head>

        <body>
            <div class='email-container'>
                <div class='content'>
                    <h2>Hello {{ $recipientName }} 👋,</h2>
                    <p>
                        Your account for the Barangay Information System has been successfully updated!
                        Here are your updated account details:
                    </p>
                    <div class='details'>
                        <p><strong>✉️ Email:</strong> {{ $email }}</p>
                        <p><strong>🔒 Password:</strong> {{ $password }}</p>
                    </div>
                    <p>
                        If you encounter any issues, feel free to contact the barangay.
                    </p>
                </div>
                <div class='footer'>
                    <p>&copy; " . date('Y') . ' Barangay Information System. All rights reserved.</p>
                </div>
            </div>
        </body>

        </html>
