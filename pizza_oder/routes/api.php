<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('product/list',[RouteController::class,'productlist']);
Route::get('category/list',[RouteController::class,'categorylist']);
Route::get('order/list',[RouteController::class,'orderlist']);
Route::get('contact/list',[RouteController::class,'contractlist']);
Route::get('admin/list',[RouteController::class,'adminlist']);
Route::post('create/category',[RouteController::class,'categorycreate']);
Route::post('create/contact',[RouteController::class,'contactcreate']);
Route::post('category/delete',[RouteController::class,'categorydelete']);
Route::post('detail/category',[RouteController::class,'categorydetail']);
Route::post('update/category',[RouteController::class,'categoryupdate']);

//127.0.0.1:8000/api/product/list
//127.0.0.1:8000/api/category/list
//127.0.0.1:8000/api/order/list
//127.0.0.1:8000/api/contact/list
//127.0.0.1:8000/api/admin/listt
//127.0.0.1:8000/api/create/category
//127.0.0.1:8000/api/create/contact
//127.0.0.1:8000/api/category/delete
//127.0.0.1:8000/api/update/category
//127.0.0.1:8000/api/detail/category

