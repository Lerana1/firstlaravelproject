@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
                        <div class="col-lg-10 offset-1">

                            <div class="card">

                                <div class="card-body">
                                    <div class="">
                                        <div class="">
                                            <div class="col-3 ">
                                                <a href="{{route('list#page')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                                            </div>
                                        </div>
                                        {{-- <a href="{{route('list#page')}}" class="text-descoration-none "> --}}
                                          {{-- <i class="fa-solid fa-circle-arrow-left text-dark" onclick="history.back()"></i> --}}
                                        {{-- </a> --}}
                                      </div>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Update Page</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('updatepizza')}}"method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            {{-- //image error --}}
                                            <div class="col-4">
                                                    <input type="hidden" name="id" value="{{$pizza->id}}">
                                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm "/>

                                                    <div class="mt-4">
                                                        <input type="file" name="image" class="form-control" id="">
                                                    </div>
                                                    <div class="mt-4">
                                                        <button class="btn bg-dark text-white col-12"><i class="fa-solid fa-arrow-right"></i> Update</button>
                                                    </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="pizzaName" type="text" value="{{$pizza->name}}" class="form-control @error('pizzaName') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter name...">
                                                </div>
                                                @error('pizzaName')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">price</label>
                                                    <input id="cc-pament" name="price" type="text" value="{{$pizza->price}}" class="form-control @error('price') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                                </div>
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">description</label>
                                                    <input id="cc-pament" name="description" type="text" value="{{$pizza->description}}" class="form-control @error('description') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                                </div>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Cagtegory</label>
                                                    <select name="category" class="form-control @error('category') is-invalid @enderror" id="">
                                                        <option value="">choose category</option>
                                                        @foreach ($category as $e )
                                                            <option value="{{$e->id}}" @if ($pizza->category_id == $e->id) selected @endif>{{$e->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('category')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">view_count</label>
                                                    <input id="cc-pament" name="view_count" type="text" value="{{$pizza->view_count}}" class="form-control @error('view_count') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter phone..." disabled>
                                                </div>
                                                @error('view_count')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror


                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

