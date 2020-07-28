<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 10)->create()->each(function(App\Product $product) {
        	$product->tags()->attach([
        		rand(1,10), 
                rand(11,20),
                rand(21,30), 
        	]);
        });
    }
}
