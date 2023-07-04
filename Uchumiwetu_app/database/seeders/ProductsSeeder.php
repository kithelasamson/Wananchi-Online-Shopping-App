<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Samsung Galaxy S9',
            'brand' => 'Samsung',
            'description' => 'A brand new, sealed Lilac Purple Verizon Global Unlocked Galaxy S9 by Samsung. This is an upgrade. Clean ESN and activation ready.',
            'file_path' => 'https://i.ebayimg.com/00/s/ODY0WDgwMA==/z/9S4AAOSwMZRanqb7/$_35.JPG?set_id=89040003C1',
            'availability' => 1,
            'price' => 698.88
        ]);

        // Add more product inserts here

        // Example:
        DB::table('products')->insert([
            'name' => 'HTC One M10',
            'brand' => 'Infinix',
            'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
            'availability' => 1,
            'file_path' => 'https://i.ebayimg.com/images/g/u-kAAOSw9p9aXNyf/s-l500.jpg',
            'price' => 129.99
        ]);
    }
}
