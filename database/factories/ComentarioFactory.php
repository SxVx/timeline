<?php

use Faker\Generator as Faker;

$factory->define(App\Comentario::class, function (Faker $faker) {
    return [
		'CMT_Contenido'=>$faker->text(150),
		'PTS_ID'=>rand(1,100),
		'USR_ID'=>rand(1,8)
    ];
});
