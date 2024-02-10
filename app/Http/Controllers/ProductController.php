<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(['name'=>'required','slug'=>'required','price'=>'required']);

        $product=new Product;
        $product->name=$request->name;
        $product->slug=$request->slug;
        $product->price=$request->price;
        $product->save();

        $response=['product'=>$product];

        return response($response,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // $request->validate([''])
        Product::where('id',$id)->update($request->all());

        return "product {$id} has been updated";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Product::destroy($id);
        
        return "product {$id} has been deleted";
    }

    public function search($name){

        $product=Product::where('name','like','%'.$name.'%')->get();

        return $product;
    }
}
