<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Objednávka připravena - {{$objednavka->id}} - Restaurace Na Rohu</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        main {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2d3748;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .highlight {
            color: #48bb78;
            font-weight: bold;
        }

        .message {
            background-color: #f0fff4;
            border-left: 4px solid #48bb78;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #718096;
        }

        .contact-info {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <main>
        <h1>Dobrý den,</h1>

        <div class="message">
            <p>Vaše objednávka číslo <span class="highlight">{{ $objednavka->id }}</span> je připravena k vyzvednutí!</p>
        </div>

        <p>Můžete si ji vyzvednout na adrese:</p>
        <p>
            <strong>Restaurace Na Rohu</strong><br>
            Karla IV. 13 <br>
            530 02 Pardubice I
        </p>


        <p>Otevírací doba pro vyzvednutí:</p>
        <ul>
            <li>Po-Ne: 11:00 - 22:00</li>
        </ul>

        <div class="contact-info">
            <p>V případě jakýchkoliv dotazů nás neváhejte kontaktovat:</p>
            <p>Tel.: +420 123 456 789<br>
                Email: <a href="mailto:info@narohu.cz">info@narohu.cz</a></p>
        </div>

        <div class="footer">
            <p>S přáním hezkého dne,</p>
            <p>Tým Restaurace Na Rohu</p>
        </div>
    </main>
</body>

</html>