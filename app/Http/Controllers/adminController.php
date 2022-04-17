<?php

namespace App\Http\Controllers;
//start google

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

//end google

use Illuminate\Http\Request;
use App\Models\Adminregistration;
use App\Models\Admin_reg_react;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Officer;
use App\Models\Cperformance;
use Validator;



class adminController extends Controller
{



public function adminLogin(Request $req){
        $validator = Validator::make($req->all(),[

            'username'=>'required|regex:/^[A-Z a-z . -]+$/|min:5|max:20|unique:adminregistrations,username',//
            'password'=>'required|min:8'
        ],
        [
            'username.required'=>'Please provide username--customErrMsg',
            'password.required'=>'Please provide your password--customErrMsg'

        ]);

          if($validator->fails())
          {
            return $validator->errors();
          }
          else{

                $ad = Admin_reg_react::where('username',$req->username)->where('password',$req->password)->first();

                         if($ad) {
                            session()->flush();
                            session()->put('id',$ad->id);
                            session()->put('username',$ad->username);
                            session()->flash('msg','login successful!');
                            return response()->json(["logged_admin"=>$ad,
                                                    "logged_session"=>session()->get('username')]);
                            //return redirect()->route('adminDashboard');
                            //session()->get('username')
                            //session()->has('username')
                            //session()->forget('username'),session()->forget(['id','username'])
                            //session()->flush()  --->session destroy
                            //session()->flash('key',value)  ---> This will store the value in session key for sub sequent request
                         }
                         else return "Login Failed";


                  }
                }

  public function adminDashboard(){



                                $nonGooleAdmin = Adminregistration::where('id',session()->get('id'))->first();
                                if($nonGooleAdmin){

                                  $all= Adminregistration::all();
                                  $allAdmins=count($all);
                                  $branchInfo=$nonGooleAdmin->branche;

                                  $totalMales=Adminregistration::where('gender','Male')->count();
                                  $totalFemales=Adminregistration::where('gender','Female')->count();

                                  $admin=Adminregistration::where('username',session()->get('username'))->first();

                                  $userCount = Customer::select('id')->get()->count();
                                  $productCount=Product::select('id')->get()->count();
                                  $employeeCount=Officer::select('id')->get()->count();
                                  $performance=Cperformance::select('Year','Sales','Expenses')->get();
                                  $data="";

                                  foreach ($performance as $key => $val) {
                                    $data.= "['".$val->Year."',".$val->Sales.",".$val->Expenses."],";
                                  }

                                  return view('adminDashboard',compact('data'))->with('admin',$admin)
                                                               ->with('allAdmin',$allAdmins)
                                                               ->with('totalMales',$totalMales)
                                                               ->with('totalFemales',$totalFemales)
                                                               ->with('userCount',$userCount)
                                                               ->with('productCount',$productCount)
                                                               ->with('performance',$performance)
                                                               ->with('branchInfo',$branchInfo)
                                                               ->with('employeeCount',$employeeCount);


                                }
                                else{
                                  $all= Adminregistration::all();
                                  $allAdmins=count($all);


                                  $totalMales=Adminregistration::where('gender','Male')->count();
                                  $totalFemales=Adminregistration::where('gender','Female')->count();

                                  $admin=Adminregistration::where('username',session()->get('username'))->first();

                                  $userCount = Customer::select('id')->get()->count();
                                  $productCount=Product::select('id')->get()->count();
                                  $employeeCount=Officer::select('id')->get()->count();
                                  $performance=Cperformance::select('Year','Sales','Expenses')->get();
                                  $data="";

                                  foreach ($performance as $key => $val) {
                                    $data.= "['".$val->Year."',".$val->Sales.",".$val->Expenses."],";
                                  }

                                  return view('adminDashboard',compact('data'))->with('admin',$admin)
                                                               ->with('allAdmin',$allAdmins)
                                                               ->with('totalMales',$totalMales)
                                                               ->with('totalFemales',$totalFemales)
                                                               ->with('userCount',$userCount)
                                                               ->with('productCount',$productCount)
                                                               ->with('performance',$performance)

                                                               ->with('employeeCount',$employeeCount);
                                }

                  }



  public function registration(Request $req){


    $validator = Validator::make($req->all(),[
        'name'=>'required|min:5',
        'username'=>'required|regex:/^[A-Z a-z . -]+$/|min:5|max:20|unique:admin_reg_reacts,username',//
        'password'=>'required|min:8',
        'email'=>'required|email|unique:admin_reg_reacts,email',
        'address'=>'required'
    ],
    [
        'name.required'=>'Please provide name--customErrMsg',
        'username.required'=>'Please provide username--customErrMsg',
        'password.required'=>'Please provide your password--customErrMsg',
        'email.required'=>'Please provide email--customErrMsg',
        'address.required'=>'Please provide address--customErrMsg'

    ]);

      if($validator->fails())
      {
        return $validator->errors();
      }
      else{

            $ad = new Admin_reg_react();
//            dd($ad);
            $ad->name = $req->name;
            $ad->username = $req->username;
            $ad->password = $req->password;
            $ad->email = $req->email;
            $ad->address = $req->address;

            $ad->save(); //runs query in db

            session()->flash('msg4','ADMIN REGISTRATION SUCCESSFULL! LOGIN NOW!');

            return response()->json($ad);
            }
}


  public function adminlogout(){
        session()->flush();
        return redirect()->route('adminLogin');
  }


}
