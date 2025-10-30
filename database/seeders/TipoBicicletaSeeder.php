<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $now = Carbon::now();

        foreach ($tipos as $tipo) {
            // Solo inserta si no existe
            $exists = DB::table('tipo_bicicletas')->where('nom', $tipo)->exists();

            if (!$exists) {
                DB::table('tipo_bicicletas')->insert([
                    'nom' => $tipo,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
