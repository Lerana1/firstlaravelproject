
@extends('user.layouts.master')
@section('content')

  <!-- Cart Start -->
  <div class="container-fluid">
      <div class="row px-xl-5">
          <div class="col-lg-8 table-responsive mb-5">
              <table class="table table-light table-borderless table-hover text-center mb-0 " id="data">
                  <thead class="thead-dark">
                      <tr>
                          <th>Date</th>
                          <th>Order_id</th>
                          <th>Total price</th>
                          <th>status</th>
                      </tr>
                  </thead>
                  <tbody class="align-middle">
                            @foreach ($order as $o )
                                <tr>
                                    <td class="align-middle" id="price">{{$o->created_at->format('j-F-Y')}}</td>
                                    <td class="align-middle" id="price">{{$o->order_code}}</td>
                                    <td class="align-middle" id="price">{{$o->total_price}}</td>
                                    <td class="align-middle" id="price">
                                        @if ($o->status == 0)
                                            <span class="text-success"><i class="fa-brands fa-stack-overflow"></i> Pending...</span>
                                        @elseif ($o->status == 1)
                                            <span class="text-waning"><i class="fa-solid fa-thumbs-up"></i> Success...</span>
                                        @elseif ($o->status == 2)
                                            <span class="text-danger"><i class="fa-solid fa-thumbs-down"></i> Reject...</span>
                                        @endif
                                </tr>
                            @endforeach
                      </tbody>
              </table>
              <span>
                {{$order->links()}}
              </span>
          </div>
      </div>
  </div>
  <!-- Cart End -->

@endsection
@section('scriptsource')

@endsection
