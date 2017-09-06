
@foreach($features as $feature)


 <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<a href="{{url("product/$feature->id/details")}}"><img src="{{asset("images/home/$feature->img")}}" alt="" /></a>
											<h2>R$ {{  $feature->price}}</h2>
											<p>{{$feature->name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">

											<div  class="overlay-content">
											<h2><a href='{{url("product/$feature->id/details")}}'>Detalhes</a></h2>
												<h2>R$ {{ number_format($feature->price, 2, ',', '')}}</h2>
												<p>{{$feature->name}}</p>
												<a href="{{url("add-to-cart/$feature->id")}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adcionar ao carrinho</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>



@endforeach