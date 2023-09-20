<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/images/thumbnail.png">
    <title>{{ $title1 }}</title>

    <!-- Fontfaces CSS-->
    <link href="be/css/font-face.css" rel="stylesheet" media="all">
    <link href="be/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="be/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="be/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="be/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="be/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="be/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="be/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="be/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="be/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="be/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="be/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="be/css/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/be/css/style-backend.css" type="text/css" />
    <link href="/frontend/css/sweetalert.css" rel="stylesheet">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        @include('admin.inclu.sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            @include('admin.inclu.header')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('admin_content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="be/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="be/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="be/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="be/vendor/slick/slick.min.js">
    </script>
    <script src="be/vendor/wow/wow.min.js"></script>
    <script src="be/vendor/animsition/animsition.min.js"></script>
    <script src="be/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="be/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="be/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="be/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="be/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="be/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="be/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="be/js/main.js"></script>
    <script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js"></script>
    {{-- <script type="text/javascript">
        $(window).load( function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

        switch(window.location.protocol) {
        case 'http:':
        case 'https:':
        // running on a server, should be good.
        break;
        case 'file:':
        alert('Just a heads-up, events will not work when run locally.');
        }

        });
    </script> --}}
    <script src="/frontend/js/sweetalert.min.js"></script>

    @yield('script')
    <script>
        /*
            Trong đoạn mã này sẽ:
            Đặt giá trị 'opacity' của phần tử có id "alert" thành 0 sau 10s
            Sau đó, đặt thuộc tính 'display' thành none sau 2s để ẩn phần tử
            (Hiệu ứng mờ dần sẽ diễn ra trong vòng 2s)
        */
        setTimeout(function() {
            // Lấy thẻ div chứa thông báo
            var alertDiv = document.getElementById('alert');
            alertDiv.style.opacity = 0;
            setTimeout(function() {
                alertDiv.style.display = 'none';
            }, 2000); // Mất sau 2 giây
        }, 10000); // Hiển thị trong 10 giây

    </script>
</body>

</html>
<!-- end document-->
