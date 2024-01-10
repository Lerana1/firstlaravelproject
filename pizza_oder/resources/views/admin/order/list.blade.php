@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>
                   <div class="row my-3 ms-1">
                    <div class="col-3">
                        <h3><i class="fa-solid fa-coins me-2"></i> {{count($order)}}</h3>
                    </div>
                   </div>
                   <form action="{{route('status')}}" method="get">
                    @csrf
                    <div class="d-flex">
                        <select name="orderStatus" id="orderStatus" class="form-control col-2 mb-3" method="post">
                            <option value="">all</option>
                            <option value="0" @if(request('orderStatus'== '0')) selected @endif>Pending...</option>
                            <option value="1" @if(request('orderStatus'== '1')) selected @endif >Accept</option>
                            <option value="2" @if(request('orderStatus'== '2')) selected @endif >Reject</option>
                        </select>
                        <button type="submit" class="btn btn-dark text-white mb-2">search</button>
                   </div>
                </form>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order_code</th>
                                    <th>total_price</th>
                                    <th>status</th>
                                    <th>order date</th>
                                </tr>
                            </thead>
                            <tbody id="datalist">
                                @foreach ($order as $o )
                                <tr class="tr-shadow">
                                    <input type="hidden" name="" id="orderId" value="{{$o->id}}">
                                    <td>{{$o->user_id}}</td>
                                    <td>{{$o->user_name}}</td>
                                    <td>
                                        <a href="{{route('listInfo',$o->order_code)}}">{{$o->order_code}}</a>
                                    </td>
                                    <td>{{$o->total_price}}</td>
                                    <td>
                                        <select name="status"class="form-control changestatus">
                                            <option value="0" @if ($o->status == 0) selected @endif>Pending...</option>
                                            <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>
                                    <td>{{$o->created_at->format('F-j-Y')}}</td>
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
@section('scriptsource')
    <script>
        $(document).ready(function () {
            //change status

         $('.changestatus').change(function () {
            $current = $(this).val();
            $nodes = $(this).parents("tr");
            $orderId = $nodes.find('#orderId').val();
            $data = {
                'orderId' : $orderId,
                'status' : $current
            }
            console.log($data);
            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/order/ajax/change/status',
                data : $data,
                datatype : 'json',
            })

        })
    })
</script>
@endsection
