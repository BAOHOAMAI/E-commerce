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
									<h4 class="panel-title"><a href="{{route('account')}}">account</a></h4>
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
						<h2 class="title text-center">Edit Product !</h2>
						 <div class="signup-form">
						<h2>Edit Product !</h2>
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li style="text-align: center"> * {{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						<form method="post" enctype="multipart/form-data">
							@csrf
							@foreach($data as $value)
								<input type="text" placeholder="Name"  value="{{$value->name}}" name="name" />
								<input type="text" placeholder="Price" value="{{$value->price}}" name="price" />
								<select  name="category" />
									<option value="{{$value->id_category}}" selected   >{{$value->id_category}}</option>
									<option value="Sportswear" >SportWear</option>
									<option value="Mens">Mens</option>
									<option value="Womens">Womens</option>
									<option value="Kids">Kids</option>
									<option value="Fashion">Fashion</option>
									<option value="Households">Households</option>
									<option value="Interiors">Interiors</option>
									<option value="Clothing">Clothing</option>
									<option value="Bags">Bags</option>
									<option value="Shoes">Shoes</option>
								</select>
								<select  name="brand" />
									<option value="{{$value->id_brand}}" selected  >{{$value->id_brand}}</option>
									<option value="Nike" >Nike</option>
									<option value="Puma">Puma</option>
									<option value="Adidas">Adidas</option>
									<option value="Under Armour">Under Armour</option>
									<option value="Asics">Asics</option>
									<option value="Fendi">Fendi</option>
									<option value="Valentino">Valentino</option>
									<option value="Dior">Dior</option>
									<option value="Prada">Prada</option>
									<option value="Gucci">Gucci</option>
								</select>
								<select class="salee" name="sale" />
									<option value="0">New</option>
									<option value="1">Sale</option>
								</select>
								<div class="saling" style="display: flex; ">
									<input type="text" style="width: 50%;"placeholder="0" name="saleproduct" />
									<span style="font-size: 23px; font-weight:700 ; margin-left: 10px; margin-top: 5px;">%</span>
								</div>
								<input type="text" placeholder="Company Profile" value="{{$value->company}}"  name="company" />
									<div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
										@foreach(json_decode($value->image) as $values)
											<img style= "width: 150px"src="{{url('frontend/images/products/'.$value->id_user.'/'.$values)}}">
											<input style= "width: 100px" type="checkbox" name="checkbox[]"  value="{{$values}}">
										@endforeach 
									</div>
								<input type="file" name="image[]" multiple/>
								<button type="submit" class="btn btn-default">Update</button>
							@endforeach
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
	$(document).ready(function(){
		$('.saling').hide();
		$('.salee').change(function(){
          if($('.salee').val() == 1){
             $('.saling').show();
          }else{
             $('.saling').hide();
          }          
        }) 
	})

</script>
@endsection