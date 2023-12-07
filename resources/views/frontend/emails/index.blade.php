<!DOCTYPE html>
<html>
<head>
	<title>Cam on ban da lua chon san pham</title>
</head>
<body>
	<h3>Xin chào {{$data['name']}}</h3>
	<h3>Email : {{$data['email']}}</h3>
	<h3>Phone Number : {{$data['phone']}}</h3>
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
</body>
</html>