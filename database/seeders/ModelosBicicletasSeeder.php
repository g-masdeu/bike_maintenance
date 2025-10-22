<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModelosBicicletasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener ids de marcas y tipos desde la base de datos para usar las claves foráneas
        $marcas = DB::table('marca_bicicletas')->pluck('id', 'nom');
        $tipos = DB::table('tipo_bicicletas')->pluck('id', 'nom');

        // Estructura de modelos jerárquica: Marca => Tipo => [Modelos]
        $modelos_data = [
            // --- Nivel 1: Marcas Globales y Generalistas (Catálogo Extenso) ---
            'Specialized' => [
                'Carretera' => [
                    'Tarmac SL8 Comp', 'Tarmac SL8 Expert', 'Tarmac SL7 Pro', 'Tarmac SL6 Sport', // Generaciones Tarmac
                    'Roubaix SL8 Pro', 'Roubaix SL7 Expert', 'Roubaix SL6 Comp', 'Roubaix Sport', 'Roubaix Base', // Generaciones Roubaix mejoradas
                    'Venge Pro', 'Allez Sprint Comp', 'Aethos Pro',
                    'Crux Comp', 'Crux Expert',
                ],
                'Montaña'   => [
                    'Stumpjumper Comp', 'Stumpjumper EVO Pro', 'Epic HT Comp', 'Epic HT Expert',
                    'Enduro Comp', 'Enduro Expert', 'Fuse Sport', 'Chisel Comp', 'Kenevo SL Comp',
                ],
                'Gravel'    => ['Diverge Comp Carbon', 'Diverge Expert', 'Sequoia', 'Crux S-Works'],
                'Paseo / Urbana' => ['Sirrus X 4.0', 'Roll Sport', 'Turbo Como 3.0', 'Globe Haul'],
                'Eléctrica' => ['Turbo Levo Comp', 'Turbo Vado SL 4.0', 'Turbo Kenevo Expert', 'Turbo Creo SL Comp'],
                'Triatlón / Crono' => ['Shiv TT', 'S-Works Shiv Disc'],
                'Fat Bike'  => ['Fatboy'],
            ],
            'Trek' => [
                'Carretera' => [
                    'Domane SL 7', 'Domane SL 6', 'Domane SL 5',
                    'Émonda SLR 9', 'Émonda SL 6',
                    'Madone SLR 9', 'Madone SL 7',
                    'Checkpoint SL 7', 'Speed Concept SLR 9', 'Alpha ALR 5',
                ],
                'Montaña'   => [
                    'Fuel EX 9.8', 'Fuel EX 8', 'Slash 9.9', 'Marlin 8', 'Marlin 7',
                    'Procaliber 9.7', 'Top Fuel 8', 'Rail 9.8',
                ],
                'Gravel'    => ['Checkpoint ALR 5', 'Boone 6 Disc'],
                'Paseo / Urbana' => ['Verve 3 Disc', 'FX Sport 4', 'L Series'],
                'Eléctrica' => ['Allant+ 8', 'Rail 9.8', 'Domane+ LT'],
                'Triatlón / Crono' => ['Speed Concept SLR 9'],
            ],
            'Giant' => [
                'Carretera' => [
                    'TCR Advanced SL 1', 'TCR Advanced Pro 0', 'Defy Advanced Pro 1',
                    'Propel Advanced Pro Disc', 'Contend AR 1', 'FastRoad AR 2',
                ],
                'Montaña'   => [
                    'Trance X Advanced Pro 29', 'Anthem Advanced Pro 29', 'Reign Advanced Pro',
                    'Fathom 29 1', 'Stance 29 2', 'Glory Advanced',
                ],
                'Gravel'    => ['Revolt Advanced Pro', 'AnyRoad CoMax'],
                'Paseo / Urbana' => ['Escape Disc 1', 'Roam 2 Disc', 'Momentum Voya E+'],
                'Eléctrica' => ['Trance X E+ 3', 'Road E+ 1', 'Fathom E+ 2'],
            ],
            'Canyon' => [
                'Carretera' => [
                    'Ultimate CFR Di2', 'Ultimate CF SLX 8', 'Ultimate CF SL 7',
                    'Aeroad CFR Disc', 'Aeroad CF SLX 8',
                    'Endurace CF SLX 8', 'Endurace AL 7', 'Inflite CF SLX',
                ],
                'Montaña'   => [
                    'Spectral CF 8', 'Neuron CF 9', 'Strive CFR', 'Exceed CF SLX 8', 'Sender CFR',
                ],
                'Gravel'    => ['Grail CF SL 8', 'Grizl CF SLX 8', 'Grail AL 7'],
                'Paseo / Urbana' => ['Commuter 8', 'Roadlite 6.0'],
                'Eléctrica' => ['Neuron:ON 8', 'Roadlite:ON 7', 'Spectral:ON CF 8'],
                'Triatlón / Crono' => ['Speedmax CFR Disc', 'Speedmax CF SLX'],
            ],
            'Scott' => [
                'Carretera' => [
                    'Addict RC Pro', 'Addict RC 15', 'Foil RC Ultimate', 'Foil 20',
                    'Speedster 30', 'Solace Gravel 20',
                ],
                'Montaña'   => [
                    'Spark RC World Cup', 'Spark 940', 'Genius 900 Tuned', 'Scale RC World Cup',
                    'Ransom 910', 'Gambler 930',
                ],
                'Gravel'    => ['Addict Gravel 10', 'Speedster Gravel 30'],
                'Paseo / Urbana' => ['Sub Cross 10', 'Contessa Active 30'],
                'Eléctrica' => ['E-Spark 700', 'E-Scale 920', 'Strike eRIDE 940'],
                'Triatlón / Crono' => ['Plasma 6', 'Plasma 10'],
            ],
            'Cannondale' => [
                'Carretera' => [
                    'SuperSix EVO Hi-Mod', 'SuperSix EVO Carbon Disc', 'Synapse Carbon 2 RLE',
                    'CAAD13 Disc 105', 'SystemSix Hi-Mod',
                ],
                'Montaña'   => [
                    'Scalpel HT Carbon 4', 'Scalpel SE', 'Trail SE 3', 'Habit Carbon 2',
                    'Jekyll 1', 'Moterra Neo Carbon 1',
                ],
                'Gravel'    => ['Topstone Carbon Lefty 3', 'Slate Force', 'SuperX Apex 1'],
                'Paseo / Urbana' => ['Quick Disc 1', 'Treadwell 2'],
                'Eléctrica' => ['Moterra Neo EQ', 'Quick Neo EQ', 'Topstone Neo Carbon Lefty 3'],
            ],
            'Cube' => [
                'Carretera' => [
                    'Litening C:68X Race', 'Attain SL', 'Agree C:62 Race', 'Aerium C:68',
                ],
                'Montaña'   => [
                    'Stereo 150 C:62', 'Reaction C:62 Race', 'Two15 HP', 'Nuroad WS C:62',
                ],
                'Gravel'    => ['Nuroad C:62 SL', 'Cross Race C:62 Pro'],
                'Eléctrica' => ['Stereo Hybrid 140 HPC', 'Kathmandu Hybrid 625', 'Elite Hybrid C:62'],
                'Triatlón / Crono' => ['Aerium TT C:68'],
            ],
            'BH' => [
                'Carretera' => ['G8 Disc Ultegra', 'Ultralight Evo Disc', 'Quartz Disc 105'],
                'Montaña'   => ['Lynx Race Evo 9.8', 'Ultimate RC 7.9', 'Spike 5.0'],
                'Gravel'    => ['GravelX Alu 2.0'],
                'Eléctrica' => ['Atom X Lynx 6 Pro', 'Core Race 1.2', 'Rebel Lite'],
            ],

            // --- Nivel 2: Marcas Premium, Foco Deportivo (Catálogo Segmentado) ---
            'Orbea' => [
                'Carretera' => ['Orca Aero M20iLTD', 'Orca M30', 'Avant H30', 'Terra M20 Team'],
                'Montaña'   => ['Alma M-Team', 'Rallon M-LTD', 'Occam M30', 'Loki H10'],
                'Gravel'    => ['Terra H30-D'],
                'Eléctrica' => ['Gain M20', 'Rise M-Team', 'Wild FS M10'],
            ],
            'Bianchi' => [
                'Carretera' => ['Oltre XR4 Disc', 'Specialissima Ultegra', 'Infinito CV Disc', 'Aria Disc 105'],
                'Gravel'    => ['Impulso Pro GRX 600', 'Arcadex GRX 810'],
                'Montaña'   => ['Methanol CV RS', 'Magma 9.1'],
                'Fixie / Singlespeed' => ['Pista Sei Giorni'],
            ],
            'Cervélo' => [
                'Carretera' => ['R5 Disc Force eTap', 'S5 Disc Ultegra Di2', 'Caledonia-5 Rival AXS', 'Soloist Apex 1'],
                'Triatlón / Crono' => ['P5 Disc Dura-Ace', 'P3 Ultegra', 'PX-Series Force'],
                'Gravel'    => ['Áspero GRX 810'],
            ],
            'Pinarello' => [
                'Carretera' => ['Dogma F Disc', 'Paris 105', 'Prince Disc Ultegra', 'Gan Disc Easy'],
                'Triatlón / Crono' => ['Bolide TT'],
                'Gravel'    => ['Grinder Ekar'],
            ],
            'BMC' => [
                'Carretera' => ['Teammachine SLR 01', 'Roadmachine 01 ONE', 'Timemachine Road 01', 'Timemachine 01'],
                'Montaña'   => ['Twostroke 01', 'Fourstroke 01', 'Speedfox 01'],
                'Gravel'    => ['Kaius 01 ONE', 'Urs LT ONE'],
            ],
            'Santa Cruz' => [
                'Montaña'   => ['V10 Carbon CC', 'Hightower Carbon S', 'Nomad Carbon XT', 'Tallboy Carbon C', 'Bronson Carbon R'],
                'Gravel'    => ['Stigmata CC'],
            ],
            'Yeti' => [
                'Montaña'   => ['SB160 Turq T-Series', 'SB135 LR C-Series', 'SB120 Turq', 'ARC Carbon'],
            ],
            'Kona' => [
                'Montaña'   => ['Process 153', 'Honzo ESD', 'Satori 29', 'Hei Hei CR DL'],
                'Gravel'    => ['Rove DL', 'Sutra LTD'],
                'Paseo / Urbana' => ['Dew Deluxe'],
            ],

            // --- Nivel 3: Marcas de Nicho o Especializadas (Catálogo Específico) ---
            'Brompton' => [
                'Plegable'  => ['C Line Explore', 'P Line Urban', 'T Line One'],
                'Eléctrica' => ['Electric C Line Explore'],
            ],
            '3T' => [
                'Gravel'    => ['Exploro RaceMax Boost', 'Exploro Pro GRX'],
                'Carretera' => ['Strada Due Ultegra'],
            ],
            'Cinelli' => [
                'Fixie / Singlespeed' => ['Vigorelli Shark', 'Gazzetta della Strada'],
                'Gravel'    => ['Nemo Gravel GRX', 'Zydeco Ekar'],
                'Carretera' => ['Superstar Disc'],
            ],
            'Surly' => [
                'Gravel'    => ['Midnight Special', 'Straggler'],
                'Fat Bike'  => ['Ice Cream Truck', 'Pugsley'],
            ],
            'Salsa' => [
                'Gravel'    => ['Warbird Carbon', 'Cutthroat GRX 810'],
                'Fat Bike'  => ['Mukluk Carbon', 'Blackborow'],
            ],
            'GT Bicycles' => [
                'BMX'       => ['Pro Series Race', 'Performer'],
                'Montaña'   => ['Zaskar LT Elite', 'Force Carbon Pro'],
            ],
            'SE Bikes' => [
                'BMX'       => ['Big Ripper 29', 'OM-Duro XL'],
                'Fixie / Singlespeed' => ['Draft Lite'],
            ],
            'Haibike' => [
                'Eléctrica' => ['AllMtn 7', 'FullSeven 5', 'HardSeven 6'],
            ],
            'Fantic' => [
                'Eléctrica' => ['Integra XF1', 'Issimo Urban'],
            ],
            'Colnago' => [
                'Carretera' => ['C68 Disc', 'V3Rs Disc', 'Master X Light'],
            ],
            'De Rosa' => [
                'Carretera' => ['Merak Disc', 'SK Pininfarina Disc'],
            ],
            'Wilier' => [
                'Carretera' => ['Zero SLR Disc', 'Cento10 SL Disc'],
                'Gravel'    => ['Jena GRX', 'Jaroon Plus'],
            ],
            'Look' => [
                'Carretera' => ['795 Blade RS Disc', '785 Huez RS'],
            ],
            'Argon 18' => [
                'Triatlón / Crono' => ['E-119 Tri+', 'E-117 Tri Disc'],
                'Carretera' => ['Gallium Pro Disc', 'Krypton GF Disc'],
            ],
            'Electra' => [
                'Paseo / Urbana' => ['Townie 7D EQ', 'Cruiser 1'],
            ],
            'Mondraker' => [
                'Montaña'   => ['F-Podium DC RR', 'Summum Carbon Pro', 'SuperFoxy Carbon R'],
            ],
            'Ibis' => [
                'Montaña'   => ['Ripmo V2S', 'Mojo HD5', 'Hakka MX'],
            ],
            // Asignación de un par de modelos clave al resto de marcas (más de 30 marcas)
            'Airstreeem' => ['Carretera' => ['Race SL', 'Aero RR'],],
            'Alchemy' => ['Carretera' => ['Atlas Evo', 'Arktos'],],
            'All-City' => ['Fixie / Singlespeed' => ['Big Block'], 'Gravel' => ['Space Horse GRX'],],
            'Avanti' => ['Montaña' => ['Montari Pro', 'Competitor 29er'],],
            'Basso' => ['Carretera' => ['Diamante SV', 'Venta Disc'],],
            'Breezer' => ['Paseo / Urbana' => ['Greenway Step-Through', 'Downtown 8'],],
            'Carrera' => ['Carretera' => ['Erakle Air', 'Phibra Evo'],],
            'Centurion' => ['Paseo / Urbana' => ['City R', 'Backfire Pro'],],
            'Co-op Cycles' => ['Gravel' => ['ADV 3.1', 'ADV 4.2'], 'Montaña' => ['DRT 1.1'],],
            'Dahon' => ['Plegable' => ['Mu Uno', 'Mariner D8'],],
            'Diamondback' => ['Montaña' => ['Release 5C', 'Sync\'r Carbon'],],
            'Eddy Merckx' => ['Carretera' => ['EM525 Disc', 'Blockhaus 67'],],
            'Ellsworth' => ['Montaña' => ['Witness 29', 'Truth Carbon'],],
            'Felt' => ['Carretera' => ['AR Advanced', 'B14'], 'Triatlón / Crono' => ['IA Advanced'],],
            'Fuji' => ['Carretera' => ['Transonic 2.1', 'Sportif 1.3'], 'Montaña' => ['Nevada 29'],],
            'Genesis' => ['Gravel' => ['Fugio 30', 'Croix de Fer 80'],],
            'Ghost' => ['Montaña' => ['Lector FS World Cup', 'Kato Universal'],],
            'Helkama' => ['Paseo / Urbana' => ['Oiva 7', 'Ainotar 3'],],
            'Jamis' => ['Montaña' => ['Hardline A2', 'Renegade S4'], 'Carretera' => ['Quest 2'],],
            'Juliana' => ['Montaña' => ['Furtado CC', 'Roubion AL'],],
            'Lapierre' => ['Montaña' => ['Zesty AM', 'Prana SL'], 'Carretera' => ['Aircode DRS 8.0'],],
            'Litespeed' => ['Carretera' => ['T1sl Disc', 'Gravel Disc'],],
            'Marin' => ['Montaña' => ['Alpine Trail E2', 'Nicasio +'], 'Paseo / Urbana' => ['Kentfield 1'],],
            'Marinoni' => ['Carretera' => ['Formula 3', 'Gravel King Disc'],],
            'Motobecane' => ['Carretera' => ['Mirage Sport', 'Le Champion SL'],],
            'Norco' => ['Montaña' => ['Sight VLT C2', 'Fluid FS A1'], 'Gravel' => ['Search XR C2'],],
            'Raleigh' => ['Paseo / Urbana' => ['Cadent 3', 'Roadhouse'],],
            'Ridley' => ['Carretera' => ['Noah Fast Disc', 'Fenix SLiC'], 'Gravel' => ['Kanzo Fast'],],
            'Van Nicholas' => ['Carretera' => ['Zephyr Disc', 'Yukon Disc'],],
            'Vitus' => ['Carretera' => ['ZX-1 CRS', 'Zenium CRS'], 'Montaña' => ['Escarpe 29'],],
            'Zodiac' => ['Carretera' => ['Road Comp', 'Speed R'],],
            'Boardman' => ['Carretera' => ['SLR 9.8 Disc', 'ADV 8.9'],],
            'S-Works' => [ // Marca de gama alta de Specialized
                'Carretera' => ['Tarmac SL8 S-Works', 'Tarmac SL7 S-Works', 'Tarmac SL6 S-Works', 'Aethos S-Works'],
                'Montaña'   => ['Epic S-Works', 'Stumpjumper S-Works'],
            ],
        ];

        $modelos_a_insertar = [];
        $now = Carbon::now();

        foreach ($modelos_data as $marca_nom => $tiposModelos) {
            // Saltamos si la marca no existe
            if (!isset($marcas[$marca_nom])) continue;
            $marca_id = $marcas[$marca_nom];

            foreach ($tiposModelos as $tipo_nom => $listaModelos) {
                // Saltamos si el tipo no existe
                if (!isset($tipos[$tipo_nom])) continue;
                $tipo = $tipos[$tipo_nom];

                foreach ($listaModelos as $modelo_nom) {
                    $modelos_a_insertar[] = [
                        'marca_id'   => $marca_id,
                        'tipo'    => $tipo,
                        'nom'        => $modelo_nom,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        // Insertar todos los modelos generados
        // NOTA: La tabla final se llama 'modelo_bicicletas'
        DB::table('modelo_bicicletas')->insert($modelos_a_insertar);
    }
}
