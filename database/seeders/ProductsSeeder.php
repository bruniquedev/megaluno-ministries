<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductsSeeder extends Seeder
{

/*
 Seeder to populate our products table with some data to work with
*/

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Then inside run()
        DB::table('products')->insert([
            'name' => 'Samsung Galaxy S9',
            'description' => 'A brand new, sealed Lilac Purple Verizon Global Unlocked Galaxy S9 by Samsung. This is an upgrade. Clean ESN and activation ready.',
            'photo' => 'big1.jpg',
            'price' => 698.88
         ]);
 
         DB::table('products')->insert([
             'name' => 'Apple iPhone X',
             'description' => 'GSM & CDMA FACTORY UNLOCKED! WORKS WORLDWIDE! FACTORY UNLOCKED. iPhone x 64gb. iPhone 8 64gb. iPhone 8 64gb. iPhone X with iOS 11.',
             'photo' => 'big2.jpg',
             'price' => 983.00
         ]);
 
         DB::table('products')->insert([
             'name' => 'Google Pixel 2 XL',
             'description' => 'New condition
 • No returns, but backed by eBay Money back guarantee',
             'photo' => 'big3.jpg',
             'price' => 675.00
         ]);
 
         DB::table('products')->insert([
             'name' => 'LG V10 H900',
             'description' => 'NETWORK Technology GSM. Protection Corning Gorilla Glass 4. MISC Colors Space Black, Luxe White, Modern Beige, Ocean Blue, Opal Blue. SAR EU 0.59 W/kg (head).',
             'photo' => 'small4.jpg',
             'price' => 159.99
         ]);
 
         DB::table('products')->insert([
             'name' => 'Huawei Elate',
             'description' => 'Cricket Wireless - Huawei Elate. New Sealed Huawei Elate Smartphone.',
             'photo' => 'small5.jpg',
             'price' => 68.00
         ]);
 
         DB::table('products')->insert([
             'name' => 'HTC One M10',
             'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
             'photo' => 'small6.jpg',
             'price' => 129.99
         ]);
    }
}
