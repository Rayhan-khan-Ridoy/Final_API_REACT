<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adminregistration;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Officer;
use App\Models\Cperformance;
use App\Models\Branche;

class adminCrudController extends Controller
{
  public function viewAllAdmin()
  {
          $admins = Adminregistration::select('id', 'name', 'username', 'email', 'gender', 'pro_pic')->get();
          //return view('viewAllAdmin')->with('admins',$admins);
          return response()->json($admins);
  }

  public function viewInduvidualAdmin(Request $req)
  {
          $admins = Adminregistration::where('id', $req->id)->first();

          return response()->json([
            "msg" => "this is individual Admin info!",
            "admin" => $admins
          ]);
  }




  public function adminEdit(Request $req)
  {
    /*$this->validate($req,
                [
                    'name'=>'required',
                    'username'=>'required|regex:/^[A-Z a-z . -]+$/|min:5|max:20|unique:adminregistrations,username',//
                    'email'=>'required|email|unique:adminregistrations,email',
                    'gender'=>'required',
                    'pro_pic'=>'required|mimes:jpg,png'
                ],
                [
                    'username.required'=>'Please provide username',
                    'username.max'=>'Username must not exceed 20 alphabets'


                ]
            );*/



          $admin = Adminregistration::where('id', $req->id)->first();

          $admin->name = $req->name;
          $admin->username = $req->username;
          $admin->email = $req->email;
          $admin->gender = $req->gender;

          $admin->save();
          session()->flash('msg2', 'Updated successfully!');
          return response()->json([
            "msg" => "Admin Edited Succesfully !",
            "admin" => $admin
          ]);
  }


  public function adminDelete(Request $req)
  {

          $admin = Adminregistration::where('id', ($req->id))->delete();
          session()->flash('msg3', 'Admin deleted successfully!');
          return response()->json([
            "msg" => "Admin Deleted Succesfully !"
          ]);
  }

  /*
//--------------start  searching
public function searchAdmin(Request $req){


                                if($req->search != ""){
                                  $searchVar=$req->search; //for see what is searching in search box
                                  //dd($search);
                                  $admin = Adminregistration::where('username',"LIKE", "%{$req->search}%")->get();
                                  return view('viewAllAdmin_search')
                                  ->with("searchVar",$searchVar)
                                  ->with("admin",$admin);
                                }
                                else {
                                  return back();
                                }
                    }
public function searchCustomer(Request $req){


                                          if($req->search != ""){
                                            $searchVar=$req->search; //for see what is searching in search box
                                            //dd($search);
                                            $customer = Customer::where('username',"LIKE", "%{$req->search}%")->get();
                                            return view('viewAllCustomer_search')
                                            ->with("searchVar",$searchVar)
                                            ->with("customer",$customer);
                                          }
                                          else {
                                            return back();
                                          }
                                        }


  public function searchProduct(Request $req){


                                  if($req->search != ""){
                                        $searchVar=$req->search; //for see what is searching in search box
                                        //dd($search);
                                        $product = Product::where('pname',"LIKE", "%{$req->search}%")->get();
                                        return view('viewAllProduct_search')
                                        ->with("searchVar",$searchVar)
                                        ->with("product",$product);
                                  }
                                  else {
                                    return back();
                                  }
                             }
public function searchEmployee(Request $req){


                                 if($req->search != ""){
                                       $searchVar=$req->search; //for see what is searching in search box
                                       //dd($search);
                                       $employees = Officer::where('name',"LIKE", "%{$req->search}%")->get();
                                       return view('viewAllEmployee_search')
                                       ->with("searchVar",$searchVar)
                                       ->with("employees",$employees);
                                 }
                                 else {
                                   return back();
                                 }
              }

//--------------end  searching
*/

  //--------------start user or customer + employee + company performane activities
  public function addPerformance(Request $req)
  {
          /* $this->validate($req,
        [
            'Year'=>'required|unique:cperformances,Year',
            'Sales'=>'required',//
            'Expenses'=>'required'
          ],
        [
            'Year.required'=>'Please provide year',
            'Sales.required'=>'Please provide Sales',
            'Expenses.required'=>'Please provide Expenses'


        ]
      );*/

          $perf = new Cperformance();

          $perf->Year = $req->Year;
          $perf->Sales = $req->Sales;
          $perf->Expenses = $req->Expenses;

          $perf->save(); //runs query in db

          session()->flash('msg4', 'Performances added!');

          //return back();
          return response()->json([
            "msg" => "Performance added Succesfully!",
            "performance" => $perf
          ]);
  }



