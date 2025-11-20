<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descripcion')->nullable();
            $table->integer('kms_interval')->nullable();
            $table->integer('time_interval')->nullable(); // dies
            $table->foreignId('tipo_bici_id')->nullable()->constrained('tipo_bicicletas')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
