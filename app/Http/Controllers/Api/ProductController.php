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

    //recordar que cuando coloco el search, me quita el "scope" y coloca la primera letra en minuscula

            $products = Product::with('category')
            ->searchNameProducts($request["name"])
            ->searchCategory($request["category"])
            ->orderProduct($request["orderby"])
            ->paginate();


        //respuesta especifica
        return response()->json(['products'=>$products]);

       
    }

}
