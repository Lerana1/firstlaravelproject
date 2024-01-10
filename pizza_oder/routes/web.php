<?php

use App\Models\product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/register',function () {
//     return view('register');
// });

// //login/register
Route::middleware(['admin_auth'])->group(function() {
    Route::redirect('/','login');
    Route::get('login',[AuthController::class,'loginpage'])->name('authloginpage');
    Route::get('register',[AuthController::class,'registerpage'])->name('authregisterpage');
});


//dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');




Route::middleware(['auth'])->group(function () {
    // //category
    //change password
    Route::middleware(['admin_auth'])->group(function() {
        Route::group(['prefix'=>'category','middleware' =>'admin_auth'],function(){
            Route::get('/list',[CategoryController::class,'list'])->name('listpage');
            Route::get('create/page', [CategoryController::class,'createpage'])->name('createpage');
            Route::post('create',[CategoryController::class, 'create'])->name('categorypage');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('deletepage');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('editpage');
            Route::post('update',[CategoryController::class,'update'])->name('updatepage');
        });
        //admin accout
        Route::prefix('admin')->group(function() {
            //change password
            Route::get('password/adminchange',[AdminController::class,'changepassord'])->name('change#adminpw');
            Route::post('change/adminpassword',[AdminController::class,'changeadmipassword'])->name('adminpasswordpage');
            //account profile
            Route::get('detail',[AdminController::class,'detail'])->name('detailpage');
            Route::get('edit',[AdminController::class,'edit'])->name('edit#page');
            Route::post('update/{id}',[AdminController::class,'update'])->name('updatepage');
            //admin list
            Route::get('list',[AdminController::class,'listpage'])->name('admin#list');
            Route::get('change/list',[AdminController::class,'changerole'])->name('changerole');
        });
        //products
        Route::prefix('products')->group(function() {
            Route::get('list',[ProductController::class,'list'])->name('list#page');
            Route::get('create',[ProductController::class,'create'])->name('create#page');
            Route::post('create',[ProductController::class,'createpage'])->name('create');
            Route::get('delete/{id}',[ProductController::class,'deletepage'])->name('delete#page');
            Route::get('view/{id}',[ProductController::class,'viewpage'])->name('view#page');
            Route::get('update/{id}',[ProductController::class,'updatepage'])->name('update#page');
            Route::post('update',[ProductController::class,'update'])->name('updatepizza');
            // //contact
            Route::get('contactadmin',[ProductController::class,'contactadmin'])->name('contact#name');

        });
        Route::prefix('order')->group(function() {
            Route::get('list',[OrderController::class,'orderlist'])->name('orderlist');
            Route::get('change/status',[OrderController::class,'status'])->name('status');
            Route::get('ajax/change/status',[OrderController::class,'ajaxchangestatus'])->name('changestatus');
            Route::get('listInfo/{ordercode}',[OrderController::class,'listInfo'])->name('listInfo');
        });

        //user

       //user
       Route::prefix('user')->group (function () {
        Route::get('lists',[UserController::class,'userlist'])->name('listuser');
        Route::get('change/role',[UserController::class,'userchangerole'])->name('changerole');
    });
    });


    //user
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
       Route::get('/home',[UserController::class,'home'])->name('homepage');
       Route::get('filter/{id}',[UserController::class,'filter'])->name('filter');

       Route::get('history',[UserController::class,'history'])->name('history');
       //cart list
       Route::prefix('cart')->group(function () {
        Route::get('cart',[UserController::class,'cart'])->name('cartpage');
       });

       //pizza
       Route::prefix('pizza')->group(function() {
        Route::get('details/{id}',[UserController::class,'details'])->name('pizza#detail');
       });
       //userpw change
       Route::prefix('password')->group(function () {
            Route::get('changepage',[UserController::class,'changepw'])->name('changepage');
            Route::post('change',[UserController::class,'changepage'])->name('change#page');
       });

       //change user
       Route::prefix('account')->group(function () {
            Route::get('change',[UserController::class,'accountpage'])->name('accountpage');
            Route::post('change/{id}',[UserController::class,'accountchange'])->name('account#change');
       });

       //contact
       Route::prefix('contact')->group(function() {
            Route::get('contact',[ContactController::class,'contactpage'])->name('contact#page');
            Route::post('contact',[ContactController::class,'contactuserpage'])->name('contactuser');
       });
       //ajax
       Route::prefix('ajax')->group(function() {
        Route::get('pizzalist',[AjaxController::class,'pizzalist'])->name('pizza#list');
        Route::get('cart',[AjaxController::class,'addcart'])->name('addCart');
        Route::get('order',[AjaxController::class,'order'])->name('ajaxorder');
        Route::get('clear/cart',[Ajaxcontroller::class,'clearcart'])->name('clearcart');
        Route::get('clear/current/product',[AjaxController::class,'clearcurrentproduct'])->name('clearcurrentproduct');
        Route::get('increase/viewcount',[AjaxController::class,'increaseviewcount'])->name('increase#viewcount');
       });
    });

});



