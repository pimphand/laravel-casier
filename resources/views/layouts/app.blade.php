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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/prism.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('assets') }}/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/responsive.css">
    @stack('css')
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
        <!-- Page Header Start-->
       <x-admin.header />
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <x-admin.sidebar />
            <!-- Page Sidebar Ends-->
            <x-admin.right-sidebar />
            <!-- Right sidebar Start-->
            <!-- Right sidebar Ends-->
            <div class="page-body">

                @yield('page-header')

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright © 2021 Poco. All rights reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="pull-right mb-0">Hand-crafted & made with<i class="fa fa-heart"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
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
    <script src="{{ asset('assets') }}/js/prism/prism.min.js"></script>
    <script src="{{ asset('assets') }}/js/clipboard/clipboard.min.js"></script>
    <script src="{{ asset('assets') }}/js/custom-card/custom-card.js"></script>
    <script src="{{ asset('assets') }}/js/chat-menu.js"></script>
    <script src="{{ asset('assets') }}/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets') }}/js/script.js"></script>
    <script src="{{ asset('assets') }}/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugins JS start-->
    <script src="{{ asset('assets') }}/js/sweet-alert/sweetalert.min.js"></script>
    <!-- Plugin used-->
    @stack('js')
    <script>
        $.ajaxSetup({
           async: true, // Set to true if you want asynchronous requests (this is the default)
           headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
           }
       });

        $('.log-out').click(function (e) {
            e.preventDefault();
            formAjax('', "{{ route('logout') }}", 'post').then(function (response) {
                window.location.href = "{{ route('dashboard') }}";
            })
        });

        function formAjax(data = null, url, method = 'post',) {
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

        setTimeout(function () {
            $('.btn-primary').attr('disabled', false);
        }, 2000);

        function generatePaginationHtml(response) {
            let paginationHtml = '';
            let totalPages = response.meta.last_page;

            // Add Previous button
            paginationHtml += `<li class="page-item ${response.meta.current_page === 1 ? 'disabled' : ''}">
                                <a class="page-link" href="#" data-page="${response.meta.current_page - 1}">Previous</a>
                            </li>`;

            // Loop to add page numbers
            for (let i = 1; i <= totalPages; i++) {
                paginationHtml += `<li class="page-item ${response.meta.current_page === i ? 'active' : ''}">
                                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                                </li>`;
            }

            // Add Next button
            paginationHtml += `<li class="page-item ${response.meta.current_page === totalPages ? 'disabled' : ''}">
                                <a class="page-link" href="#" data-page="${response.meta.current_page + 1}">Next</a>
                            </li>`;
            if (response.meta.last_page > 1) {
                return paginationHtml;
            }
            return;
        }
    </script>
</body>

</html>