  public function editPerformance(Request $req)
  {

    /*                  $this->validate($req,
                        [
                            'Year'=>'required|unique:cperformances,Year',
                            'Sales'=>'required',//
                            'Expenses'=>'required'
                          ],
                        [
                            'Year.required'=>'Please provide year',
                            'Sales.required'=>'Please provide Sales',
                            'Expenses.required'=>'Please provide Expenses'


                        ]
                    );
*/

          $perf = Cperformance::where('id', $req->id)->first();
          $perf->Year = $req->Year;
          $perf->Sales = $req->Sales;
          $perf->Expenses = $req->Expenses;

          $perf->save(); //runs query in db

          session()->flash('msg4', 'Performances added!');

          return response()->json([
            "msg" => 'Performances Edited!',
            "performance" => $perf
          ]);
  }


  public function viewAllPerformance()
  {
          $perf = Cperformance::select('id', 'Year', 'Sales', 'Expenses')->get();

          //  dd($userCount);
          return response()->json([
            "msg" => "All Company performances are: !",
            "performances" => $perf
          ]);
  }

  public function viewInduvidualPerformance(Request $req)
  {
          $perf = Cperformance::where('id', $req->id)->first();

          return response()->json([
            "msg" => "This is individual Performance!",
            "performance" => $perf
          ]);
  }

  public function performaneDelete(Request $req)
  {

          $perf = Cperformance::where('id', ($req->id))->delete();
          session()->flash('msg3', 'Performance deleted successfully!');
          //return redirect ()->route ( 'viewAllPerformance' );
          return response()->json($perf);
  }





  public function viewAllEmployee()
  {
    $employees = Officer::select('id', 'name', 'email', 'salary', 'address')->get();

          //dd($employees);
          //return view('viewAllEmployee')->with('employees',$employees);
          return response()->json([
            "msg" => "All Officers are: !",
            "Officers" => $employees
          ]);
  }

  public function viewInduvidualEmployee(Request $req)
  {
    $Officer = Officer::where('id', $req->id)->first();

          return response()->json([
            "msg" => "this is individual Officer!",
            "Officer" => $Officer
          ]);
  }

  public function employeeDelete(Request $req)
  {

          $emp = Officer::where('id', ($req->id))->delete();
          return response()->json(["msg" => "Employee deleted Succesfully!"]);
  }

  //----------user activities-----------------
  public function viewAllUser()
  {
          $users = Customer::select('id', 'username', 'email', 'created_at')->get();

          //  dd($userCount);
          // return view('viewAllUser')->with('users',$users);
          return response()->json([
            "msg" => "All customers are: !",
            "customers" => $users
          ]);
  }
  public function viewInduvidualUser(Request $req)
  {
          $users = Customer::where('id', $req->id)->first();

          return response()->json([
            "msg" => "this is individual user!",
            "users" => $users
          ]);
  }

  public function userDelete(Request $req)
  {

          $users = Customer::where('id', ($req->id))->delete();
          session()->flash('msg3', 'Customer deleted successfully!');
          //return redirect ()->route ( 'viewAllUser' );
          return response()->json([
            "msg" => 'user deleted!'
          ]);
  }
  //--------------end activities



  //--------------start product  activities

  public function viewAllProducts()
  {
          $products = Product::select('id', 'pname', 'quantity', 'price', 'category')->get();
          return response()->json($products);
  }

  public function viewInduvidualProduct(Request $req)
  {
          $product = Product::where('id', $req->id)->first();

          return response()->json([
            "msg" => "this is individual Product!",
            "product" => $product
          ]);
  }

  public function productDelete(Request $req)
  {

          $products = Product::where('id', ($req->id))->delete();
          return response()->json(["msg" => "Product deleted Succesfully!"]);
  }

  //--------------end product activities


  //--------------start branchs activities
  public function viewAllBranche()
  {
    $branchs = Branche::select('id', 'bname', 'email')->get();

          return response()->json([
            "msg" => "All Branches are!",
            "branch" => $branchs
          ]);
  }
  public function viewInduvidualBranche(Request $req)
  {
    $branchs = Branche::where('id', $req->id)->first();

          return response()->json([
            "msg" => "this is individual Branch!",
            "branch" => $branchs
          ]);
  }
  public function editBranche(Request $req)
  {
          $branchs = Branche::where('id', $req->id)->first();

          $branchs->bname = $req->bname;
          $branchs->email = $req->email;
          $branchs->pro_pic = $req->pro_pic;

          $branchs->save(); //runs query in db
          return response()->json([
            "msg" => "Branch edited Succesfully!",
            "branch" => $branchs
          ]);
  }

  //--------------end branchs activities
}
