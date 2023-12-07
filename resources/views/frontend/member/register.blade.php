@extends('frontend.layout.main')

@section ('content')

	<section id="form" ><!--form-->
		<div class="container" >
			<div class="row" style="display:flex; justify-content:center;">
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2 style="display:flex; justify-content:center; font-size: 30px; font-weight:700;">New User Signup!</h2>
						<form  method="post">
							@csrf
							<input type="text" placeholder="Name" name="name" />
							<input type="text" placeholder="Phone" name="phone"/>
							<input type="email" placeholder="Email Address" name="email" />
							<input type="password" placeholder="Password" name="password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>
	
@endsection