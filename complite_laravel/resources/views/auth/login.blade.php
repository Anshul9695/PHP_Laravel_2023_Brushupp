@extends('layout.app')
@section('title','login')

@section('content')
<section class="vh-10 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div id="show_error_msg"></div>
            <form method="POST" id="login_frm">
              @csrf
              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Please enter your login and password!</p>

                <div class="form-outline form-white mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter Your Email" />
                  <label class="form-label" for="typeEmailX">Email</label>
                  <div class="invalid-feedback"></div>
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter Your Password" />
                  <label class="form-label" for="typePasswordX">Password</label>
                  <div class="invalid-feedback"></div>
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/forget">Forgot password?</a></p>

                <input type="submit" name="submit" id="submit" value="Login" class="btn btn-primary">
              </div>
            </form>
            <div>
              <p class="mb-0">Don't have an account? <a href="/register" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $("#login_frm").submit(function(event) {
      event.preventDefault();
      $("#submit").val("Please Wait..");
      $.ajax({
        url: "{{url('loginPost')}}",
        type: "post",
        data: $("#login_frm").serializeArray(),
        dataType: 'json',
        success: function(res) {
          if (res.status == 400) {
            showError('email', res.message.email);
            showError('password', res.message.password);
            $("#submit").val("Login..");
          } else if (res.status == 401) {
            $("#show_error_msg").html(showMessage('danger', res.message));
            $("#submit").val("Login..");
          } else {
            if (res.status == 200 && res.message == 'success') {
              window.location = "{{route('profile')}}";
            }

          }
        }
      });
    });
  })
</script>

@endsection