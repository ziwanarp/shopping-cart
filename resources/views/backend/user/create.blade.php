@extends('backend.template.main')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Register Users </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="col-lg-6">
                <form action="/admin/user/" method="post">
                    @csrf

                    <div class="mb-3">
                      <label for="name" class="form-label">Fullname</label>
                      <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" autofocus required >
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required >
                            <option value="">===Pilih Role===</option>
                            <option value="user">User</option>
                            <option value="user">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                      @error('email')
                        <div class="invalid-feedback">
                                {{ $message }}
                        </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" onkeyup='check()' id="password" name="password" required>
                      @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                     @enderror
                    </div>

                    <div class="mb-3">
                      <label for="confirm_password" class="form-label">Confrim Password</label>
                      <input type="password" class="form-control " id="confirm_password" onkeyup='check()' name="confirm_password" >
                      <span class="mx-0" id='message'></span>
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