<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\adminCrudController;

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
/*
Route::get('/adminLogin',[adminController::class,'adminLogin'])->name('adminLogin');
Route::post('/adminLoginSubmit',[adminController::class,'adminLoginSubmit'])->name('adminLoginSubmit');

Route::get('/adminDashboard',[adminController::class,'adminDashboard'])->name('adminDashboard')->middleware('authorized');
Route::get('/adminlogout',[adminController::class,'adminlogout'])->name('adminlogout');

Route::get('/regis',[adminController::class,'registration'])->name('registration')->middleware('authorized');
Route::post('/registration_submit',[adminController::class,'registration_submit'])->name('registration_submit')->middleware('authorized');
*/
Route::get('/viewAllAdmin',[adminCrudController::class,'viewAllAdmin'])->name('viewAllAdmin');//->middleware('authorized');
Route::get('/viewAllUser',[adminCrudController::class,'viewAllUser'])->name('viewAllUser');//->middleware('authorized');
Route::get('/viewAllProducts',[adminCrudController::class,'viewAllProducts'])->name('viewAllProducts');//->middleware('authorized');
Route::get('/viewAllEmployee',[adminCrudController::class,'viewAllEmployee'])->name('viewAllEmployee');//->middleware('authorized');

Route::put('/adminEdit/{id}',[adminCrudController::class,'adminEdit'])->name('adminEdit');
Route::get('/adminDelete/{id}',[adminCrudController::class,'adminDelete'])->name('adminDelete');
Route::get('/userDelete/{id}',[adminCrudController::class,'userDelete'])->name('userDelete');
Route::get('/productDelete/{id}',[adminCrudController::class,'productDelete'])->name('productDelete');
Route::get('/employeeDelete/{id}',[adminCrudController::class,'employeeDelete'])->name('employeeDelete');


Route::post('/addPerformance',[adminCrudController::class,'addPerformance'])->name('addPerformance');
Route::put('/editPerformance/{id}',[adminCrudController::class,'editPerformance'])->name('editPerformance');
Route::get('/viewAllPerformance',[adminCrudController::class,'viewAllPerformance'])->name('viewAllPerformance');
Route::get('/performaneDelete/{id}',[adminCrudController::class,'performaneDelete'])->name('performaneDelete');
