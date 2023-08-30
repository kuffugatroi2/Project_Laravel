<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
	<meta charset="UTF-8">
	<base href="{{asset('')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/images/thumbnail.png">
    <title>{{$title}}</title>

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

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/">
                                <img src="frontend/images/menu/logo/1.jpg" alt="">
                            </a>
                        </div>
                        <div class="login-form">

							@include('alert')

							<?php
								$message = Session::get('message');
								if ($message) {
									echo '<div class="alert alert-danger">'.$message.'</div>';
									Session::put('message', null);
								}
							?>

							{{-- nên dùng như cách này trong alert--}}

							{{-- @if (session('message'))
								<div class="alert alert-danger">
									{{session('message')}}
								</div>
							@endif --}}

                            <form action="{{route('PostLogin')}}" method="post">
								{{csrf_field()}}
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="au-input au-input--full" type="email" name="admin_email" placeholder="Email">
								</div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input class="au-input au-input--full" type="password" name="admin_password" placeholder="Password">
                                </div>
                                {{-- <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label>
                                </div> --}}
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                {{-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                        <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                    </div>
                                </div> --}}
                            </form>
                            {{-- <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="be/#">Sign Up Here</a>
                                </p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
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

</body>

</html>
<!-- end document-->