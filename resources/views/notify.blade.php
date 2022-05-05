<h1>{{ $data['message'] }}</h1>
<p>{{ $data['data']['status'] }}</p>
<p>Montant :{{ $data['data']['amount'].$data['data']['currency'] }}</p>
<p>Opérateur : {{ $data['data']['payment_method'] }}</p>
<p>Description :{{ $data['data']['description'] }}</p>
<p>Date :{{ $data['data']['payment_date'] }}</p>