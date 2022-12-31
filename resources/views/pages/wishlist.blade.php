@extends('layouts.app')

@section('content')

<section>
	<div class="container">
		<div class= "row product_data">
			<div class= "col-md-12">
				<div class= "wishlist-header border p-2">
					<div class= "row">
						<div class= "col-md-7">
							<h6 class="mb-0 font-weight-bol">Product Details</h6>
						</div>	
						<div class= "col-md-2">
							<h6 class="mb-0 font-weight-bol">Price</h6>
						</div>	
						<div class= "col-md-2">
							<h6 class="mb-0 font-weight-bol">Remove</h6>
						</div>	
					</div>	
				</div>
                <input type="hidden" >
				@foreach($wishlist as $item)
                <input type="hidden" value= "{{$item->product_id}}" class="prod_id">
				<div class="wishlist-content ">
					
					<div class = "card">
						<div class = "card-body">
							<div class = "row">
								<div class = "col-md-1 ">
									<img src = "{{$item->products->photo }}" class="w-100"  alt="Image">
								</div>
								<div class = "col-md-6">
									<h6>{{ $item->products->name ?? 'NULL'}}</h6>
								</div>	
								<div class = "col-md-2">
									<h6>{{ $item->products->price ?? 'NULL' }}</h6>
								</div>	
								<div class = "col-md-2">
									<input type="hidden" id ="wishlist_id" value="{{$item->product_id}}">
									<button type="button" class=" btn btn-danger wishlist-remove-btn" type="submit" name="send"> Remove </button>
								</div>	
							</div>
						</div>
					</div>
				</div>

				@endforeach
		
			</div>	
		</div>
	</div>
</section>

@endsection

