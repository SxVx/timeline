<?php

use Illuminate\Database\Seeder;
use Illuminate\Support;
use App\Comentario;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comentario::class,300)->create();
    }
}
