<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test de paiement</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body class="antialiased">
    <div class="container">
        <div class="alert {{ $data['data']['status']=="ACCEPTED"?"alert-success":"alert-danger" }} " role="alert">
        <h1>{{ $data['message'] }}</h1>
        <p>{{ $data['data']['status'] }}</p>
        <hr>
        <p>Montant :{{ $data['data']['amount'] . $data['data']['currency'] }}</p>
        <p>Opérateur : {{ $data['data']['payment_method'] }}</p>
        <p>Description :{{ $data['data']['description'] }}</p>
        <p>Date :{{ $data['data']['payment_date'] }}</p><br>
        <a href="{{ route('retour') }}" class="alert-link">Retour à l'accueil</a>
    </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
