<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('especificaciones_bicicleta', function (Blueprint $table) {
            $table->id();
            $table->string('modelo')->nullable(); // opcional, puede estar asociado a un modelo
            $table->enum('tipo_bici', ['carretera','montaña','gravel','urbana','eléctrica'])->nullable();

            // Componentes
            $table->enum('tipo_freno', ['disco_hidraulico','disco_mecanico','zapata'])->nullable();
            $table->string('horquilla')->nullable();
            $table->string('recorrido_horquilla')->nullable();
            $table->boolean('bloqueo_remoto_horquilla')->nullable();
            $table->string('amortiguador')->nullable();
            $table->boolean('bloqueo_remoto_amortiguador')->nullable();
            $table->string('motor')->nullable();
            $table->string('bateria')->nullable();
            $table->string('cuadro')->nullable();
            $table->integer('rodado')->nullable();
            $table->string('cambio')->nullable();
            $table->string('marca_cambio')->nullable();
            $table->string('tipo_cambio')->nullable();
            $table->integer('velocidades')->nullable();
            $table->string('cassette')->nullable();
            $table->string('desviador')->nullable();
            $table->string('mandos_cambio')->nullable();
            $table->string('bielas')->nullable();
            $table->string('platos')->nullable();
            $table->string('ruedas')->nullable();
            $table->string('material_rueda')->nullable();
            $table->string('material_potencia')->nullable();
            $table->string('material_manillar')->nullable();
            $table->string('tija_sillin')->nullable();
            $table->string('potenciometro')->nullable();
            $table->string('condicion_estetica')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('especificaciones_bicicleta');
    }
};
