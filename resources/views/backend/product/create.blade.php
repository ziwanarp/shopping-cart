@extends('backend.template.main')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Product</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Product</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-lg-6">
                <form action="/admin/product" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                      <label for="product_name" class="form-label">Product Name</label>
                      <input type="text" class="form-control  @error('product_name') is-invalid @enderror" id="product_name" name="product_name" autofocus required value="{{ old('product_name') }}">
                    @error('product_name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="product_code" class="form-label">Product Code</label>
                      <input type="text" class="form-control  @error('product_code') is-invalid @enderror" id="product_code" name="product_code"  required value="{{ old('product_code') }}">
                    @error('product_code')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="price" class="form-label">Price</label>
                      <input type="number" min="1" class="form-control  @error('price') is-invalid @enderror" id="price" name="price"  required value="{{ old('price') }}">
                    @error('price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="quantity" class="form-label">Qty</label>
                      <input type="number" min="1" class="form-control  @error('quantity') is-invalid @enderror" id="quantity" name="quantity"  required value="{{ old('quantity') }}">
                    @error('quantity')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="image" class="form-label">Image</label>
                      <img src="" class="img-preview img-fluid mb-2 col-sm-6 d-block">
                      <input type="file" class="form-control img-preview  @error('image') is-invalid @enderror" id="image" name="image" accept="image/png, image/jpeg, image/jpg" onchange="previewImage()" required>
                    @error('image')
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

<script>
    function previewImage(){
    const image =document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display ='block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent){
    imgPreview.src = oFREvent.target.result;

}
}
</script>

    
@endsection