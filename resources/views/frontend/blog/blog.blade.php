@extends('frontend.layout.main')


@section('content')

	@include('frontend.layout.leftmenu')

	<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($blogData as $value)
							<div class="single-blog-post">
								<h3>{{$value->title}}</h3>
								<div class="post-meta">
									<ul>
										<li><i class="fa fa-user"></i> Mac Doe</li>
										<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									</ul>
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</div>
								<a href="{{route('blogsingle',['id'=>$value->id])}}">
									<img src="{{url('admin/images/blog/'.$value->image)}}" alt="">
								</a>
								<p>{{$value->description}}</p>
								<a  class="btn btn-primary" href="">Read More</a>
							</div>
						@endforeach
						<div class="pagination-area">
        						{{$blogData->links('pagination::bootstrap-4')}}
						</div>
					</div>
				</div>


@endsection