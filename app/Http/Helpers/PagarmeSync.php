<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;

class PagarmeSync
{

    private $api;

    public function __construct($marketSecretKey)
    {
        $this->api = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'authorization' => "Basic " . base64_encode($marketSecretKey)
        ]);
    }

    public function getApi()
    {
        return $this->api;
    }
}
