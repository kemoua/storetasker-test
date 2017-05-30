<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function insertProduct(Request $request) {
    	$name=$request->input('newProduct');
		DB::table('products')->insert(
		    ['name' => $name, 'price' => 0]
		);
		
		$products = DB::table('products')->get();
        return Redirect::back();

    }

    public function search($search){
    	$products = DB::table('products')
            ->select('name','price')
            ->where('name','LIKE','%'.$search.'%')
            ->get();
        return json_encode($products);

    	/*
			Another simple way is to do the same as the function show().
			It would return every tuples in the table and we can filter them in the view using ng-repeat="x in products | filter:search"
			This limits the type of query though.
    	*/ 
    	//$products = DB::table('products')->get();
        //return json_encode($products);
    }


    public function show(){
    	$products = DB::table('products')->get();

        return view('welcome', ['products' => $products]);
    }
}