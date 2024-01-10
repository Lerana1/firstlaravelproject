<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzalist(Request $request){
       if($request->status == 'desc') {
        $data = product::orderBy('created_at','desc')->get();
       }else {
        $data = product::orderBy('created_at','asc')->get();
       }
        return $data;
    }
    public function addcart(Request $request) {
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message'=>'add to cart compelete',
            'status' => 'success'
        ];
        return  response()->json($response, 200);
    }

    //order
    public function order(Request $request){
        $total = 0;
        foreach($request->all() as $item){
          $data= OrderList::create([
                'user_id' =>$item['user_id'],
                'product_id'=>$item['product_id'],
                'qty' =>$item['qty'],
                'total'=>$item['total'],
                'order_code'=>$item['order_code'],
            ]);

            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price'=>$total+3000
        ]);
        $response = [
            'status'=>'true',
            'message'=>'Order compelete'
        ];
        return  response()->json($response, 200);
    }

    //clear cart
    public function clearcart() {
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    public function clearcurrentproduct(Request $request) {
        Cart::where('user_id',Auth::user()->id)
              ->where('product_id',$request->productId)
              ->where('id',$request->Id)
              ->delete();
    }


    public function increaseviewcount(Request $request) {
        $pizzas = Product::where('id',$request->product_id)->first();
        $data = [
            'view_count' => $pizzas->view_count+1
        ];
        Product::where('id',$request->product_id)->update($data);
    }

    private function getOrderData($request) {
        return [
            'user_id'=>$request->userid,
            'product_id'=>$request->pizzaid,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
        ];
    }
}
