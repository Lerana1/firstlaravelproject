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
                                <h2 class="title-1">product list</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('create#page')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add products
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
                    <div class="col-3">
                        <h5 class="text-secondary">search key: <span class="text-danger">{{request('search')}}</span></h5>
                    </div>
                    <div class="col-3 offset-6  ">
                        <form action="{{route('list#page')}}" method="get">
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
                   </div>

                   <div class="row my-5 ms-1">
                    <div class="col-2 offset-9">
                        <h5><i class="fa-solid fa-coins me-2"></i>{{$pizza->total()}}</h5>
                    </div>
                   </div>
                    @if (count($pizza)!=0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Pizza Name</th>
                                    <th>price</th>
                                    <th>category</th>
                                    <th>View count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pizza as $p )
                                <tr class="tr-shadow">
                                    <td class="col-2"><img src="{{asset('storage/'.$p->image)}}" alt="" class="img-thumbnail shadow-sm"></td>
                                    <td class="col-2">{{$p->name}}</td>
                                    <td class="col-2">{{$p->price}}</td>
                                    <td class="col-2">{{$p->category_name}}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                    <td class="col-2">
                                    <div class="table-data-feature">

                                        <a href="{{route('view#page',$p->id)}}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>

                                        <a href="{{route('update#page',$p->id)}}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>

                                        <a href="{{route('delete#page',$p->id)}}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
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
                            {{$pizza->links()}}
                        </div>
                    </div>
                    @else
                    <h3 class="text-center">there is no pizza</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
