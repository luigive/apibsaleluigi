<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //el request debe ser general
    public function index(Request $request)
    {


        if ($request["category"] != ''){
            $products = Product::with('category')
            ->where('category',$request["category"])
            ->paginate();
            //se puede usar el get tambien.
        }else{
            $products = Product::with('category')->paginate();
        }
        //respuesta especifica
        return response()->json(['products'=>$products]);

       
    }

}
