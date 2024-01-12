<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('market_secrets', function (Blueprint $table) {
            $table->id();
            $table->integer('market_id');
            $table->string('pagarme_id')->nullable();
            $table->string('pagarme_public_key')->nullable();
            $table->string('pagarme_secret_api_key')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_secrets');
    }
};
