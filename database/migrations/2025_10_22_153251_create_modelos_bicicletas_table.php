<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modelo_bicicletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marca_bicicletas')->onDelete('cascade'); // FK marcas
            $table->foreignId('tipo')->constrained('tipo_bicicletas')->onDelete('cascade');   // FK tipos
            $table->string('nom');    // Nombre del modelo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modelo_bicicletas');
    }
};
