@extends('frontend.template.main')
@section('content')

<!-- Start Contact Form -->
<div class="untree_co-section">
    <div class="container">

      <div class="block">
        <h1 class="text-center">Login</h1>
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-8 pb-4">

            @if(session()->has('error'))
              <div class="text-center alert alert-danger alert-dismissible fade show " role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if(session()->has('success'))
              <div class="text-center alert alert-success alert-dismissible fade show " role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <form action="/login" method="post">
              @csrf
              <div class="form-group mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus required>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
               @enderror
              </div>

              <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
               @enderror
              </div>

              <button type="submit" class="btn btn-primary-hover-outline">Login</button>
              <p class="mt-2">Belum punya akun ?<a href="/register"> Register Disini</a></p>
            </form>

          </div>

        </div>

      </div>

    </div>


  </div>
</div>

<!-- End Contact Form -->
    
@endsection