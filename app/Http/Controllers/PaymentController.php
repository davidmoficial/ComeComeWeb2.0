<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PagarmeSync;
use App\Models\MarketSecret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $pagarme_api;

    public function __construct()
    {
    }
    public function newClientPagarMe()
    {
        $marketSecret = MarketSecret::find(1);
        $secret = $marketSecret->pagarme_secret_api_key;

        // Remova a linha que substitui "=" e base64_encode novamente
        // $secret = base64_encode($secret);
        $encoded = base64_encode($secret . ":");
        // dd($encoded);

        $api = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Basic " . $encoded,
        ]);

        $body = [
            "name" => "Cliente Teste",
            "email" => "testsse@gmail.com",
            "code" => Str::uuid(),
            "document" => "93095135270",
            "document_type" => "CPF",
            "type" => "individual",
            "gender" => "male",
            "address" => [
                "country" => "BR",
                "state" => "MA",
                "city" => "Imperatriz", // Adicionado "city" aqui
                "zip_code" => "65917080",
                "line_1" => "Rua alzenira galvao, 54",
            ],
            "phones" => [
                "mobile_numbers" => [
                    "country_code" => "55",
                    "number" => "000000000",
                    "area_code" => "21"
                ]
            ]
        ];

        // dd($body);

        // Utilize o método post diretamente sem usar json_encode
        $response = $api->post('https://api.pagar.me/core/v5/customers', $body);

        // Exiba a resposta
        dd($response->json());
    }
}
