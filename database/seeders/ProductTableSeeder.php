<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\Product::factory()->create([
             'name' => 'Test Product',
             'email' => 'test@example.com',
             'image'        => 'URL(https//:)',
//            автодобавление картинок с автоотображением (Пример:слайдер)
             'description'  => 'Молоко',
             'content'      => 'Цельное',
             'price'        => '60',
             'quantity'     => '10',
         ]);
    }
}
