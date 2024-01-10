@extends('admin.layouts.app')
@section('title','category list page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>
                    <a href="{{route('list#page')}}" class="mb-3"><i class="fa-solid fa-backward"></i> back</a>
                   @if (session('deleteSuccess'))
                    <div class="col-3 offset-9">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                   @endif

                   <div class="row">
                    <div class="col-3 mt-5">
                        <h5 class="text-secondary">search key: <span class="text-danger">{{request('search')}}</span></h5>
                    </div>
                    <div class="col-3 offset-6 my-5 ">
                        <form action="{{route('admin#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="search" class="form-control" placeholder="search...">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                   </div>

                   <div class="row my-3 ms-1">
                    <div class="col-3">
                        <h3><i class="fa-solid fa-coins me-2"></i>{{$admin->total()}}</h3>
                    </div>
                   </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>gender</th>
                                    <th>Address</th>
                                    <th>Role</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a )
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        @if ($a->image == null)
                                            @if ($a->gender == 'male')
                                            <img src="{{asset('image/user image.jpg')}}" class="img-thumbnail shadow-sm"/>
                                            @else
                                            <img src="https://thumbs.dreamstime.com/b/profile-picture-perfect-social-media-other-web-use-profile-picture-125320755.jpg" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                        <img src="{{asset('storage/'.$a->image)}}" class="img-thumbnail shadow-sm">
                                        @endif
                                    </td>
                                    <input type="hidden" name="" id="userid" value="{{$a->id}}">
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->email}}</td>
                                    <td>{{$a->gender}}</td>
                                    <td>{{$a->address}}</td>
                                    <td>
                                        <select class="form-control changerole">
                                            <option value="admin" @if($a->role=='admin') selected @endif>admin</option>
                                            <option value="user" @if($a->role== 'user') selected @endif>user</option>
                                        </select>
                                    </td>


                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{$admin->links()}}
                        </div>

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptsource')
    <script>
        $(document).ready(function() {
            $('.changerole').change(function () {

                $currentrole = $(this).val();
                $nodes = $(this).parents("tr");
                $userId = $nodes.find('#userid').val();
                $data = {
                        'userid': $userId , 'role' :$currentrole
                    };
                // $.ajax({
                //         type : 'get',
                //         url : 'http://localhost:8000/admin/change/list',
                //         data :  $data,
                //         datatype : 'json',
                // })
                // location.relod();
            })
        })

    </script>
@endsection
