@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2">
                        @if (session('createSuccess'))
                            <div class="col-4 offset-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{session('createSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <a href="{{route('list#page')}}" class="mb-3"><i class="fa-solid fa-backward"></i> back</a>

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Messagee</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($contect as $c )
                                <tr class="tr-shadow text-center">
                                    <td class="col-1">{{$c->id}}</td>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->email}}</td>
                                    <td>{{$c->message}}</td>
                                    <td>{{$c->created_at->format('F-j-Y')}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

