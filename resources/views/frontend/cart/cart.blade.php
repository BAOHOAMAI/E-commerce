@extends('frontend.layout.main')


@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if (session('cart'))
							@foreach (session('cart') as $id => $value)
						<tr id="{{$id}}">
							<td class="cart_product">
								<a href=""><img style="width: 300px; height: 100%" src="{{url('frontend/images/products/'.$value['id_user'].'/'.$value['image'])}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value['name']}}</a></h4>
							</td>
							<td class="cart_price">
								<p>${{$value['price']}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="#"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$value['quantity']}}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="#"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">

								 @php $total = 0 ;
								 	$total +=  $value['quantity'] *  $value['price'];
								 @endphp
		                        ${{$total}}
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
							@endforeach 
						@endif	
					</tbody>
					<tfoot style="background-color: #fe980f; padding-top: 20px;">
							<td class="image" style="color: white; font-weight: 700; font-size: 20px;">Cart Total</td>
							<td></td>
							<td></td>
							<td></td>
							<td class="result" style="color:white; font-weight: 700; font-size: 20px;"></td>
							<td></td>
					</tfoot>
				</table>
			</div>
			<button type="button" class="btn btn-default get" style="float: right; padding:  15px 20px; border-radius: 18px; "><a href="{{route('checkout')}}" style="text-decoration: none; color: white;">Order</a></button>

		</div>
	</section> <!--/#cart_items-->
	<script type="text/javascript">
		$(document).ready(function() {

			$('.cart_quantity_up').each(function () {
				$(this).click(function(e) {
					e.preventDefault();
					let total = $(this).closest('tr').find('.cart_total_price');

					let id = $(this).closest('tr').attr('id');

					let quantiVal = $(this).parent().find('.cart_quantity_input');

					let updateQuantity = quantiVal.val(Number(quantiVal.val()) + 1);

					let quantity = updateQuantity;
					$.ajax({
				 	  headers: {
			          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			          },
		               method:'POST',
		               url:'{{route('updateCart')}}',
		               data: {
		               	idUp : id,
		               	quantity : Number(quantity.val()),
		               },
		               success:function(data) {
		                  total.text("$"+data);
		                  $('.result').text("$" + getTotal());
		                }
		            });
				})
			})

			$('.cart_quantity_delete').each(function () {
				$(this).click(function(e) {
					e.preventDefault();

					let total = $(this).closest('tr').find('.cart_total_price');
					let parent = $(this).closest('tr');
					let id = $(this).closest('tr').attr('id');

					$.ajax({
				 	  headers: {
			         	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			          },
		               method:'POST',
		               url:'{{route('removeCart')}}',
		               data: {
		               	id : id,
		               },
		               success:function(data) {
		                  $('.result').text( "$" + getTotal());
		                 	parent.remove();
		                }
		            });
				})
			})


			$('.cart_quantity_down').each(function () {
				$(this).click(function(e) {
					e.preventDefault();

					let total = $(this).closest('tr').find('.cart_total_price');

					let id = $(this).closest('tr').attr('id');

					let quantiVal = $(this).parent().find('.cart_quantity_input');

					let updateQuantity = quantiVal.val(Number(quantiVal.val()) - 1);

					let quantity = updateQuantity;

					$.ajax({
				 	  headers: {
			         	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			          },
		               method:'POST',
		               url:'{{route('updateCart')}}',
		               data: {
		               	idDown : id,
		               	quantity : Number(quantity.val()),
		               },
		               success:function(data) {
		               	console.log(getTotal());
		                  total.text("$"+data);
		                  $('.result').text( "$" + getTotal());

		                }
		            });
				})
			})

			function getTotal () {
				let result = 0;
				$('.cart_total_price').each(function (index , value) {

					let totalVal = $(value).text().trim();
					let newTotal = totalVal.split("$").join('');

					result += Number(newTotal);
				})
				return result;	
			} 
		     $('.result').text( "$" + getTotal());
		})
	</script>

@endsection