<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $title = $faker->sentence(4);
    return [
        'user_id' => 1,
        'category_id' => rand(1,2),
        'name' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->text(50),
        'description' => $faker->text(100),
        'file' => 'image/icons/productdefault.jpg',
        'status' => $faker->randomElement(['DRAFT', 'PUBLISHED']),
        'stock' => 1,
        'price' => rand(1,500),
    ];
});
