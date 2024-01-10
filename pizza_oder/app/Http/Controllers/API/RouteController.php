<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productlist(){
        $products = product::orderBy('created_at','desc')->get();
        $data = [
            'product' =>$products,
        ];
        return response()->json($data,200);
    }
    //get all caegory list
    public function categorylist(){
        $category = Category::orderBy('created_at','desc')->get();
        return response()->json($category, 200);
    }
    //get all orderlist
    public function orderlist() {
        $order = Order::get();
        return response()->json($order, 200);
    }
    //get all contractlist
    public function contractlist() {
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }
    //get all admin
    public function adminlist() {
        $admin = User::get();
        return response()->json($admin, 200);
    }

    //create category
    public function categorycreate(Request $request) {
        $data = [
            'category_name' => $request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response=Category::create($data);
        return response()->json($response, 200);
    }
    //create contact
    public function contactcreate(Request $request){
        $data = [
            'name' =>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $response=Contact::create($data);
        return response()->json($response, 200);
    }
    //delete category
    public function categorydelete(Request $request) {
        $data = Category ::where('id',$request->category_id)->first();
        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success'], 200);
        }
        return response()->json(['status'=>false,'message'=>'there is no category'], 500);
    }
    //category edit
    public function categorydetail(Request $request) {
        $data = Category::where('id',$request->category_id)->first();
        if(isset($data)){
            return response()->json(['status'=>true,'category'=>$data], 200);
        }
        return response()->json(['status'=>false,'category'=>'there is no category'], 500);
    }
    //update category
    public function categoryupdate(Request $request) {
        $categoryid = $request->category_id;
        $dbSource = Category::where('id',$categoryid)->first();
        if(isset($dbSource)) {
            $data = $this->getcategory($request);
            Category::where('id',$categoryid)->update($data);
            $response = Category::where('id',$categoryid)->first();
            return response()->json(['status'=>true,'message'=>'category update success','category'=>$response], 200);
        }
        return response()->json(['status'=>false,'message'=>'there is no category'], 500);

    }

    //category data
    private function getcategory($request) {
        return[
            'category_name'=>$request->category_name,
            'created_at'=>Carbon::now(),
            'updated_at' =>Carbon::now()
        ];
    }

}
