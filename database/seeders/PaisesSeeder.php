<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paises')->insert([
            ['nombre' => 'Colombia', 'codigo_iso2' => 'CO', 'codigo_iso3' => 'COL'],
            ['nombre' => 'Estados Unidos', 'codigo_iso2' => 'US', 'codigo_iso3' => 'USA'],
            ['nombre' => 'España', 'codigo_iso2' => 'ES', 'codigo_iso3' => 'ESP'],
            //paises de latinoamerica
            ['nombre' => 'Argentina', 'codigo_iso2' => 'AR', 'codigo_iso3' => 'ARG'],
            ['nombre' => 'Bolivia', 'codigo_iso2' => 'BO', 'codigo_iso3' => 'BOL'],
            ['nombre' => 'Brasil', 'codigo_iso2' => 'BR', 'codigo_iso3' => 'BRA'],
            ['nombre' => 'Chile', 'codigo_iso2' => 'CL', 'codigo_iso3' => 'CHL'],
            ['nombre' => 'Costa Rica', 'codigo_iso2' => 'CR', 'codigo_iso3' => 'CRI'],
            ['nombre' => 'Cuba', 'codigo_iso2' => 'CU', 'codigo_iso3' => 'CUB'],
            ['nombre' => 'Ecuador', 'codigo_iso2' => 'EC', 'codigo_iso3' => 'ECU'],
            ['nombre' => 'El Salvador', 'codigo_iso2' => 'SV', 'codigo_iso3' => 'SLV'],
            ['nombre' => 'Guatemala', 'codigo_iso2' => 'GT', 'codigo_iso3' => 'GTM'],
            ['nombre' => 'Honduras', 'codigo_iso2' => 'HN', 'codigo_iso3' => 'HND'],
            ['nombre' => 'México', 'codigo_iso2' => 'MX', 'codigo_iso3' => 'MEX'],
            ['nombre' => 'Nicaragua', 'codigo_iso2' => 'NI', 'codigo_iso3' => 'NIC'],
            ['nombre' => 'Panamá', 'codigo_iso2' => 'PA', 'codigo_iso3' => 'PAN'],
            ['nombre' => 'Paraguay', 'codigo_iso2' => 'PY', 'codigo_iso3' => 'PRY'],
            ['nombre' => 'Perú', 'codigo_iso2' => 'PE', 'codigo_iso3' => 'PER'],
            ['nombre' => 'Puerto Rico', 'codigo_iso2' => 'PR', 'codigo_iso3' => 'PRI'],
            ['nombre' => 'República Dominicana', 'codigo_iso2' => 'DO', 'codigo_iso3' => 'DOM'],
            ['nombre' => 'Uruguay', 'codigo_iso2' => 'UY', 'codigo' => 'URY'],
            ['nombre' => 'Venezuela', 'codigo_iso2' => 'VE', 'codigo_iso3' => 'VEN'],
            // agregar más países según sea necesario
        ]);
    }
}
