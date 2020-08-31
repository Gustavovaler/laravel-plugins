<?php

use Illuminate\Database\Seeder;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        include('utils/municipios.php');

        foreach ($municipios->municipios as $key ) {
               
            DB::table('localidades')->insert([
             'nombre' =>  $key->nombre,
             'provincia' => $key->provincia->nombre
            ]);
            }        
    }
}
