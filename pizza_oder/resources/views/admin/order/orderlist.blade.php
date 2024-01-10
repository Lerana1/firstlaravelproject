@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{route('orderlist')}}" class="mb-3"><i class="fa-solid fa-backward"></i> back</a>

                        <div class="row col-5">
                            <div class="card mb-4">
                                <div class="card-header ">
                                    <h3><i class="fa-regular fa-clipboard"></i> Order Information </h3>
                                    <small class="text-danger">Inclute delivery charges</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col"><i class="fa-solid fa-person"></i> Customer Name</div>
                                    <div class="col"><i class="fa-solid fa-person"></i> {{strtoupper( $orderlist[0]->user_name)}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col"><i class="fa-solid fa-bars"></i> Order Code</div>
                                    <div class="col"><i class="fa-solid fa-bars"></i> {{$orderlist[0]->order_code}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col"><i class="fa-solid fa-calendar-days"></i> Order DAte</div>
                                    <div class="col"><i class="fa-solid fa-calendar-days"></i> {{$orderlist[0]->created_at->format('F-j-Y')}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col"><i class="fa-solid fa-calendar-days"></i> Total price</div>
                                        <div class="col"><i class="fa-solid fa-money-bill"></i> {{$order->total_price}} kyats</div>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>User Name</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order DAte</th>
                                    <th>Qty</th>
                                    <th>Amout</th>

                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($orderlist as $o )
                                <tr class="tr-shadow text-center">
                                    <td class="col-1"></td>
                                    <td>{{$o->user_name}}</td>
                                    <td class="col-2"> <img  src="{{asset('storage/'.$o->product_image)}}" alt="" class="img-thumbnail"></td>
                                    <td>{{$o->product_name}}</td>
                                    <td>{{$o->created_at->format('F-j-Y')}}</td>
                                    <td >{{$o->qty}}</td>
                                    <td>{{$o->total}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

