@extends('backend.template.main')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tabel Coupon </h1>

    <div class="my-3">
        <a href="/admin/coupon/create" class="btn btn-success btn-icon-split" >
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Tambah Coupon</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Coupon</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Coupon Code</th>
                            <th>Discount %</th>
                            <th>Discount Price</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    @foreach ($coupons as $coupon)
        
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $coupon->coupon_code }}</td>
                            <td>{{ $coupon->discount_percent }}%</td>
                            <td>{{ $coupon->discount_price }}</td>
                            <td>
                                <a href="/admin/coupon/{{ $coupon->id }}/edit" class="btn btn-warning btn-circle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/admin/coupon/{{ $coupon->id }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Hapus coupon  ?')"><i class="fas fa-trash-alt"></i>
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