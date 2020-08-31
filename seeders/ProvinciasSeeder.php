<?php

use Illuminate\Database\Seeder;

class ProvinciasSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('utils/provincias.php');

        foreach ($provincias->provincias as $key ) {
               
            DB::table('provincias')->insert([
             'nombre' => $key->nombre
            ]);
            }
            
            
    
    }
}
