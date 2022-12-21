@extends('backend.template.main')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Coupon</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Coupon</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-lg-6">
                <form action="/admin/coupon" method="post" >
                    @csrf

                    <div class="mb-3">
                      <label for="coupon_code" class="form-label">Coupon Code</label>
                      <input type="text" class="form-control  @error('coupon_code') is-invalid @enderror" id="coupon_code" name="coupon_code" autofocus required value="{{ old('coupon_code') }}">
                    @error('coupon_code')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="discount_percent" class="form-label">Discount %</label>
                      <input type="number" class="form-control  @error('discount_percent') is-invalid @enderror" id="discount_percent" name="discount_percent"  required value="{{ old('discount_percent') }}">
                    @error('discount_percent')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="discount_price" class="form-label">Discount Price</label>
                      <input type="number" class="form-control  @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price"  required value="{{ old('discount_price') }}">
                    @error('discount_price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

    
@endsection