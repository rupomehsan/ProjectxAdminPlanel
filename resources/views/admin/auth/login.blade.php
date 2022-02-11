<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link href="{{asset('assets/vendor/MDB5-STANDARD-UI-KIT-Free-3.10.2/css/mdb.min.css')}}" rel="stylesheet">--}}
    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- =======================================================
    * Template Name: Admin - v1.1.0
    * Author: ProjectX.Ltd
    ======================================================== -->
</head>
<body>
<div class="container" id="login_form">
    <div class="row login-box">
        <div class="col-lg-6 col-12 offset-lg-3">
            <div class="card p-5 ">
                <div class="card-body">
                    <div class="text-center">
                        <h4>Log In</h4>
                    </div>

                    <form  id="loginForm" >

                        <!-- Email -->
                        <div class="customInput mt-3">
                            <input placeholder=" " id="email" name="email" class="form-control" type="text">
                            <label for="email">Email</label>
                        </div>
                        <div class="text-danger" id="email_error"></div>


                        <!-- Password -->
                        <div class="customInput mt-3">
                            <input placeholder=" " id="password" name="password" class="form-control" type="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="text-danger" id="password_error"></div>
                        <div class="text-end mb-3">
                            <a href="{{url('forgot-password')}}" class="text-secondary">Forgot password?</a>
                        </div>

                        <button id="submit-button" type="submit" class="form-control btn btn-primary waves-effect mb-3">
                            <i id="submit-icon" class="bi bi-box-arrow-in-right pe-2" aria-hidden="true"></i>
                            <span id="submit-button-loader" class="spinner-border spinner-border-sm d-none"
                                  role="status" aria-hidden="true"></span>
                            Log in
                        </button>
                    </form>
                    <div class="text-center copyright">
                        <span>© 2022 All Rights Reserved. ProjectX.Limited</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--<script src="{{asset('assets/vendor/MDB5-STANDARD-UI-KIT-Free-3.10.2/js/mdb.min.js')}}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>--}}
<!-- CDN JS Files-->
<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
<!--<script src="assets/vendor/iconify.min.js_3.2.0/iconify.min.js"></script>-->

<!-- Template Main JS File -->
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        let token = localStorage.getItem('token') || null
        // console.log(token);
        if (token) {
            window.location.href = "{{url('admin/dashboard')}}";
        }

    });

    $('#loginForm').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData($('#loginForm')[0]);
        $.ajax({
            url: "{{ URL::to('api/login') }}",
            type: 'POST',
            dataType: "json",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            beforeSend: function () {
                $('#submit-button').prop('disabled', true);
            },
            success: function(res) {
                console.log(res);
                if(res.status ==='success'){
                    localStorage.setItem("token", res.data.token);
                    localStorage.setItem("userData", JSON.stringify(res.data.user));
                    window.location.href = "{{url('admin/dashboard')}}";
                }
                // setTimeout(location.reload.bind(location), 1000);
            },
            error: function (xhr, resp, text) {
                // console.log(xhr);
                // on error, tell the failed
                let response = xhr.responseJSON
                console.log(response.status);
                if (response.status === 'validate_error') {
                    $.each(response.message, function (index, message) {
                        if (message.field) {
                            $('#' + message.field).addClass('is-invalid');
                            $('#' + message.field + '_error').html(message.error);
                        }
                    });
                }else if(response.status === 'error'){
                    toastr.error(response.message);
                }
            },
            complete: function (xhr, status) {
                $('#submit-button').prop('disabled', false);
            },
        });
    });
</script>


</body>

</html>
