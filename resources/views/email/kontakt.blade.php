<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kontaktní formulář</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }

        .content p {
            margin: 10px 0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Nová zpráva z kontaktního formuláře</h2>
    </div>

    <div class="content">
        <p><strong>Od:</strong> {{ $data['email'] }}</p>
        <p><strong>Předmět:</strong> {{ $data['predmet'] }}</p>
        <p><strong>Zpráva:</strong></p>
        <p style="white-space: pre-line;">{{ $data['zprava'] }}</p>
    </div>

    <div class="footer">
        <p>Tato zpráva byla odeslána z kontaktního formuláře vašeho webu.</p>
    </div>
</body>

</html>