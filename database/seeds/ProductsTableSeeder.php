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
        //         
        $data = [];
        for($i=0;$i<=1000;$i++) {

            $iphoneVersion = rand(4, 8);
            $obj = [
             'product_name' => 'iPhone ' . $iphoneVersion . 's', 
             'sku' => 'IPHONE-00' . $iphoneVersion . '-' . rand(100000, 5000000),
             'barcode' => rand(100000, 5000000),
             'description' => "It's pretty cool!",
             'image' => 'pwet.png', 
             'initial_inventory' => rand(5, 100), 
             'allocation' => rand(5, 100), 
             'available' => rand(5, 100), 
             'initial_cost' => $this->random_float(50, 100),
             'purchase_price' => $this->random_float(50, 100), 
             'wholesale_price' => $this->random_float(50, 100),
             'retail_price' => $this->random_float(50, 100)
            ];

            $data[] = $obj;

        }

        DB::table('products')->insert($data);
        /*
        DB::table('products')->insert([
            ['product_name' => 'iPhone 6s', 
             'sku' => 'IP6-003',
             'barcode' => '1233193123',
             'description' => "It's pretty cool!",
             'image' => 'pwet.png', 
             'initial_inventory' => 10, 
             'allocation' => 3, 
             'available' => 33, 
             'initial_cost' => 34.97,
             'purchase_price' => 50.30, 
             'wholesale_price' => 52,
             'retail_price' => 60
             ],
            ['product_name' => 'iPhone 6+', 
             'sku' => 'IP6P-100',
             'barcode' => '1233193123',
             'description' => "Pretty big but what the hell? It's an Apple!",
             'image' => 'pwet.png', 
             'initial_inventory' => 20, 
             'allocation' => 10, 
             'available' => 30, 
             'initial_cost' => 50,
             'purchase_price' => 45.50, 
             'wholesale_price' => 55,
             'retail_price' => 75
             ],
            ['product_name' => 'iPhone 5s', 
             'sku' => 'IP5S-020',
             'barcode' => '1233193123',
             'description' => "Pretty big but what the hell? It's an Apple!",
             'image' => 'pwet.png', 
             'initial_inventory' => 5, 
             'allocation' => 20, 
             'available' => 12, 
             'initial_cost' => 25,
             'purchase_price' => 20.40, 
             'wholesale_price' => 25,
             'retail_price' => 30
             ],
            ['product_name' => 'iPhone 7', 
             'sku' => 'IP7-123',
             'barcode' => '1233193123',
             'description' => "It's the newest phone!",
             'image' => 'pwet.png', 
             'initial_inventory' => 30, 
             'allocation' => 10, 
             'available' => 15, 
             'initial_cost' => 30.00,
             'purchase_price' => 30.00, 
             'wholesale_price' => 35.00,
             'retail_price' => 35
             ], 
            ['product_name' => 'iPhone 7+', 
             'sku' => 'IP7P-890',
             'barcode' => '1233193123',
             'description' => "It's the newest phone but bigger!",
             'image' => 'pwet.png', 
             'initial_inventory' => 20, 
             'allocation' => 10, 
             'available' => 20, 
             'initial_cost' => 20.00,
             'purchase_price' => 20.00, 
             'wholesale_price' => 25.00,
             'retail_price' => 25
             ],
        ]); 
        */
    }

    function random_float ($min,$max) {
         return ($min+lcg_value()*(abs($max-$min)));
    }
}
