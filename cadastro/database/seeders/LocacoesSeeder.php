<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locacoes')->insert(['desenvolvedor_id' => 1,'projeto_id' => 6,'horas_semanais' => 10]);
        DB::table('locacoes')->insert(['desenvolvedor_id' => 1,'projeto_id' => 7,'horas_semanais' => 10]);
        DB::table('locacoes')->insert(['desenvolvedor_id' => 1,'projeto_id' => 8,'horas_semanais' => 10]);
        DB::table('locacoes')->insert(['desenvolvedor_id' => 1,'projeto_id' => 9,'horas_semanais' => 10]);

        DB::table('locacoes')->insert(['desenvolvedor_id' => 2,'projeto_id' => 6,'horas_semanais' => 10]);
        DB::table('locacoes')->insert(['desenvolvedor_id' => 2,'projeto_id' => 7,'horas_semanais' => 10]);

        DB::table('locacoes')->insert(['desenvolvedor_id' => 3,'projeto_id' => 8,'horas_semanais' => 10]);
        DB::table('locacoes')->insert(['desenvolvedor_id' => 3,'projeto_id' => 9,'horas_semanais' => 10]);
    }
}
