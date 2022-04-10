<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Officer;

class EmployeeController extends Controller
{
    //
    public function officerList(){
        $officer = Officer::all();
        return response()->json($officer);
    }

    public function officerDelete(Request $req){
        $officer = Officer::where('id',($req->id))->delete();
    }

    public function officerDetails(Request $req){
        $officer = Officer::where('id', $req->id)->first();
        return response()->json($officer);
    }

    public function addOfficer(Request $req){
        $st = new Officer();
        $st->name = $req->name;
        $st->password = $req->password;
        $st->email = $req->email;
        $st->salary=5000;
        $st->address = $req->address;
        $st->image = "storage/image/ooooo.JPG";
        $st->updated_at = "2022-03-17 12:42:55";
        $st->created_at = "2022-03-17 12:42:55";
        $st->supplier_id = 1;
        if($st->save()){
            return response->json(["msg"=>"Added Successfully"]);
        }
        return response->json(["msg"=>"Unsuccessfull"]);
    }

    public function editOfficer(Request $req){
        //return view();
        $st = Officer::where('id',$req->id)->first();
        $st->name = $req->name;
        $st->password = $req->password;
        $st->email = $req->email;
        $st->salary=$req->salary;
        $st->address = $req->address;
        $st->image = $req->image;
        $st->updated_at = $req->updated_at;
        $st->created_at = $req->created_at;
        $st->supplier_id = $req->supplier_id;
        $st->save();
    }
}
