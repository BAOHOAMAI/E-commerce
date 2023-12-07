@extends('admin.layouts.index')
@section('content')
	<div class="page-wrapper" style="margin-left: 0px">
			<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                              @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                              @endif
                            <h4 class="card-title">EDIT BLOG</h4>
                            <form method="post" class="form-horizontal m-t-30" enctype="multipart/form-data">
                                @csrf
                            	@foreach ($blogData as $value)
                                <div class="form-group">
                                    <label>Title (*)</label>
                                    <input name="title" type="text" class="form-control"  value="{{$value->title}}">
                                    <label>Image  : </label> <br>
                                    <img src="{{url('admin/images/blog/'.$value->image)}}" height="120" width="120">
                                    <input name="image" type="file" class="form-control">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{$value->description}}</textarea>
                                    <label>Content</label>
                                    <textarea  name="content" id="editor1" class="form-control" rows="8">{{$value->content}}</textarea> <br>
                                    <button type="submit" class="btn btn-success">EDIT</button>
                                </div>  
                                @endforeach

                            </form>
                        </div>
                    </div>
                </div>
            </div>
	</div>
@endsection
