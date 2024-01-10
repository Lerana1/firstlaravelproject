<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function home() {
        $pizza = product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart','history'));
    }

    //change password
    public function changepw() {
        return view('user.password.change');
    }
    public function changepage(Request $request) {
        $this->passwordValidationCheck($request);
        $currentuserid =Auth::user()->id;
        $user = User::select('password')->where('id',$currentuserid)->first();
        $dbpassword = $user->password;
        if(Hash::check($request->oldpassword, $dbpassword)) {
            $data = ['password'=>Hash::make($request->newpassword)];

            User::where('id',Auth::user()->id)->update($data);

            return back()->with(['changeSuccess'=>'password change success']);
        }
        return back()->with(['notMatch' =>'the old password is worng,try again']);
    }

    //User account change
    public function accountpage() {
        return view('user.profile.account');
    }
    public function accountchange($id,Request $request) {
        $this->accountValidationCheck($request);
        $data = $this -> getuserdata($request);
        //image
        if($request->hasfile('image')) {
            //old image name
            $dbimage =user::where('id',$id)->first();
            $dbimage =$dbimage->image;

            if($dbimage != null) {
                Storage::delete('public/',$dbimage);
            }
            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return back()->with(['accountSuccess'=>'Admin updated success...']);
    }
    //filter
    public function filter($category_id){
        $pizza = product::where('category_id',$category_id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart','history'));
    }

    //pizzadetail
    public function details($id) {
        $pizza = Product::where('id',$id)->first();
        $list = Product::get();
        return view('user.main.details',compact('pizza','list'));
    }

    //cart page
    public function cart() {
        $cartlist = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        $totalprice = 0;
        foreach($cartlist as $t){
            $totalprice += $t->pizza_price*$t->qty;
        }
        return view('user.main.cart',compact('cartlist','totalprice'));
    }

    //history
    public function history() {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

     //change role
     public function userlist() {
        $users = User::where('role','user')->paginate(3);
        return view('admin.layouts.role',compact('users'));
     }
     public function userchangerole(Request $request) {
        $source = [
            'role' => $request->role
        ];
        User::where('id',$request->userid)->update($source);
     }


    private function getuserdata($request) {
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address
        ];
    }

      //acc validation check
      private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
        ])->validate();
    }

    // check password

    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldpassword'=>'required | min:6',
            'newpassword'=>'required | min:6',
            'confirmpassword'=>'required | min:6 |max:10| same:newpassword',
        ],[
            'oldpassword.required'=>'wrong password,please try again',
            'newpassword.required'=>'wrong password,please try again',
            'confirmpassword.required'=>'wrong password,please try again',

        ])->validate();
    }
}
