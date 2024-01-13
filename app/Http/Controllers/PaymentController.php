<?php

namespace App\Http\Controllers;

use App\Http\Helpers\PagarmeSync;
use App\Http\Requests\StoreClientPagarMeRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\MarketSecret;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $pagarme_api;

    public function __construct()
    {
    }

    public function storeClient(StoreClientPagarMeRequest $request, $marketId)
    {
        try {

            $client = Client::where('email', $request->email)->first();

            if(!is_null($client))
            {
                return response()->json(['error' => 'Já existe um cliente vinculado a este email'], 500);
            }
            $marketSecret = MarketSecret::find($marketId);

            $this->pagarme_api = new PagarmeSync($marketSecret->pagarme_secret_api_key);

            $body = [
                "name" => $request->name,
                "email" => $request->email,
                "code" => Str::uuid(),
                "document" => $request->document,
                "document_type" => $request->document_type,
                "type" => "individual",
                "gender" => $request->gender,
                "address" => [
                    "country" => $request->country,
                    "state" => $request->state,
                    "city" => $request->city,
                    "zip_code" => $request->zip_code,
                    "line_1" => $request->line,
                ],
                "phones" => [
                    "mobile_phone" => [
                        "country_code" => $request->country_code,
                        "number" => $request->number,
                        "area_code" => $request->area_code
                    ]
                ]
            ];

            $responseClientPagarMe = $this->pagarme_api
                ->registerClient($body, "https://api.pagar.me/core/v5/customers");

            if ($responseClientPagarMe->status() == 200) {

                if (!isset($responseClientPagarMe['id'])) {
                    return response()->json(['error' => 'Invalid response from Pagar.me.'], 500);
                }
                $user = User::create(
                    [
                        "name" => $body['name'],
                        "email" => $body['email'],
                        "market_id" => null,
                        "password" => bcrypt($body['document']),
                        "type" => "cliente"
                    ]
                );
                $client = Client::create(
                    [
                        "user_id" => $user->id,
                        "pagarme_customer_id" => $responseClientPagarMe['id'],
                        "name" => $body['name'],
                        "email" => $body['email'],
                        "document" => $body['document'],
                        "document_type" => $body['document_type'],
                        "gender" => $body['gender'],
                        "address" => json_encode($body["address"]),
                        "phones" => json_encode($body["phones"]),
                        "code" => $body["code"]
                    ]
                );

                $data = [
                    'client' => new ClientResource($client),
                    'pagarme_client' => $responseClientPagarMe->json()
                ];

                return response()->json($data, 200);
            }
        } catch (Exception $e) {
            Log::error('Error storing client: ' . $e->getMessage());
            return response()->json(['error' => 'Não foi possível criar um cliente'], 500);
        }
    }
    public function newClientPagarMe()
    {

        // $secret = $marketSecret->pagarme_secret_api_key;

        // $encoded = base64_encode($secret . ":");
        // dd($encoded);

        // $api = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Content-Type' => 'application/json',
        //     'Authorization' => "Basic " . $encoded,
        // ]);



        // dd($body);

        // // Utilize o método post diretamente sem usar json_encode
        // $response = $api->post('https://api.pagar.me/core/v5/customers', $body);

        // // Exiba a resposta
        // dd($response->json());
    }
}
