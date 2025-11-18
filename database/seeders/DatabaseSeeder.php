<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TipoBicicletaSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ModelosBicicletasSeeder::class);
        $this->call(MantenimentFrenosSeeder::class);
    }
}
