@extends('Admin.layouts.header')

@section('title','Admin Login')

<div class="row">

    <!-- Left col -->
    <div class="container register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>Login</a>
        </div>
        <div id="show_errors"></div>
        <div class="card">
            <div class="card-body register-card-body">

                <form id="admin_login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{route('RegisterAdmin')}}" class="text-center">Register If NO Accounts</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#admin_login").submit(function(event) {
            var form = $("#admin_login")[0];
            var data = new FormData(form);
            event.preventDefault();
            $.ajax({
                url: "{{route('login_post')}}",
                method: "post",
                data: data,
                processData: false,
                contentType: false,
                success: function(responce) {
                    if (responce.status == 400) {
                        $('#show_errors').html('');
                        $.each(responce.message, function(key, value) {
                            $('#show_errors').append('<div class="alert alert-danger">' + value + '</div');
                        });
                    } else {
                       window.location='dashboard';
                    }
                }
            });
        });
    });
</script>
@extends('Admin.layouts.footer')