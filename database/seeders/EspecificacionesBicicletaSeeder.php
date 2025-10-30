<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('especificaciones_bicicleta')) {
            Schema::create('especificaciones_bicicleta', function (Blueprint $table) {
                $table->id();
                $table->string('modelo')->nullable();
                $table->enum('tipo_bici', ['carretera','montaña','gravel','urbana','eléctrica'])->nullable();

                // Componentes
                if (!Schema::hasColumn('especificaciones_bicicleta', 'tipo_freno')) {
                    $table->enum('tipo_freno', ['disco_hidraulico','disco_mecanico','zapata'])->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'horquilla')) {
                    $table->string('horquilla')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'recorrido_horquilla')) {
                    $table->string('recorrido_horquilla')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'bloqueo_remoto_horquilla')) {
                    $table->boolean('bloqueo_remoto_horquilla')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'amortiguador')) {
                    $table->string('amortiguador')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'bloqueo_remoto_amortiguador')) {
                    $table->boolean('bloqueo_remoto_amortiguador')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'motor')) {
                    $table->string('motor')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'bateria')) {
                    $table->string('bateria')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'cuadro')) {
                    $table->string('cuadro')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'rodado')) {
                    $table->integer('rodado')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'cambio')) {
                    $table->string('cambio')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'marca_cambio')) {
                    $table->string('marca_cambio')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'tipo_cambio')) {
                    $table->string('tipo_cambio')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'velocidades')) {
                    $table->integer('velocidades')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'cassette')) {
                    $table->string('cassette')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'desviador')) {
                    $table->string('desviador')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'mandos_cambio')) {
                    $table->string('mandos_cambio')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'bielas')) {
                    $table->string('bielas')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'platos')) {
                    $table->string('platos')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'ruedas')) {
                    $table->string('ruedas')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'material_rueda')) {
                    $table->string('material_rueda')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'material_potencia')) {
                    $table->string('material_potencia')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'material_manillar')) {
                    $table->string('material_manillar')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'tija_sillin')) {
                    $table->string('tija_sillin')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'potenciometro')) {
                    $table->string('potenciometro')->nullable();
                }
                if (!Schema::hasColumn('especificaciones_bicicleta', 'condicion_estetica')) {
                    $table->string('condicion_estetica')->nullable();
                }

                $table->timestamps();
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('especificaciones_bicicleta');
    }
};
