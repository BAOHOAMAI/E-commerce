@extends('frontend.layout.main')

@section ('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" value="{{Auth::user()->name}}" disabled>
								<input type="text" value="{{Auth::user()->email}}" disabled>
								<input type="text" value="{{Auth::user()->phone}}" disabled>
								<input type="text" value="{{Auth::user()->country}}" disabled>
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="{{route('mail')}}">Continue</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
						<tr>
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
									<span style="padding-left: 20px; font-size: 22px ; color: gray">x{{$value['quantity']}}</span>
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
						
						</tr>
							@endforeach 
						@endif	

						
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td class="result"></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span class="result"></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
	<script type="text/javascript">
		$(document).ready(function() {
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