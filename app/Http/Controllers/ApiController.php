<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Response;
use App\Product;
use StdClass;

class ApiController extends Controller
{
    public function getProducts(Request $request) {
        $order_type = $request->input('order_type');
        $order_filter = $request->input('order_filter');

        if($order_type == "orderName") {  
            return $this->orderProductResult($order_filter, 'product_name');
        }

        if($order_type == "orderStock") { 
            return $this->orderProductResult($order_filter, 'initial_inventory');
        }
        
        if($order_type == "orderAllocated") { 
            return $this->orderProductResult($order_filter, 'allocation');
        }

        if($order_type == "orderAvailable") { 
            return $this->orderProductResult($order_filter, 'available');
        }

        if($order_type == "orderCost") { 
            return $this->orderProductResult($order_filter, 'initial_cost');
        }

        return Product::orderBy('id', 'asc')->paginate();     
    }

    private function orderProductResult($filter, $col) {
        if($filter == "true") { 
            return Product::orderBy($col, 'asc')->paginate();     
        } 

        return Product::orderBy($col, 'desc')->paginate();     
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
        $order_type   = $request->input('order_type');
        $order_filter = $request->input('order_filter');
        $searchTerms  = $request->input('search');

        if($order_type == "orderName") {  
            return Product::where('product_name', 'LIKE', '%' . $searchTerms . '%')
                          ->orWhere('sku', 'LIKE', '%' . $searchTerms . '%')
                          ->orderBy('product_name', (($order_filter == "true") ? 'asc' : 'desc'))
                          ->paginate();     
        }

        if($order_type == "orderStock") {  
            return Product::where('product_name', 'LIKE', '%' . $searchTerms . '%')
                          ->orWhere('sku', 'LIKE', '%' . $searchTerms . '%')
                          ->orderBy('initial_inventory', (($order_filter == "true") ? 'asc' : 'desc'))
                          ->paginate();     
        }
        
        if($order_type == "orderAllocated") { 
            return Product::where('product_name', 'LIKE', '%' . $searchTerms . '%')
                          ->orWhere('sku', 'LIKE', '%' . $searchTerms . '%')
                          ->orderBy('allocation', (($order_filter == "true") ? 'asc' : 'desc'))
                          ->paginate();               
        }

        if($order_type == "orderAvailable") {  
            return Product::where('product_name', 'LIKE', '%' . $searchTerms . '%')
                          ->orWhere('sku', 'LIKE', '%' . $searchTerms . '%')
                          ->orderBy('available', (($order_filter == "true") ? 'asc' : 'desc'))
                          ->paginate();     
        }

        if($order_type == "orderCost") { 
            return Product::where('product_name', 'LIKE', '%' . $searchTerms . '%')
                          ->orWhere('sku', 'LIKE', '%' . $searchTerms . '%')
                          ->orderBy('initial_cost', (($order_filter == "true") ? 'asc' : 'desc'))
                          ->paginate();      
        }
         
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
