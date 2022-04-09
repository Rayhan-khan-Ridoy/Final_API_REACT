<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController extends Controller
{
    //
    public function supplierList(){
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    public function supplierDelete(Request $req){
        $supplier = Supplier::where('id',($req->id))->delete();
    }

    public function supplierDetails(Request $req){
        $supplier = Supplier::where('id', $req->id)->first();
        return response()->json($supplier);
    }

    public function addSupplier(Request $req){
        $st = new Supplier();
        $st->name = $req->name;
        $st->password = $req->password;
        $st->email = $req->email;
        $st->address = $req->address;
        $st->salary=5000;
        if($st->save()){
            return response->json(["msg"=>"Added Successfully"]);
        }
        return response->json(["msg"=>"Unsuccessfull"]);
    }

    public function editSupplier(Request $req){
        //return view();
        $st = Supplier::where('id',$req->id)->first();
        $st->name = $req->name;
        $st->password = $req->password;
        $st->email = $req->email;
        $st->address = $req->address;
        $st->salary=$req->salary;
        $st->save();
    }

}