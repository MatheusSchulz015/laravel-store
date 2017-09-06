<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         Product::create([
        	'name' => 'Produto',
        	'description' => 'sdasdadsad ',
        	'price' => 10.8,
        	'img' => 'product7.jpg'
        	]); 

         Product::create([
        	'name' => 'Produto2',
        	'description' => 'sdasdadsad ',
        	'price' => 20.8,
        	'img' => 'product11.jpg'
        	]);
         Product::create([
        	'name' => 'Produto2',
        	'description' => 'sdasdadsad ',
        	'price' => 20.8,
        	'img' => 'product11.jpg'
        	]);
         Product::create([
        	'name' => 'Produto2',
        	'description' => 'sdasdadsad ',
        	'price' => 20.8,
        	'img' => 'product11.jpg'
        	]);
    }
}
