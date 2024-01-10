@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="row">
            <div class="col-6 offset-4 mb-3">
                @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{session('updateSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
               @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account information</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            @if (Auth::user()->image == null)
                                                <img src="{{asset('image/user image.jpg')}}" class="img-thumbnail shadow-sm"/>

                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}"/>

                                            @endif
                                        </div>
                                        <div class="col-8 bg-secondary">
                                           <h4 class="my-2"><i class="fa-solid fa-user-pen me-2"></i> {{Auth::user()->name}}</h4>
                                           <h4 class="my-2"><i class="fa-solid fa-envelope me-2"></i> {{Auth::user()->email}}</h4>
                                           <h4 class="my-2"><i class="fa-solid fa-square-phone me-2"></i> {{Auth::user()->phone}}</h4>
                                           <h4 class="my-2"><i class="fa-solid fa-person-half-dress"></i> {{Auth::user()->gender}}</h4>
                                           <h4 class="my-2"><i class="fa-solid fa-address-book me-2"></i> {{Auth::user()->address}}</h4>
                                           <h4 class="my-2"><i class="fa-solid fa-calendar me-2"></i> {{Auth::user()->created_at->format('j.F.Y')}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 mt-3">
                                       <a href="{{route('edit#page')}}">
                                            <button class="btn bg-dark text-white">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Edit profile
                                            </button>
                                       </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

