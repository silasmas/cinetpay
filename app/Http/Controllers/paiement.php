<?php

namespace App\Http\Controllers;

use Nette\Utils\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\paiement as paie;

class paiement extends Controller
{


    public function index()
    {
        return view('welcome');
    }
    public function notify(Request $request)
    {
        dd($request);
        $data = $cpm_site_id . $cpm_trans_id . $cpm_trans_date . $cpm_amount . $cpm_currency .
            $signature . $payment_method . $cel_phone_num . $cpm_phone_prefixe .
            $cpm_language . $cpm_version . $cpm_payment_config . $cpm_page_action . $cpm_custom;

        $token = hash_hmac(‘SHA256’, $data, $secretKey);
        if (hash_equals($received_token, $generated_token)) {
        }

        return view('welcome');
    }
    public function retour(Request $request)
    {
        // dd($request);
        $url = 'https://api-checkout.cinetpay.com/v2/payment/check';
        $retour=paie::where([["token",$request->token],["transaction_id",$request->transaction_id]])->first();
        if($retour){
            $cinetpay_verify=  [
                "apikey" => env("CINETPAY_APIKEY"),
                "site_id" => env("CINETPAY_SERVICD_ID"),
                "transaction_id" => $request->transaction_id,
            ];
            $response = Http::asJson()->post($url, $cinetpay_verify);

            $response_body = json_decode($response->body(), JSON_THROW_ON_ERROR | true, 512, JSON_THROW_ON_ERROR);
            dd($response_body);
        }
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

        $ok = Validator::make($request->all(), [
            'montant' => 'required',
            'devise' => 'required',
            'devise' => 'required',
            'description' => 'required',
            'payer_surname' => 'required',
            'payer_name' => 'required',
            'payer_mail' => 'required',
            'adresse' => 'required',
        ]);
        if (!$ok->fails()) {
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

            $response_body = json_decode($response->body(), JSON_THROW_ON_ERROR | true, 512, JSON_THROW_ON_ERROR);

            $register = paie::create([
                "amount" => $request["montant"],
                "currency" => $request["devise"],
                "transaction_id" => $transaction_id,
                "description" => $request["description"],
                "token" => $response_body["data"]["payment_token"],
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
                'etat' => "en cours",
            ]);
            if ($register) {
                if ($response->status() === 200) {
                    // dd($response_body["code"] );
                    if ((int)$response_body["code"] === 201) {
                        $payment_link = $response_body["data"]["payment_url"];
                        return Redirect::to($payment_link);
                    }
                } else {
                    dd($response_body);
                }
            }else{
                dd("Erreur d'enregistrement!");
            }
        } else {
        }
    }
}
