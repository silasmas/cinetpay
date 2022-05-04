<?php

namespace App\Http\Controllers;

use Nette\Utils\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class paiement extends Controller
{


    public function index()
    {
        return view('welcome');
    }
    public function notify()
    {
        return view('welcome');
    }
    public function retour()
    {
        return view('welcome');
    }
    public function genererChaineAleatoire($longueur = 10)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++) {
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        return $chaineAleatoire;
    }
    public function paie(Request $request)
    {

        $transaction_id = $this->genererChaineAleatoire();
        $cinetpay_data =  [
            "amount" => $request["montant"],
            "currency" => $request["devise"],
            "apikey" => env("CINETPAY_APIKEY"),
            "site_id" => env("CINETPAY_SERVICD_ID"),
            "transaction_id" => $transaction_id,
            "description" => $request["description"],
            "return_url" => env("RETURN_URL"),
            "notify_url" => env("NOTIFY_URL"),
            "metadata" => "user001",
            'customer_surname' => $request["payer_surname"],
            'customer_name' => $request["payer_name"],
            'customer_email' => $request["payer_mail"],
            'customer_phone_number' => $request["phone"],
            'customer_address' => $request["adresse"],
            'customer_city' => $request["ville"],
            'customer_country' => $request["customer_country"],
            'customer_state' => $request["customer_state"],
            'customer_zip_code' => $request["customer_zip_code"],
        ];
        $url = 'https://api-checkout.cinetpay.com/v2/payment';
        $response = Http::asJson()->post($url, $cinetpay_data);
        $message = "Un problème est survenu, merci de reprendre votre paiement";

        $response_body = json_decode($response->body(), JSON_THROW_ON_ERROR | true, 512, JSON_THROW_ON_ERROR);
        if ($response->status() === 200) {
            if ((int)$response_body["code"] === 201) {
                $payment_link = $response_body["data"]["payment_url"];
               // dd($payment_link);
               return Redirect::to($payment_link);
            }
        } else {
            dd($response_body);
        }
    }
}
