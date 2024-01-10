
  @extends('user.layouts.master')
  @section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0 " id="data">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartlist as $t )
                        <tr>
                            {{-- <input type="hidden" value="{{$t->pizza_price}}" id="pizzaprice"> --}}
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                {{$t->pizza_name}}
                                <input type="hidden" id="Id" value="{{$t->id}}">
                                <input type="hidden" id="userId" value="{{$t->user_id}}">
                                <input type="hidden" id="productId" value="{{$t->product_id}}">
                            </td>
                            <td class="align-middle" id="price">{{$t->pizza_price}} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$t->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total"> {{$t->pizza_price*$t->qty}} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btncancel"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">{{$totalprice}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalprice">{{$totalprice+3000}}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderbtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearbtn">Cart Clear</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
@section('scriptsource')
<script >
        $(document).ready(function () {
            $('.btn-plus').click(function () {
            $nodes = $(this).parents("tr");
            $price = Number($nodes.find('#price').text().replace("Kyats",""));
            $qty = Number($nodes.find('#qty').val());
            $total = $price*$qty;
            $nodes.find('#total').html($total+"Kyats");
            summary();

        })
        $('.btn-minus').click(function () {
            $nodes = $(this).parents("tr");
            $price = Number($nodes.find('#price').text().replace("Kyats",""));
            $qty = Number($nodes.find('#qty').val());
            $total = $price*$qty;
            $nodes.find('#total').html($total+"Kyats");
            summary();
        })

        function summary() {
                    $totalprice = 0
                    $('#data tr').each(function(index,row) {
                      $totalprice += Number($(row).find('#total').text().replace("Kyats",""));
                    });

                    $("#subtotal").html(`${$totalprice}Kyats`);
                    $("#finalprice").html(`${$totalprice+3000}Kyats`);
                }
    })
</script>

<script>
   $('#orderbtn').click(function() {
    $random = Math.floor(Math.random() * 10000001);
    $orderlist = [];
    $('#data tbody tr').each(function(index,row) {
        $orderlist.push({
            'user_id': $(row).find('#userId').val(),
            'product_id': $(row).find('#productId').val(),
            'qty': $(row).find('#qty').val(),
            'total' : $(row).find('#total').text().replace('Kyats',"")*1,
            'order_code' :'POS'+$random
        });
    });
    $.ajax({
            type : 'get',
            url : 'http://localhost:8000/user/ajax/order',
            data : Object.assign({},$orderlist),
            datatype : 'json',
            success : function(response){
                if(response.status == 'true') {
                    window.location.href = 'http://localhost:8000/user/home';
                }
        }
    })

   });


   $('#clearbtn').click (function () {
        $('#data tbody tr').remove();
        $('#subtotal').html('0','Kyats');
        $('#finalprice').html('0','Kyats');
        $.ajax({
            type : 'get',
            url : 'http://localhost:8000/user/ajax/clear/cart',
            datatype : 'json',
        })
    });

    $('.btncancel').click(function() {
            $nodes = $(this).parents("tr");
            $productId = $nodes.find('#productId').val();
            $Id = $nodes.find('#Id').val()
            $.ajax({
            type : 'get',
            url : 'http://localhost:8000/user/ajax/clear/current/product',
            data :{'productId':$productId,'Id':$Id},
            datatype : 'json',
        })
            $nodes.remove();
            $totalprice = 0
            $('#data tr').each(function(index,row) {
            $totalprice += Number($(row).find('#total').text().replace("Kyats",""));
            });
            $("#subtotal").html(`${$totalprice}Kyats`);
            $("#finalprice").html(`${$totalprice+3000}Kyats`);
    })


</script>
@endsection
