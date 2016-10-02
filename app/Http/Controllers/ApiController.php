<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Response;
use App\Product;
use StdClass;

class ApiController extends Controller
{
    //
    public function getProducts() {
        $products = Product::all();

        $resultData = [];
        foreach($products as $product) {
            $productData = new StdClass;

            $productData->id = $product->id;
            $productData->product_name = $product->product_name;
            $productData->sku = $product->sku;
            $productData->description = $product->description;
            $productData->image = $product->image;
            $productData->initial_inventory = $product->initial_inventory;
            $productData->allocation = $product->allocation;
            $productData->available = $product->available;
            $productData->initial_cost = $product->initial_cost;
            $productData->purchase_price = $product->purchase_price;
            $productData->wholesale_price = $product->wholesale_price;
            $productData->retail_price = $product->retail_price;
            $resultData[] = $productData;
        }

        return response()->json(['products' => $resultData]);
    }

    public function postProduct(Request $request) {
        $input = $request->all(); 

        if($input["id"]) {
             var_dump("update!");           
        } else { 
             var_dump("create new!");           
        }

    }

    public function getProduct($id) {
        $product = Product::where('id', '=', $id)->first();
        return response()->json(['product' => $product]);
    }
}
