<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MarcaSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            '3T', 'Airstreeem', 'Alchemy', 'All-City', 'Argon 18', 'Avanti', 'Basso',
            'Bianchi', 'BH', 'Breezer', 'Brompton', 'BMC', 'Cannondale', 'Canyon',
            'Carrera', 'Centurion', 'Cervélo', 'Cinelli', 'Colnago', 'Co-op Cycles',
            'Cube', 'Dahon', 'De Rosa', 'Diamondback', 'Eddy Merckx', 'Electra',
            'Ellsworth', 'Fantic', 'Felt', 'Focus', 'Fuji', 'Genesis', 'Ghost',
            'Giant', 'GT Bicycles', 'Haibike', 'Helkama', 'Ibis', 'Jamis', 'Juliana',
            'Kona', 'Lapierre', 'Litespeed', 'Look', 'Marin', 'Marinoni', 'Merida',
            'Mondraker', 'Montague', 'Motobecane', 'Norco', 'Orbea', 'Pinarello',
            'Raleigh', 'Ridley', 'Rocky Mountain', 'Salsa', 'Santa Cruz', 'Scott',
            'SE Bikes', 'Specialized', 'S-Works', 'Surly', 'Trek', 'Van Nicholas',
            'Vitus', 'Wilier', 'Yeti', 'Zodiac', 'Boardman',
        ];

        $now = Carbon::now();

        foreach ($marcas as $marca) {
            // Solo inserta si no existe
            $exists = DB::table('marca_bicicletas')->where('nom', $marca)->exists();

            if (!$exists) {
                DB::table('marca_bicicletas')->insert([
                    'nom' => $marca,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
