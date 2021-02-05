<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesenvolvedoresSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('desenvolvedores')->insert([
            'nome' => 'Wesley Dias',
            'campo' => 'Dev Sr',
        ]);
        
        DB::table('desenvolvedores')->insert([
            'nome' => 'Marcos Becasse',
            'campo' => 'DBA Sr',
        ]);
        
        DB::table('desenvolvedores')->insert([
            'nome' => 'Lucas Miguel',
            'campo' => 'Dev Jr',
        ]);
        
        DB::table('desenvolvedores')->insert([
            'nome' => 'Diego',
            'campo' => 'Analista Jr',
        ]);
    }
}
