@extends('frontend.template.main')
@section('content')

@if ($carts->count() > 0)
<div class="untree_co-section before-footer-section">
  <div class="container">

      <div class="text-center mb-4">
          <h1>My Carts</h1>
      </div>
      @if(session()->has('error'))
        <div class="content-center text-center alert alert-danger alert-dismissible fade show " role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session()->has('coupon'))
        <div class="content-center text-center alert alert-danger alert-dismissible fade show " role="alert">
          {{ session('coupon') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

    <div class="row mb-5">
        <div class="site-blocks-table">
          <table class="table">
            <thead>
              <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product Name</th>
                <th class="product-code">Product Code</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Remove</th>
              </tr>
            </thead>

            @foreach ($carts as $cart)

            <tbody>
              <tr>
                <td class="product-thumbnail">
                  <img src="{{ asset('storage/'.$cart->product->image) }}" alt="Image" class="img-fluid">
                </td>
                <td class="product-name">
                  <h2 class="h5 text-black">{{ $cart->product->product_name }}</h2>
                  <td>{{ $cart->product->product_code }}</td>
                </td>
                <td>Rp.{{ number_format($cart->product->price, 0, ".", ".") }}</td>
                <td>
                  <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                    <div class="input-group-prepend">
                      @if ($cart->qty <= 1)
                      <a data-bs-toggle="modal" data-bs-target="#modalDecrease" href="" class="btn btn-outline-black " type="submit">&minus;</a>
                      @else
                      <a href="/cart/decrease?id={{ $cart->id }}" class="btn btn-outline-black decrease" type="submit">&minus;</a>
                      @endif
                    </div>
                    <input type="number" min="1" class="form-control text-center quantity-amount" value="{{ $cart->qty }}" readonly placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                    <div class="input-group-append">
                      <a href="/cart/increase?id={{ $cart->id }}" class="btn btn-outline-black increase" type="submit">&plus;</a >
                    </div>
                  </div>

                </td>
                <td>Rp.{{ number_format($cart->total_price, 0, ".", ".") }}</td>
                <td>
                  <form action="/cart/delete/{{ $cart->id }}" method="post">
                    @method('delete')
                    @csrf
                  <button type="submit" class="btn btn-black btn-sm">X</button>
                </form>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row">

          @if($cart->coupon != null)
            <form action="/coupon/removecoupon" method="get">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon_code">Coupon</label>
                
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon_code" name="coupon_code" value="{{ $cart->coupon->coupon_code }}" placeholder="Coupon Code" disabled>
                <p class="text-success">Coupon {{ $cart->coupon->coupon_code }} berhasil dipakai. </p>
                @if ($cart->coupon->discount_price <= 0)
                <p class="text-success">Discount : {{ $cart->coupon->discount_percent }}% </p>
                @else
                <p class="text-success">Discount : Rp. {{ number_format($cart->coupon->discount_price, 0, ".", ".") }}</p>
                @endif
                
                <button type="submit" class="btn btn-black mt-3">Remove Coupon</button>
              </div>
            </form>

          @else
            <form action="/coupon/addcoupon" method="get">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon_code">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon_code" name="coupon_code" placeholder="Coupon Code" required>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-black mt-3">Apply Coupon</button>
              </div>
            </form>
          @endif

        </div>
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            @foreach ($carts->groupBy('id') as $cart)
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black"><b>{{ $cart[0]->qty }}x</b> {{ $cart[0]->product->product_code }}</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">Rp.{{ number_format(collect($cart)->sum('total_price'), 0, ".", ".") }}</strong>
                </div>
              </div>
            @endforeach
            <div class="row mb-3">
              <div class="col-md-6">
                <span class="text-black">Discount</span>
              </div>
              <div class="col-md-6 text-right">
                @if($cart[0]->coupon != null)
                  @if ($cart[0]->coupon->discount_price <= 0)
                    <strong class="text-black">{{ $cart[0]->coupon->discount_percent }}% <small>( Rp.{{ number_format($cart[0]->discount, 0, ".", ".") }})</small></strong> 
                  @else
                    <strong class="text-black">Rp. {{ number_format($cart[0]->coupon->discount_price, 0, ".", ".") }}</strong> 
                  @endif
                @else
                <strong class="text-black">0</strong> 
                @endif
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                @if ($cart[0]->coupon != null)
                <strong class="text-black">Rp.{{ number_format($cart[0]->final_price, 0, ".", ".") }}</strong>
                @else
                <strong class="text-black">Rp.{{ number_format(collect($carts)->sum('total_price'), 0, ".", ".") }}</strong>
                @endif
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='#'">Proceed To Checkout</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @else

  <div class="untree_co-section before-footer-section">
    <div class="container">
      <h1 class="text-center mb-5">Tidak ada product</h1>
    
            <div class="text-center">
              <a href="/shop" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
            </div>
      
      </div>
    </div>
  </div>
@endif


  <!-- Modal -->
<div class="modal fade" id="modalDecrease" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart Alert</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h6 class="text-center text-danger">Quantity tidak boleh kurang dari 1 !</h6> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
@endsection