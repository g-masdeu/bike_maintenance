<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bicicletas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('marca_id')->constrained('marca_bicicletas')->onDelete('restrict');
            $table->foreignId('tipo_id')->constrained('tipo_bicicletas')->onDelete('restrict');
            $table->string('model');
            $table->date('data_compra');
            $table->integer('kms_actuals')->default(0);
            $table->integer('kms_ultim_mantenimient')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bicicletas');
    }
};
