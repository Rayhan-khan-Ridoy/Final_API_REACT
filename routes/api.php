<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminCrudController;
use App\Http\Controllers\adminController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\mailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//------start ridoy-----

Route::post('/adminLogin',[adminController::class,'adminLogin'])->name('adminLogin');
Route::post('/regis',[adminController::class,'registration'])->name('registration');

Route::get('/viewAllAdmin',[adminCrudController::class,'viewAllAdmin'])->name('viewAllAdmin');//->middleware('authorized');
Route::get('/viewAllUser',[adminCrudController::class,'viewAllUser'])->name('viewAllUser');//->middleware('authorized');
Route::get('/viewAllProducts',[adminCrudController::class,'viewAllProducts'])->name('viewAllProducts');//->middleware('authorized');
Route::get('/viewAllEmployee',[adminCrudController::class,'viewAllEmployee'])->name('viewAllEmployee');//->middleware('authorized');
Route::get('/viewAllBranche',[adminCrudController::class,'viewAllBranche'])->name('viewAllBranche');//->middleware('authorized');

Route::get('/viewInduvidualBranche/{id}',[adminCrudController::class,'viewInduvidualBranche'])->name('viewInduvidualBranche');//->middleware('authorized');
Route::get('/viewInduvidualProduct/{id}',[adminCrudController::class,'viewInduvidualProduct'])->name('viewInduvidualProduct');
Route::get('/viewInduvidualEmployee/{id}',[adminCrudController::class,'viewInduvidualEmployee'])->name('viewInduvidualEmployee');
Route::get('/viewInduvidualUser/{id}',[adminCrudController::class,'viewInduvidualUser'])->name('viewInduvidualUser');
Route::get('/viewInduvidualPerformance/{id}',[adminCrudController::class,'viewInduvidualPerformance'])->name('viewInduvidualPerformance');
Route::get('/viewInduvidualAdmin/{id}',[adminCrudController::class,'viewInduvidualAdmin'])->name('viewInduvidualAdmin');

Route::put('/editBranche/{id}',[adminCrudController::class,'editBranche'])->name('editBranche');

Route::put('/adminEdit/{id}',[adminCrudController::class,'adminEdit'])->name('adminEdit');
Route::get('/adminDelete/{id}',[adminCrudController::class,'adminDelete'])->name('adminDelete');
Route::get('/userDelete/{id}',[adminCrudController::class,'userDelete'])->name('userDelete');
Route::get('/productDelete/{id}',[adminCrudController::class,'productDelete'])->name('productDelete');
Route::get('/employeeDelete/{id}',[adminCrudController::class,'employeeDelete'])->name('employeeDelete');


Route::post('/addPerformance',[adminCrudController::class,'addPerformance'])->name('addPerformance');
Route::put('/editPerformance/{id}',[adminCrudController::class,'editPerformance'])->name('editPerformance');
Route::get('/viewAllPerformance',[adminCrudController::class,'viewAllPerformance'])->name('viewAllPerformance');
Route::get('/performaneDelete/{id}',[adminCrudController::class,'performaneDelete'])->name('performaneDelete');



//-----------mail---------
Route::get('/sendMail',[mailController::class,'sendMail']);


//-----end ridoy------

///ProductController
Route::post('/product/add',[ProductController::class,'addProduct']);
Route::get('/product/details/{id}',[ProductController::class,'productDetails'])->name('product.details');
Route::get('/product/list',[ProductController::class,'productList'])->name('product.list');
Route::get('/product/delete/{id}',[ProductController::class,'productDelete'])->name('product.delete');
Route::put('/product/edit/{id}',[ProductController::class,'editProduct'])->name('product.edit');

///SupplierController
Route::post('/supplier/add',[SupplierController::class,'addSupplier']);
Route::get('/supplier/details/{id}',[SupplierController::class,'supplierDetails'])->name('supplier.details');
Route::get('/supplier/list',[SupplierController::class,'supplierList'])->name('supplier.list');
Route::get('/supplier/delete/{id}',[SupplierController::class,'supplierDelete'])->name('supplier.delete');
Route::put('/supplier/edit/{id}',[SupplierController::class,'editSupplier'])->name('supplier.edit');

///OfficerController
Route::post('/officer/add',[EmployeeController::class,'addOfficer']);
Route::get('/officer/details/{id}',[EmployeeController::class,'officerDetails'])->name('officer.details');
Route::get('/officer/list',[EmployeeController::class,'officerList'])->name('officer.list');
Route::get('/officer/delete/{id}',[EmployeeController::class,'officerDelete'])->name('officer.delete');
Route::put('/officer/edit/{id}',[EmployeeController::class,'editOfficer'])->name('officer.edit');
