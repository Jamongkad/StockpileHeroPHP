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
             'company_id' => 1,
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
    }

    function random_float ($min,$max) {
         return ($min+lcg_value()*(abs($max-$min)));
    }
}
