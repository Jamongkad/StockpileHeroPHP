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
        return Product::paginate();
    }

    public function postProduct(Request $request) {
        $input = $request->all(); 

        if($input["id"]) {
             var_dump("update!");           
        } else { 
             $product = new Product;
             $product->product_name = $input["product_name"];
             $product->image = ""; 
             $product->allocation = 0;
             $product->available = $input["initial_inventory"];;
             $product->description = $input["description"];
             $product->barcode = $input["barcode"];
             $product->sku = $input["sku"];
             $product->initial_inventory = $input["initial_inventory"];
             $product->initial_cost = $input["initial_cost"];
             $product->purchase_price = $input["purchase_price"];
             $product->wholesale_price = $input["wholesale_price"];
             $product->retail_price = $input["retail_price"];
             $product->save();
             return response()->json(['status' => "success"]);
        }

    }

    public function searchProduct(Request $request) {
        $searchTerms = $request->input('search');
        return Product::where('product_name', 'LIKE', '%' . $searchTerms . '%')->orWhere('sku', 'LIKE', '%' . $searchTerms . '%')->paginate();     
    }

    public function getProduct($id) {
        $product = Product::where('id', '=', $id)->first();
        return response()->json(['product' => $product]);
    }

    public function uploadFile(Request $request) { 
		$destinationPath = base_path() . '/public/upload/images/';
        $file = $request->file('file');
        $params = $request->input('goesIntoForm');

		 //Create folder if not exist		
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }	

	    $fileName = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
		$upload_success = $file->move($destinationPath, $fileName);

        $data = [
            "origfileName" => $file->getClientOriginalName(), 
			"newFileName" => $fileName,
            "fileExtension" => $file->getClientOriginalExtension(),
            "fileMime" => $file->getClientMimeType(),
            "fileSize" => $file->getClientSize(),
            "isValid" => $file->isValid(),
			"msg" => $file->getErrorMessage(),
			"uploadStatus" => true,
            "params" => $params, 
        ];

        return response()->json($data);
    }
}
