@extends('frontend.layout.main')

@section ('content')
					<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{$data->title}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
							</div>
							<a href="">
								<img src="{{url('admin/images/blog/'.$data->image)}}" alt="">
							</a>
							<p>
								{{$data->description}}
							</p> 
							<br>

							<div class="pager-area">
								<ul class="pager pull-right">
									@if(isset($prev))
										<li><a href="{{route('blogsingle',['id'=>$prev->id])}}">Prev</a></li>
									@endif

									@if(isset($next))
										<li><a href="{{route('blogsingle',['id'=>$next->id])}}">Next</a></li>
									@endif
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->


		            <div class="rate">
		            	<span style="padding-right: 20px;">RATE THIS BLOG : </span>
		                <div class="vote">
		                	@for ($i = 1; $i <= 5; $i++)
		                    	<div class="star_{{$i}} ratings_stars  "><input value="{{$i}}" type="hidden"></div>
		                    @endfor
		                    <span class="rate-np">{{$sao}}</span>
		                </div> 
		            </div>


					<div class="socials-share">
						<a href=""><img src="{{ asset('frontend/images/blog/socials.png')}}" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
						<h2>Comment : </h2>
						<ul class="media-list">
							@foreach($comment as $value)
								@if( $data->id === $value->id_blog && $value->level == 0)
									<li class="media">
										<a class="pull-left" href="#">
											<img class="media-object"  style="width: 200px" src=" {{url('admin/images/users/'.$value -> avatar)}}" alt="">
										</a>
										<div class="media-body">
											<ul class="sinlge-post-meta">
												<li><i class="fa fa-user"></i>{{$value->name}}</li>
											</ul>
											<p>{{$value->comment}}</p>
										</div>
										<button class="btn btn-primary replay"><i class="fa fa-reply"></i>Replay</button>
										<form class="child-comment" method="post" action="{{route('comment',['id'=>$data->id])}}">
											@csrf
											<input type="hidden" name="level" value="{{$value->id}}">
											<textarea name="comment" rows="11"></textarea>
											<button class="btn btn-primary comment" type="submit">Replay</button>
										</form>
									</li>
									@foreach ($comment as $values)
										@if($values->level == $value->id)
											<li class="media second-media">
												<a class="pull-left" href="#">
													<img class="media-object" style="width: 200px "src="{{url('admin/images/users/'.$values -> avatar)}}" alt="">
												</a>
												<div class="media-body">
													<ul class="sinlge-post-meta">
														<li><i class="fa fa-user"></i>{{$values->name}}</li>
													</ul>
													<p>{{$values->comment}}</p>
												</div>
											</li>
										@endif
									@endforeach
								@endif
							@endforeach

						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								
								<div class="text-area">
									<div class="blank-arrow">
									</div>
									<form method="post" action="{{route('comment',['id'=>$data->id])}}">
										@csrf
										<textarea name="comment" rows="11"></textarea>
										<button class="btn btn-primary comment" type="submit">Post comment</button>
									</form>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
			</div>
  <script>
    	$(document).ready(function(){

			$.ajaxSetup({
			  headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});

			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				var Values =  $(this).find("input").val();
				let check = "{{Auth::check()}}";
				if (check == true) {
					$.ajax({
		               method:"POST",
		               url:"{{route('rating',['id'=>$data->id])}}",
		               data:
		               		{
		               			blogRating:Values,
		               		}
		               ,
		               success:function(res) {
		                  alert(res);
		               }
		            });
				} else {
					alert("Vui lòng login để vote");
				}

		    	if ($(this).hasClass('ratings_over')) {
		            $('.ratings_stars').removeClass('ratings_over');
		            $(this).prevAll().andSelf().addClass('ratings_over');
		        } else {
		        	$(this).prevAll().andSelf().addClass('ratings_over');
		        }
		    });

		    $('.ratings_stars').each(function() {
		    	var input =  $(this).find("input");
		    	var rating = Number($('.rate-np').text())
		    	$(input).each(function() {
		    		if ($(input).val() == rating) {
						$(this).parent().prevAll().andSelf().addClass('ratings_hover');
		    		}
		    	})
		    })

		    $('.comment').click(function () {
		    	let flag = false ;
				let check = "{{Auth::check()}}";
				if (check == true) {
					flag = true;
				} else {
					alert("Vui lòng login để comment");
				}
				return flag;
		    })
		});

    	$('.child-comment').hide();

		$('.replay').each(function() {
			$(this).click(function() {
    			$(this).parent().find('.child-comment').show();
    		})
		})

   </script>

@endsection
