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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pagarme_customer_id')->nullable()->default(null);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('document')->unique();
            $table->enum('document_type', ['CPF', 'RG']);
            $table->enum('gender', ['male', 'female']);
            $table->json('address')->nullable();
            $table->json('phones')->nullable();
            $table->uuid('code');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
