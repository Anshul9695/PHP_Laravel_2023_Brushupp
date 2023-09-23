@extends('layout.app')
@section('title','Forget Password')

@section('content')
<section class="vh-10 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
           
            <form id="forget_frm">
              @csrf
              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Forget Password</h2>
                <div id="show_error_msg"></div>
                <p class="text-white-50 mb-5">Please enter your Email Here..</p>

                <div class="form-outline form-white mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter Your Email" />
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <input type="submit" class="btn btn-outline-light btn-lg px-5" name="submit" id="forget_btn" value="Forget Password">
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
    $("#forget_frm").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url:'{{route("forget")}}',
        method: 'post',
        data: $(this).serialize(),
        dataType:'json',
        success: function(responce) {
         if(responce.status==400){
          $("#show_error_msg").html(showMessage('danger',responce.message));
         }else if(responce.status==401){
          $("#show_error_msg").html(showMessage('danger',responce.message));
         }else{
          $("#show_error_msg").html(showMessage('success',responce.message));
          $("#forget_btn").val("Sending Email..");
         }
        }
      });
    });
  });
</script>
@endsection