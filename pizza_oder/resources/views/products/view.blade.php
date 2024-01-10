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
                                    <div class="">
                                      {{-- <a href="{{route('list#page')}}" class="text-descoration-none "> --}}
                                        <i class="fa-solid fa-circle-arrow-left text-dark" onclick="history.back()"></i>
                                      {{-- </a> --}}
                                    </div>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">View Product Page</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3 offset-2">
                                                <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm"/>
                                        </div>
                                        <div class="col-7">
                                                <h3 class="my-3 text-danger"> {{$pizza->name}}</h3>
                                                <div class="btn bg-dark text-white my-3"><i class="fa-solid fa-money-check-dollar"></i>{{$pizza->price}}</div>
                                                <div class="btn bg-dark text-white my-3"><i class="fa-solid fa-eye"></i> {{$pizza->view_count}}</div>
                                                <div class="btn bg-dark text-white my-3"><i class="fa-solid fa-dice"></i> {{$pizza->category_name}}</div>
                                                <div class="btn bg-dark text-white my-3"><i class="fa-solid fa-calendar me-2"></i> {{$pizza->created_at->format('j.F.Y')}}</div>
                                           <div class="my-2"><i class="fa-solid fa-audio-description"></i> {{$pizza->description}}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

