<?php

use Illuminate\Database\Seeder;
use Illuminate\Support;
use App\Usuario;

class TablaUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Usuario::class,8)->create();
    }
}
