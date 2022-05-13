<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Ananas shop</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="/assets/shop/images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="/assets/shop/css/bootstrap.css">
	
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="/assets/shop/css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/shop/css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="/assets/shop/css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="/assets/shop/css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="/assets/shop/css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="/assets/shop/css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="/assets/shop/css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="/assets/shop/css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="/assets/shop/css/slicknav.min.css">
	<link rel="stylesheet" href="/js/toastr/toastr.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="/assets/shop/css/reset.css">
	<link rel="stylesheet" href="/assets/shop/style.css">
    <link rel="stylesheet" href="/assets/shop/css/responsive.css">
	
	@yield('css')
</head>
<body class="js" ng-app="shop">
	
	
	<!-- Header -->
	@if(!isset($header)) 
		@include('includes.shop.header') 
	@elseif(isset($header)) 
		@include('includes.shop.header2') 
	@endif
	<!--/ End Header -->
	
	<!-- CONTENT -->
    @yield('content')
    <!-- END CONTENT -->
	
	<!-- Start Footer Area -->
	@include('includes.shop.footer')
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="/assets/shop/js/jquery.min.js"></script>
    <script src="/assets/shop/js/jquery-migrate-3.0.0.js"></script>
	<script src="/assets/shop/js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="/assets/shop/js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="/assets/shop/js/bootstrap.min.js"></script>
	<!-- Slicknav JS -->
	<script src="/assets/shop/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="/assets/shop/js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="/assets/shop/js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="/assets/shop/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="/assets/shop/js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="/assets/shop/js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="/assets/shop/js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="/assets/shop/js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="/assets/shop/js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="/assets/shop/js/easing.js"></script>
	<script src="/js/toastr/toastr.min.js"></script>
	<!-- Active JS -->
	<script src="/assets/shop/js/active.js"></script>
	<script src="/js/angular.min.js"></script>
	<script src="/js/ui-bootstrap-tpls-3.0.6.min.js"></script>
	<script src="/assets/shop/module/main.app.js"></script>
    @yield('js')
</body>
</html>