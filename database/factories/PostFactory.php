<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'PTS_Contenido' => $faker->text(150),
		'USR_ID' => rand(1,8)
    ];
});
