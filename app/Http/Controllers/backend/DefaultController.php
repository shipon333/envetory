<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Products;
use App\Model\Suppliers;
use App\Model\Categorys;
use App\Model\Units;
use App\Model\Purchases;
use Auth;
class DefaultController extends Controller
{
   public function getCategory(Request $request){
   	$supplier_id = $request->supplier_id;
    $allCategory = Products::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
    // dd($allCategory->toArray());
    return response()->json($allCategory);
   }
   public function getProduct(Request $request){
   	$category_id = $request->category_id;
   	$allProduct = Products::where('category_id',$category_id)->get();
   	// dd($allProduct->toArray());
   	return response()->json($allProduct);
   }
   public function getProductStock(Request $request){
      $product_id = $request->product_id;
      $allProduct = Products::where('id',$product_id)->first()->quantity;
      return response()->json($allProduct);
   }
}
