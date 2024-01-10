@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account information</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('updatepage',Auth::user()->id)}}"method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            {{-- //image error --}}
                                            <div class="col-4">
                                                @if (Auth::user()->image == null)
                                                <img src="{{asset('image/user image.jpg')}}" class="img-thumbnail shadow-sm "/>
                                                @else
                                                    <img src="{{asset('storage/'.Auth::user()->image)}}"/>

                                                @endif
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
                                                    <input id="cc-pament" name="name" type="text" value="{{Auth::user()->name}}" class="form-control @error('name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter name...">
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">email</label>
                                                    <input id="cc-pament" name="email" type="text" value="{{Auth::user()->email}}" class="form-control @error('email') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">phone</label>
                                                    <input id="cc-pament" name="phone" type="text" value="{{Auth::user()->phone}}" class="form-control @error('phone') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                                </div>
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">gender</label>
                                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="">
                                                        <option value="">choose gender</option>
                                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>M</option>
                                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>F</option>
                                                    </select>
                                                </div>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">address</label>
                                                    <textarea name="address" id="cc-pament" cols="30" rows="10" class="form-control  @error('address') is-invalid @enderror "></textarea>
                                                </div>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <input id="cc-pament" name="role" type="text" value="{{Auth::user()->role}}" class="form-control " aria-required="true" aria-invalid="false" disabled>
                                                </div>

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

