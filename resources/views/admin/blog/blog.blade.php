@extends('admin.layouts.index');

@section ('content')
	<div class="page-wrapper" style="margin-left: 0px">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-lg-1" scope="col">#</th>
                        <th class="col-lg-3" scope="col">Title</th>
                        <th class="col-lg-2" scope="col">Image</th>
                        <th class="col-lg-5" scope="col">Description</th>
                        <th class="col-lg-1" scope="col">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogData as $value) 
                    <tr>
                        <th scope="row">{{$value->id}}</th>
                        <td>{{$value->title}}</td>                
                        <td><img src="{{url('admin/images/blog/'.$value->image)}}" height="80" width="80"></td>
                        <td>{{$value->description}}</td>     
                        <td style="margin-right: 20px;">
                            <a href="{{route('deleteBlog',['id'=> $value->id])}}"><i class="m-r-10 mdi mdi-delete">delete</i></a>
                            <a href="{{route('editBlog',['id'=> $value->id])}}"><i class="m-r-10 mdi mdi-account-edit">Edit</i></a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table> <br>
            <a href="{{route('addBlog')}}"><button  class="btn btn-success"  style="margin-left: 20px;  margin-bottom: 20px;">ADD</button></a>                           
        </div>
        <div class="pagination" style="display: flex; justify-content:center;">
                {{$blogData->links('pagination::bootstrap-4')}}
        </div>
</div>

@endsection