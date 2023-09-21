@extends('layout.app')
@section('title','Register')

@section('content')
<!-- Section: Design Block -->
<div class="container">
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Sign up now</h2>
          <div id="show_error_msg"></div>
          <form id="register_form" method="post">
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="name" name="name" class="form-control" />
                  <label class="form-label" for="form3Example1">Full Name</label>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <input type="email" name="email" id="email" class="form-control" />
              <label class="form-label" for="form3Example3">Email address</label>
              <div class="invalid-feedback"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <input type="password" id="password" name="password" class="form-control" />
              <label class="form-label" for="form3Example4">Password</label>
              <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <input type="password" id="cnf_password" name="cnf_password" class="form-control" />
              <label class="form-label" for="form3Example4">Confirm Password</label>
              <div class="invalid-feedback"></div>
                </div>
              </div>
            </div>

            <!-- Submit button -->
            <!-- <button type="submit" id="btn_register" class="btn btn-primary btn-block mb-4">
              Sign up
            </button> -->
            <input type="submit" name="submit" value="Register" id="btn_register" class="btn btn-primary btn-block mb-4">
          </form>
          <div>
              <p class="mb-0">Already Have Account <a href="/" class="text-green-50 fw-bold">Sign In</a>
              </p>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<!-- Section: Design Block -->
@endsection

@section('script')
<script>
  $(document).ready(function(){
$("#register_form").submit(function(event){
  event.preventDefault();
  $("#btn_register").val("please wait...");
  $.ajax({
    url:"{{url('registerUser')}}",
    type:'post',
    data:$("#register_form").serializeArray(),
    dataType:'json',
    success:function(res){
   if(res.status==400){
    showError('name',res.message.name);
    showError('email',res.message.email);
    showError('password',res.message.password);
    showError('cnf_password',res.message.cnf_password);
    $("#btn_register").val("Register..");
   }else if(res.status==200){
$("#show_error_msg").html(showMessage('success',res.message));
$("#register_form")[0].reset();
removeValidationClasses("#register_form");
$("#btn_register").val("Register..");
   }
    }


  });
});
  });
</script>
@endsection