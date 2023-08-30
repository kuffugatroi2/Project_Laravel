<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Checkout | E-Shopper</title>
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="/frontend/css/prettyPhoto.css" rel="stylesheet">
    <link href="/frontend/css/price-range.css" rel="stylesheet">
    <link href="/frontend/css/animate.css" rel="stylesheet">
    <link href="/frontend/css/main.css" rel="stylesheet">
    <link href="/frontend/css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
	@include('inclu.header_top')

    @include('inclu.header_middle')

	@include('inclu.menu')
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">

			<div class="review-payment">
				<h2>Cảm ơn bạn đã đặt hàng ở shop chúng tôi, chúng tôi sẽ liên hệ với bạn sớm nhất</h2>
			</div>

	</section> <!--/#cart_items-->

	@include('inclu.footer')

  <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
