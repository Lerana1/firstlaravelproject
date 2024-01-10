@extends('user.layouts.master')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Contant Message</h3>
                                    </div>
                                    <hr>

                                    <form action="{{route('contact#page')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1" for="">Name</label>
                                            <input id="cc-pament" name="username" type="text" class="form-control" placeholder="Enter Name">

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1 ">Email</label>
                                            <input id="cc-pament" name="useremail" type="text" class="form-control" placeholder="Enter email">

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1 ">Subject</label>
                                            <textarea name="subject" id="" cols="30" rows="10"></textarea>

                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Send Message</span>
                                                <i class="fa-solid fa-key"></i>
                                            </button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection
