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
        Schema::create('igreja', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('complemento')->nullable();
            $table->string('denominacao')->nullable();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('cep', 8);
            $table->foreign('cep')->references('cep')->on('localidade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('igreja');
    }
};
