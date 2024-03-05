<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <title>Poco - Premium Admin Template</title>
    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/themify.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/animate.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('assets') }}/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/responsive.css">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="typewriter">
            <h1>New Era Admin Loading..</h1>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <!-- login page start-->
            <div class="authentication-main">
                <div class="row">
                    <div class="col-md-12">
                        <div class="auth-innerright">
                            <div class="authentication-box">
                                <div class="card-body p-0">
                                    <div class="cont text-center">
                                        <div>
                                            <form class="theme-form" id="form-login" action="{{ route('login') }}">
                                                @csrf
                                                <h4>LOGIN</h4>
                                                <h6>Enter your Username and Password</h6>
                                                <div class="form-group">
                                                    <label class="col-form-label pt-0">Your Name</label>
                                                    <input class="form-control" id="login-email" type="email" name="email" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label">Password</label>
                                                    <input class="form-control " id="login-password" type="password" name="password"
                                                        required="">
                                                </div>
                                                <div class="checkbox p-0">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1">Remember me</label>
                                                </div>
                                                <div class="form-group form-row mt-3 mb-0">
                                                    <button class="btn btn-primary btn-block login" data-type="login"
                                                        type="button">LOGIN</button>
                                                </div>
                                                <div class="login-divider"></div>
                                                <div class="social mt-3">
                                                    <div class="form-row btn-showcase">
                                                        <div class="col-md-4 col-sm-6">
                                                            <button class="btn social-btn btn-fb">Facebook</button>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6">
                                                            <button class="btn social-btn btn-twitter">Twitter</button>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6">
                                                            <button class="btn social-btn btn-google">Google + </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="sub-cont">
                                            <div class="img">
                                                <div class="img__text m--up">
                                                    <h2>New here?</h2>
                                                    <p>Sign up and discover great amount of new opportunities!</p>
                                                </div>
                                                <div class="img__text m--in">
                                                    <h2>One of us?</h2>
                                                    <p>If you already has an account, just sign in. We've missed you!
                                                    </p>
                                                </div>
                                                <div class="img__btn"><span class="m--up">Sign up</span><span
                                                        class="m--in">Sign in</span></div>
                                            </div>
                                            <div style="height: 100%; overflow-x: auto;">
                                                <form class="theme-form" id="form-register" action="{{ route('api.register') }}">
                                                    <h4 class="text-center">Register</h4>
                                                    </h6>
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input class="form-control store_name" type="text" placeholder="Nama Toko" id="register-store_name" name="store_name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input class="form-control name" type="text" placeholder="Nama Lengkap" id="register-name" name="name">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control username" type="text" placeholder="Username" id="register-username" name="username">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control email" type="text" placeholder="Email" id="register-email" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control phone" type="text" placeholder="Nomor Telepon" id="register-phone" name="phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="password" id="register-password" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="password_confirmation" id="register-password_conformation" placeholder="Konfirmasi Password">
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <input class="form-control" type="text" name="password" id="referral" placeholder="Password">
                                                    </div> --}}

                                                    <div class="form-row">
                                                        <div class="col-sm-4">
                                                            <button class="btn btn-primary" data-type="register" type="button">Daftar</button>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-divider"></div> --}}
                                                    {{-- <div class="social mt-3">
                                                        <div class="form-row btn-showcase">
                                                            <div class="col-sm-4">
                                                                <button class="btn social-btn btn-fb">Facebook</button>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <button
                                                                    class="btn social-btn btn-twitter">Twitter</button>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <button class="btn social-btn btn-google">Google
                                                                    +</button>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login page end-->
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets') }}/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets') }}/js/bootstrap/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets') }}/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('assets') }}/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets') }}/js/sidebar-menu.js"></script>
    <script src="{{ asset('assets') }}/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets') }}/js/login.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets') }}/js/script.js"></script>
    <script src="{{ asset('assets') }}/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script>
        $.ajaxSetup({
            async: true, // Set to true if you want asynchronous requests (this is the default)
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $('.btn-primary').click(function (e) {
            e.preventDefault();
            let form;
            let type = $(this).data('type');
            if ( type == 'login') {
                form = $(this).closest('#form-login');
            } else {
                form = $(this).closest('#form-register');
            }

            let data = form.serialize();
            formAjax(data, form.attr('action'), 'post').then(function (response) {
                localStorage.setItem('token', response.token);
                window.location.href = "{{ route('dashboard') }}";
            })
            .catch(function (error) {
                //remove error message
                $('.text-danger').remove();
                let errors = error.responseJSON.errors;
                for (const key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        const element = errors[key];
                        $(`#${type}-${key}`).after(`<div class="text-danger text-left mt-1" id="error-${key}">${element}</div>`);
                    }
                }
            });
        });

        function formAjax(data, url, method = 'post',) {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json'
                }).done(function (response) {
                    resolve(response);
                }).fail(function (error) {
                    reject(error);
                });
            });
        }
    </script>
</body>

</html>
