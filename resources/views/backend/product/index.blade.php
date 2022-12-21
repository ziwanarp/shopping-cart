@extends('backend.template.main')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Products </h1>

    <div class="my-3">
        <a href="/admin/product/create" class="btn btn-success btn-icon-split" >
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Tambah Product</span>
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mx-0" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Product</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Code</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Img</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    @foreach ($products as $product)
        
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>Rp.{{ number_format($product->price, 0, ".", ".") }}</td>
                            <td><img width="70px" src="{{ asset('storage/'.$product->image) }}" alt="image"></td>
                            <td>
                                <a href="/admin/product/{{ $product->id }}/edit" class="btn btn-warning btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/admin/product/{{ $product->id }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Hapus product {{ $product->product_name }} ?')"><i class="fas fa-trash-alt"></i>
                                </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
    
@endsection