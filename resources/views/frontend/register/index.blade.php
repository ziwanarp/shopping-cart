@extends('frontend.template.main')
@section('content')

<!-- Start Contact Form -->
<div class="untree_co-section">
    <div class="container">

      <div class="block">
        <h1 class="text-center mb-3">Register</h1>

        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-8 pb-4">

            @if (session()->has('success'))
            <div class="text-center alert alert-success alert-dismissible fade show " role="alert">
                {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @elseif(session()->has('error'))
            <div class="text-center alert alert-danger alert-dismissible fade show " role="alert">
                {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

            <form action="/register" method="post">
              @csrf
              <div class="form-group mb-3">
                <label for="name" class="form-label ">Fullname</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus required>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                 @enderror
              </div>

              <div class="form-group mb-3">
                <label for="email" class="form-label ">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus required>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                 @enderror
              </div>

              <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" onkeyup='check()' name="password" required>
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                 @enderror
              </div>

              <div class="form-group mb-3">
                <label for="confirm_password" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" id="confirm_password" onkeyup='check()' name="confirm_password" required>
                <span class="mx-0" id='message'></span>
              </div>

              <button type="submit" id="submit" class="btn btn-primary-hover-outline">Register</button>
              <p class="mt-2">Sudah punya akun ?<a href="/login"> Login Disini</a></p>
            </form>

          </div>

        </div>

      </div>

    </div>


  </div>
</div>

<!-- End Contact Form -->

<script>
   var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = '✓ Password Confirmed';
    document.getElementById('submit').disabled = false;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password Not Confirmed';
    document.getElementById('submit').disabled = true;
  }
}
</script>
    
@endsection