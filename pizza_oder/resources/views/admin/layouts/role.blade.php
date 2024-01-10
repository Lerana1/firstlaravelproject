
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
                                <h2 class="title-1">Users List</h2>

                            </div>
                        </div>
                    </div>
                   </div>
                   <a href="{{route('list#page')}}" class="mb-3"><i class="fa-solid fa-backward"></i> back</a>
                    <div class="table-responsive table-responsive-data2">
                        <h3>total-{{$users->total()}}</h3>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>gender</th>
                                    <th>Address</th>
                                    <th>phone</th>
                                    <th>role</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user )
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        @if ($user->image == null)
                                            @if ($user->gender == 'male')
                                            <img src="{{asset('image/user image.jpg')}}" class="img-thumbnail shadow-sm"/>
                                            @else
                                            <img src="https://thumbs.dreamstime.com/b/profile-picture-perfect-social-media-other-web-use-profile-picture-125320755.jpg" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                        <img src="{{asset('storage/'.$user->image)}}" class="img-thumbnail shadow-sm">
                                        @endif
                                    </td>
                                    <input type="hidden" name="" id="userid" value="{{$user->id}}">
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        <select class="form-control statusrole">
                                            <option value="user" @if($user->role=='user') selected @endif>user</option>
                                            <option value="admin" @if($user->role== 'admin') selected @endif>admin</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{$users->links()}}
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
            $('.statusrole').change(function () {
                $currentrole = $(this).val();
                $nodes = $(this).parents("tr");
                $userId = $nodes.find('#userid').val();
                $data = {
                        'userid': $userId , 'role' :$currentrole
                    };
                $.ajax({
                        type : 'get',
                        url : 'http://localhost:8000/user/change/role',
                        data :  $data,
                        datatype : 'json',
                })
                location.reload();
            })
        })

    </script>
@endsection

