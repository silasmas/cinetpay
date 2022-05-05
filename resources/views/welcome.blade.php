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
        <div class="row justify-content-md-center mb-3">
            <div class="col col-md-9">
                <h2>Formulaire de paiement Cinet pay pour proxydoc</h2>
            </div>
        </div><br>
            <div class="row justify-content-md-center">
            <div class="col col-md-12">
                <form action="{{ route('init') }}" method="post" class="form-control row g-3">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Montant :</label>
                        <input type="text" name="montant" value="100" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Devise (CDF ou USD) :</label>
                        <input type="text" name="devise" value="CDF" class="form-control">
                    </div>
                    {{-- <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"></label>
                    <input type="text" name="alternative_currency" value="" class="form-control">
                </div> --}}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description (raison de paiement)
                            :</label>
                        <input type="text" name="description" value="juste pour testé" class="form-control" required>
                    </div>
                    {{-- <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"></label>
                    <input type="text" name="customer_id" value="123" class="form-control">
                </div> --}}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Votre nom :</label>
                        <input type="text" name="payer_name" value="masimango" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Votre prenom :</label>
                        <input type="text" name="payer_surname" value="silas" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Votre e-ùail :</label>
                        <input type="text" name="payer_mail" value="silasjmas@gmail.com" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Téléphone :</label>
                        <input type="text" name="phone" value="+243827839232" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Adresse :</label>
                        <input type="text" name="adresse" value="limeté" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Ville :</label>
                        <input type="text" name="ville" value="KINSHASA" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="exampleInputEmail1" class="form-label">Pays </label> --}}
                        <input type="text" name="customer_country" value="CM" class="form-control" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Cité (pour la carte bancaire)</label>
                        <input type="text" name="customer_state" value="californi" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Code postal (pour la carte bancaire)
                            :</label>
                        <input type="text" name="customer_zip_code" value="065100" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="exampleInputEmail1" class="form-label">Email address</label> --}}
                        <input type="text" name="channels" value="ALL" class="form-control" hidden>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="exampleInputEmail1" class="form-label"></label> --}}
                        <input type="text" name="metadata" value="user1" class="form-control" hidden>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="exampleInputEmail1" class="form-label">Email address</label> --}}
                        <input type="text" name="lang" value="fr" class="form-control" hidden>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>
