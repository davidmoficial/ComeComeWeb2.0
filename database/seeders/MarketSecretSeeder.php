<?php

namespace Database\Seeders;

use App\Models\MarketSecret;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSecretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Xburg',
            'email' => 'xburg@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 'estabelecimento',
            'market_id' => 1
        ]);

        MarketSecret::create([
            'market_id' => 1,
            'pagarme_id' => 'acc_lqXpaMKIrgc2px49',
            'pagarme_public_key' => 'pk_test_wM7Qe6V5fDuOekqL',
            'pagarme_secret_api_key' => 'sk_test_f631870c67c04af496b619fafa48742f'
        ]);
    }
}
