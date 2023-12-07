@extends('frontend.layout.main')


@section('content')

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">account</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{route('myproduct')}}">My product</a></h4>
								</div>
							</div>
							
						</div><!--/category-products-->

					</div>
				</div>

				<div class="col-sm-9">
					<div class="blog-post-area">
					        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{session('success')}}
                        </div>
                             @endif
						<h2 class="title text-center">Update user</h2>
						 <div class="signup-form">
						<h2>UPDATE USER !</h2>
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						<form method="post" enctype="multipart/form-data">
							@csrf
							<input type="text" value="{{Auth::user() -> name}}"  name="name" />
							<input type="email" placeholder="{{Auth::user() -> email}}" disabled name="email" />
							<input type="password" placeholder="**********" name="password" />
							<input type="text" value="{{Auth::user() -> phone}}"  name="phone" />
							<input type="file" name="avatar" />

							<button type="submit" class="btn btn-default">UPDATE</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	


@endsection