@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('adminpasswordpage')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldpassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="old password...">
                                            @error('oldpassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                            @if (session('notMatch'))
                                                <div class="invalid-feedback">
                                                    {{session('notMatch')}}
                                                </div>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">New password</label>
                                            <input id="cc-pament" name="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="new password...">
                                            @error('newpassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirmpassword" type="password"  class="form-control @error('confirmpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="confirm password...">
                                            @error('confirmpassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Change Password</span>
                                                <i class="fa-solid fa-key"></i>
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

