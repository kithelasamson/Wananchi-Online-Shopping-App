<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

public function addProduct(Request $req)
{
    $product = new Product;
    $product->name = $req->input('name');
    $product->description = $req->input('description');
    $product->price = floatval(preg_replace("/[^-0-9\.]/", "", $req->input('price')));
    $product->brand = $req->input('brand');
    $product->availability = $req->input('availability') === 'true' ? true : false;

    if ($req->hasFile('file')) {
        $file = $req->file('file');
        $file_path = $file->store('products');
        $product->file_path = $file_path;
    }

    $product->save();
    return $product;
}


    public function list()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function delete($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) 
        {
            return ["result" => "Product has been deleted successfully"];
        } 
        else 
        {
            return ["result" => "Operation for deleting has failed"];
        }
    }
    public function getProduct($id)
    {
        return product::find($id);
    }
    public function search($key)
    {
        return product::where('name','Like',"%$key%")->get();
    }
    public function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $cart = new Cart;
            $cart->user_id=$cart->session()->get('user')['id'];
            $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('/');
        }
        else
        {
            return redirect('./loginPage');
        }
    }
    public function cartItem()
    {
        $userId=get::Session('user')['id'];
        return Cart::where('user_id',userId)->count();

    }
      public function index()
    {
        $products = Product::all();

        return view('products', compact('products'));
    }
    public function cart()
    {
        return view('cart');
    }

    
}
