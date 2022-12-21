		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="/">Shopping-<span>Cart.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item {{ Request::is('/*') ? 'active' : '' }}"><a class="nav-link" href="/">Home</a></li>
						<li class="nav-item {{ Request::is('shop*') ? 'active' : '' }}"><a class="nav-link" href="/shop">Shop</a></li>
					</ul>
                        <div class="dropdown">
                            <a class="nav-link custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5 dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" href="#"><img src="{{ asset('frontend/images/user.svg') }}"></a>
                          
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								@auth
								<form action="/logout" method="post">
									@csrf
									  <button type="submit" class="dropdown-item" >Logout</button>
								  </form>
								@else
								<li><a class="dropdown-item" href="/login">Login</a></li>
								<li><a class="dropdown-item" href="/register">Register</a></li>
								@endauth
                            </ul>
                          </div>
						@auth
						<a class="nav-link custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5" href="/cart"><img src="{{ asset('frontend/images/cart.svg') }}"><span class="badge badge-light">{{ $carts->count() }}</span></a>
						@else
						<!-- Button trigger modal -->
						<a class="nav-link custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5 " data-bs-toggle="modal" data-bs-target="#exampleModal" href=""><img src="{{ asset('frontend/images/cart.svg') }}"><span class="badge badge-light">0</span></a>
						@endauth
				</div>
			</div>
		</nav>
		<!-- End Header/Navigation -->

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Pesan Autentikasi</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				   <h6 class="text-center text-danger">Login untuk melihat keranjang !!</h6> 
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  <a href="/login" type="button" class="btn btn-primary">Login</a>
				</div>
			  </div>
			</div>
		  </div>
  