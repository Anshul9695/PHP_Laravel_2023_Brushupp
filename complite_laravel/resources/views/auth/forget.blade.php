@extends('layout.app')
@section('title','Forget Password')

@section('content')
<section class="vh-10 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
<form action="#" method="post" id="forget_frm">
    @csrf
            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Forget Password</h2>
              <p class="text-white-50 mb-5">Please enter your Email Here..</p>

              <div class="form-outline form-white mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter Your Email" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

            
              <button class="btn btn-outline-light btn-lg px-5" type="submit">Forget Password</button>
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

@endsection