<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mantenimiento;

class MantenimentFrenosSeeder extends Seeder
{
    public function run(): void
    {
        Mantenimiento::create([
            'nom' => 'Revisión de frenos',
            'descripcion' => 'Comprobar el desgaste de las zapatas o pastillas, centrado de las pinzas, tensión del cable o nivel de líquido si son frenos hidráulicos.',
            'kms_interval' => 300,
            'time_interval' => 60, // días
            'tipo_bici_id' => null,
        ]);
    }
}
