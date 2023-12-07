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
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu" style="background-color: orange; color: white; padding:20px;">
								<td class="id">ID</td>
								<td class="image">IMAGE</td>
								<td class="name">NAME</td>
								<td class="price">PRICE</td>
								<td class="">SALE</td>
								<td class="">ACTION</td>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $value)
							<tr>
								<td class="cart_id">
									<p>{{$value->id}}</p>
								</td>
								<td class="cart_product">
									<a ><img style="width: 200px" src="{{url('frontend/images/products/'.$value->id_user.'/'.json_decode($value->image)[0])}}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a >{{$value->name}}</a></h4>
								</td>
								<td class="cart_price">
									<p style="font-weight: 700">${{$value->price}}</p>
								</td>
								<td class="cart-sale">
									<p style="font-weight: 700">{{$value->sale}}%</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_eit" href="{{route('editproduct',['id'=> $value->id])}}" style="color:black;">Edit</a>
									<a class="cart_quantity_delete" href="{{route('deleteproduct',['id'=> $value->id])}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<a href="{{route('addproduct')}}" class="btn btn-default" style="background-color: orange; color: white; border: none; float: right;">ADD NEW</a>
				</div>
			</div>
		</div>
	</section>

			


@endsection