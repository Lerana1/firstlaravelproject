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
                                        <h3 class="text-center title-2">Change Row </h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('change#row',$account->id)}}"method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            {{-- //image error --}}
                                            <div class="col-4">
                                                @if ($account->image == null)
                                                    @if ($account->gender == 'male')
                                                        <img src="{{asset('image/user image.jpg')}}" class="img-thumbnail shadow-sm"/>
                                                    @else
                                                        <img src="https://thumbs.dreamstime.com/b/profile-picture-perfect-social-media-other-web-use-profile-picture-125320755.jpg" class="img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{asset('storage/'.$account->image)}}"/>
                                                @endif
                                                    <div class="mt-4">
                                                        <input type="file" name="image" class="form-control" id="">
                                                    </div>
                                                    <div class="mt-4">
                                                        {{-- <a href="{{route('list#page')}}" class="text-descoration-none "> --}}
                                                          <button class="btn bg-dark text-white col-12"><i class="fa-solid fa-circle-arrow-left text-dark" onclick="history.back()"></i>change</button>
                                                        {{-- </a> --}}
                                                      </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" disabled name="name" type="text" value="{{$account->name}}" class="form-control @error('name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter name...">
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">email</label>
                                                    <input id="cc-pament" name="email" type="text" value="{{$account->email}}" class="form-control @error('email') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">phone</label>
                                                    <input id="cc-pament" disabled name="phone" type="text" value="{{$account->phone}}" class="form-control @error('phone') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                                </div>
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">gender</label>
                                                    <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror" id="">
                                                        <option value="">choose gender</option>
                                                        <option value="male" @if ($account->gender == 'male') selected @endif>M</option>
                                                        <option value="female" @if ($account->gender == 'female') selected @endif>F</option>
                                                    </select>
                                                </div>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">address</label>
                                                    <textarea name="address" disabled id="cc-pament" cols="30" rows="10" class="form-control  @error('address') is-invalid @enderror "></textarea>
                                                </div>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <select name="role" class="form-control" id="">
                                                        <option value="">choose role</option>
                                                        <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                                    </select>
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

