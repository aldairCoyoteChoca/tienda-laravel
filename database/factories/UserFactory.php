<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Administrador',
        'email' => 'administrador@admin.com',
        'photo' => 'image/icons/default.jpg',
        'phone'         => rand(5576324923, 5576324923),
        'address'       => $faker->sentence,
        'postal_code'   => rand(12345, 99999),
        'pedidos'       => 'RECIBIR',
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'remember_token' => Str::random(10),
    ];
});
