<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory()->create([
            'price'        => '60',
            'quantity'     => '10',
            'user_id'      => '10',
            'product_id'   => '10',
            // не знаем как прописаь Seeders для значений !!!
        ]);
    }
}
