<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bicicleta_mantenimiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bicicleta_id')->constrained()->onDelete('cascade');
            $table->foreignId('mantenimiento_id')->constrained('mantenimientos')->onDelete('cascade');
            $table->date('fecha_realizado');
            $table->integer('kms_al_realizar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bicicleta_mantenimiento');
    }
};
