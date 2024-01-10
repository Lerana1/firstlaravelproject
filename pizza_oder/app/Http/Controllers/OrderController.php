<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderlist(){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->get();
        return view('admin.order.list',compact('order'));
    }
    public function status(Request $request) {
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');
                if($request->orderStatus == null) {
                    $order = $order->get();
                }else{
                    $order = $order->where('orders.status',$request->orderStatus)->get();
                }
                return view('admin.order.list',compact('order'));
    }

    //ajax change status
    public function ajaxchangestatus(Request $request){
        logger($request);
        Order::where('id',$request->orderId)->update([
            'status' =>$request->status
        ]);

}
//order list
    public function listinfo($ordercode) {
        $order = Order::where('order_code',$ordercode)->first();
        $orderlist = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$ordercode)
                    ->get();
       return view('admin.order.orderlist',compact('orderlist','order'));
    }
}
