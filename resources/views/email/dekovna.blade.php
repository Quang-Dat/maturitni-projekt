<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faktura - {{$objednavka->id}} - Restaurace Na Rohu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        main {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            max-width: 200px;
            height: auto;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        p {
            margin-bottom: 15px;
            color: #555555;
            font-size: 16px;
        }

        .signature {
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .restaurant-name {
            color: #c41e3a;
            font-weight: bold;
            font-size: 18px;
        }

        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }

            main {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <main>
        <div class="logo">
            <img src="{{ asset('storage/img/logo.jpg') }}" alt="Restaurace Na Rohu">
        </div>

        <h1>Dobrý den,</h1>

        <p>děkujeme za vaši objednávku. V příloze naleznete fakturu k objednávce č. <strong>{{ $objednavka->id }}</strong>.</p>

        <div class="signature">
            <p>S pozdravem,</p>
            <p class="restaurant-name">Restaurace Na Rohu</p>
            <p style="font-size: 14px; color: #666;">
                Karla IV. 13<br>
                530 02 Pardubice<br>
                Tel: +420 123 456 789<br>
                Email: info@narohu.cz
            </p>
        </div>
    </main>
</body>

</html>