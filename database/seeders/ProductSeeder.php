<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        Product::create([
            'kode_produk' => 'P0001',
            'nama_produk' => 'Brand New Iphone 8',
            'harga_beli' => 100000,
            'harga_jual' => 150000,
            'image' => 'images/product/'.$faker->image(storage_path('app/public/images/product'), 100, 100, 'phone', false)          
        ]);
    }
}
