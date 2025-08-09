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
        Schema::create('localidade', function (Blueprint $table) {
            $table->string('cep', 8)->primary();
            $table->char('uf', 2)->nullable();
            $table->string('municipio');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('logradouro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('localidade');
    }
};
