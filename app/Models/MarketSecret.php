<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketSecret extends Model
{
    use HasFactory;

    protected $table = 'market_secrets';

    protected $fillable = [
        'market_id',
        'pagarme_id',
        'pagarme_public_key',
        'pagarme_secret_api_key',
        'status'
    ];

    protected $dates = ['created_at', 'updated_at'];


}
