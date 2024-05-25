<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function televisions(){
        $products = Products::where('category', '=', 'televizori')->paginate(20);
        return view ('eponuda_template', ['products' => $products]);
    }

    public function tvRecievers(){
        $products = Products::where('category', '=', 'televizori')->paginate(20);
        return view ('eponuda_template', ['products' => $products]);
    }
}
