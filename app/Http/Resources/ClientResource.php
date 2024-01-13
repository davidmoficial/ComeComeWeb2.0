<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "pagarme_customer_id" => $this->pagarme_customer_id,
            "code" => $this->code,
            "name" => strtoupper($this->name),
            "email" => $this->email,
            "document" => $this->document,
            "document_type" => strtoupper($this->document_type),
            "gender" => strtoupper($this->gender),
            "address" => json_decode($this->address),
            "phones" => json_decode($this->phones),
            "created_at" => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            "updated_at" => Carbon::parse($this->updated_at)->format('Y-m-d H:i')
        ];
    }
}
