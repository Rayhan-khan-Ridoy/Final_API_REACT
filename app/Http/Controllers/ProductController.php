<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    //

    public function productList(){
        $products = Product::all(); //select * from students and also converts it into collection of student oobject
        return response()->json($products);
    }

    public function addProduct(Request $req)
    {
        // $this->validate($req,
        // [
        //     'pname'=>'required|regex:/^[A-Z a-z]+$/',
        //     'quantity'=>'required',
        //     'price'=>'required',
        //     "category"=>"required",
        //     'picture'=>'required|mimes:jpg,png',
        // ],
        // [
        //     'pname.required'=>'Please provide the product name',
        //     'quantity.required'=>'Quantity must be a number',
        //     'price.required'=>'Price must be positive and number'
        // ]);

        // $filename= $req->pname.'.'.$req->file('picture')->getClientOriginalExtension();
        //$req->file('picture')->storeAs('/public/picture/',$filename);
        $of = new Product();
        $of->pname = $req->pname;
        $of->quantity = $req->quantity;
        $of->price = $req->price;
        $of->category = $req->category;
        $of->picture = "storage/picture/default.jpg";
        //$of->picture= "storage/picture/".$filename;
        if($of->save()){
            return response->json(["msg"=>"Product Added Successfully"]);
        }
        return response->json(["msg"=>"Unsuccessfull"]);
    } 

    public function productDelete(Request $req){
        $product = Product::where('id',($req->id))->delete();
    }

    public function editProduct(Request $req){
        //$product = Product::where('id', $req->id)->first();
        $product = Product::where('id', $req->id)->first();
        $product->pname=$req->pname;
        $product->quantity=$req->quantity;
        $product->price=$req->price;
        $product->category=$req->category;
        $product->picture = $req->picture;
        $product->save();
    }
    public function productDetails(Request $req){
        $product = Product::where('id', $req->id)->first();
        return response()->json($product);
        //return response()->json($product->pname);
    }

}
