<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoBicicletaSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Montaña',
            'Carretera',
            'Gravel',
            'Paseo / Urbana',
            'Eléctrica',
            'BMX',
            'Triatlón / Crono',
            'Plegable',
            'Fat Bike',
            'Fixie / Singlespeed',
        ];

        foreach ($tipos as $tipo) {
            DB::table('tipo_bicicletas')->insert([
                'nom' => $tipo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
