@extends('layout.app')
@section('title','Reset Password')

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
          <h2 class="fw-bold mb-5">Reset Passsword</h2>
          <form id="reset_frm" method="post">
            @csrf
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <input type="email" name="email" id="form3Example3" class="form-control" />
              <label class="form-label" for="form3Example3">Email address</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <input type="password" id="password" name="password" class="form-control" />
              <label class="form-label" for="form3Example4">Password</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                <input type="password" id="cnf_password" name="cnf_password" class="form-control" />
              <label class="form-label" for="form3Example4">Confirm Password</label>
                </div>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">
             Reset Password
            </button>
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
@endsection