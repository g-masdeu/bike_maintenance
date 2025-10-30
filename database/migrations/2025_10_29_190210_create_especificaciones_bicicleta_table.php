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
        Schema::create('especificaciones_bicicleta', function (Blueprint $table) {
            $table->id(); 
            $table->enum('tipo_freno', ['disco_hidraulico','disco_mecanico','zapata'])->nullable();
            $table->enum('suspension', ['delantera','full','ninguna'])->nullable();
            $table->integer('rodado')->nullable();
            $table->enum('material_cuadro', ['aluminio','carbono','acero','titanio'])->nullable();
            $table->enum('tipo_transmision', ['1x','2x','3x'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especificaciones_bicicleta');
    }
};
