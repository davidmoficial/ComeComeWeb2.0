<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $fillable = [
        "user_id",
        'pagarme_customer_id',
        "name",
        'email',
        'document',
        'document_type',
        'gender',
        'address',
        'phones',
        'code',
        'status'
    ];
}
