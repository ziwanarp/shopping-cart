@extends('frontend.template.main')
@section('content')


<div class="untree_co-section product-section before-footer-section">

    

    <div class="text-center mb-5">
        <h1>Shopping Page</h1>
    </div>

<div class="container">
    @if(session()->has('error'))
        <div class="content-center text-center alert alert-danger alert-dismissible fade show " role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
      <div class="row">

    @foreach ($products as $product)
          <!-- Start Column 1 -->
        <div class="col-12 col-md-4 col-lg-3 mb-5">
          @auth
            @if ($product->quantity <= 0)
                <a data-bs-toggle="modal" data-bs-target="#modalProduct" class="product-item" href="">
                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid product-thumbnail" >
                    <h3 class="product-title">{{ $product->product_name }}</h3>
                    <small>Stock : {{ $product->quantity }}</small><br>
                    <small>Product Code : {{ $product->product_code }}</small><br>
                    <strong class="product-price">Rp. {{ number_format($product->price, 0, ".", ".") }}</strong>
            
                    <span class="icon-cross">
                        <img src="{{ asset('frontend/images/cross.svg') }}" class="">
                    </span>
                </a>
            @else
                <a class="product-item" href="/shop/addToCart?product_id={{ $product->id }}">
                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid product-thumbnail" >
                    <h3 class="product-title">{{ $product->product_name }}</h3>
                    <small>Stock : {{ $product->quantity }}</small><br>
                    <small>Product Code : {{ $product->product_code }}</small><br>
                    <strong class="product-price">Rp. {{ number_format($product->price, 0, ".", ".") }}</strong>
                    
                    <span class="icon-cross">
                        <img src="{{ asset('frontend/images/cross.svg') }}" class="">
                    </span>
                </a>
            @endif
          @else
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="product-item" href="">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid product-thumbnail" >
                <h3 class="product-title">{{ $product->product_name }}</h3>
                <small>Stock : {{ $product->quantity }}</small><br>
                <small>Product Code : {{ $product->product_code }}</small><br>
                <strong class="product-price">Rp. {{ number_format($product->price, 0, ".", ".") }}</strong>
                
                <span class="icon-cross">
                    <img src="{{ asset('frontend/images/cross.svg') }}" class="">
                </span>
            </a>
            @endauth
        </div> 
        <!-- End Column 1 -->
    @endforeach    

      </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Shopping Alert</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <h6 class="text-center text-danger">Stok Habis !</h6> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    
@endsection