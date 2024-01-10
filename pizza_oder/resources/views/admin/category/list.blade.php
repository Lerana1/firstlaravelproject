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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('createpage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                   @if (session('createSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('createSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                   @endif

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
                        <form action="{{route('listpage')}}" method="get">
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
                        <h3><i class="fa-solid fa-coins me-2"></i> {{$categorie->total()}}</h3>
                    </div>
                   </div>

                    @if (count($categorie) !=0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>CAtegory Name</th>
                                    <th>Create Date</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorie as $Category )
                                <tr class="tr-shadow">
                                    <td>{{$Category->id}}</td>
                                    <td class="col-6">{{$Category->category_name}}</td>
                                    <td>{{$Category->created_at->format('j-F-Y')}}</td>
                                    <td>
                                    <div class="table-data-feature">

                                        <a href="{{route('editpage',$Category->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>

                                        <a href="{{route('deletepage',$Category->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                             <i class="zmdi zmdi-delete"></i>
                                         </button>
                                        </a>

                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>

                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{$categorie->links()}}
                        </div>
                    @else
                    <h3 class="text-center">there is no data</h3>
                    @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
