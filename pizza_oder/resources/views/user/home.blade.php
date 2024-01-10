@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark p-1 text-white">
                            <label class="" for="price-all">Category</label>
                            <span class="badge border font-weight-normal mb-2">{{count($category)}}</span>
                        </div>

                        <div class=" d-flex align-items-center justify-content-between mb-3">
                           <a href="{{route('homepage')}}" class="text-dark"> <label class="" for="price-1">All</label> </a>
                        </div>

                        @foreach ($category as $c )
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                               <a href="{{route('filter',$c->id)}}" class="text-dark"> <label class="" for="price-1">{{$c->category_name}}</label> </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{route('cartpage')}}">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($cart)}}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{route('history')}}" class="ms-5">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{count($history)}}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{route('contact#page')}}" class="ms-5">
                                    <button type="button" class="btn btn-dark text-white position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Contact Message
                                    </button>
                                </a>
                            </div>

                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingoption" class="form-control">
                                        <option value="">choose option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                       <div class="row" id="datalist">
                           @if(count($pizza)!= 0)
                            @foreach ($pizza as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myform">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="" style="height: 300px">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{route('pizza#detail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{$p->price}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           @else
                           <h5 class="col-5 offset-4 bg-secondary mt-3 text-center p-2"><i class="fa-solid fa-pizza-slice"></i> there is no pizza</h5>
                           @endif
                       </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptsource')
    <script>
        $(document).ready(function() {
            $('#sortingoption').change(function(){
                $eventoption = $('#sortingoption').val();
                if($eventoption == 'desc'){
                    $.ajax({
                        type : 'get',
                        url : 'http://localhost:8000/user/ajax/pizzalist',
                        data : {'status':'desc'},
                        datatype : 'json',
                        success : function(response){
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                               $list+= `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myform">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price}</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>`;
                            }
                            $('#datalist').html($list);
                        }
                        //${response[$i].image}
                    })
                }else if($eventoption == 'asc'){
                    $.ajax({
                        type : 'get',
                        url : 'http://localhost:8000/user/ajax/pizzalist',
                        data : {'status':'asc'},
                        datatype : 'json',
                        success : function(response){
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                               $list+= `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myform">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price}</h5>
                                        </div>
                                    </div>
                                    </div>
                                </div>`;
                            }
                            $('#datalist').html($list);
                        }
                    })
                }
            })
        })
    </script>
@endsection


