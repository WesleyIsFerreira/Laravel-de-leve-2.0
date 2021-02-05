<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projetos')->insert([
            'nome' => 'Sistema de vendas',
            'estimativa_horas' => '12',
        ]);
        DB::table('projetos')->insert([
            'nome' => 'Automação 33',
            'estimativa_horas' => '89',
        ]);
        DB::table('projetos')->insert([
            'nome' => 'Projeto urso',
            'estimativa_horas' => '78',
        ]);
        DB::table('projetos')->insert([
            'nome' => 'Projeto Kuko22',
            'estimativa_horas' => '32',
        ]);
    }
}
