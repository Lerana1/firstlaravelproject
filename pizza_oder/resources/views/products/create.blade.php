@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('listpage')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Create Pizza</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('create')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                           <select name="category" class="form-control @error('category') is-invalid @enderror" id="">
                                                @foreach ($categories as $c )
                                                <option value="{{$c->id}}">{{$c->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <input id="cc-pament" name="description" type="text" value="{{old('description')}}" class="form-control @error('descripton') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="enter your description...">
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">image</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">price</label>
                                            <input id="cc-pament" name="price" type="number" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="enter price...">
                                            @error('categoryName')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

