@extends('shop_layout')
@section('css')
    <style>
        .owl-item{
            display: flex;
        }
    </style>
@stop
@section('content')
    	<!-- Slider Area -->
<section class="hero-slider">
    <!-- Single Slider -->
    <div class="single-slider" style="background-image: url('/upload/Flannel_1920x1050_desktop.jpeg')">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-9 offset-lg-3 col-12">
                    <div class="text-inner">
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                <div class="hero-text">
                                    <h1>Ananas</h1>
                                    <p>Với mỗi sản phẩm ra đời, chúng tôi sẽ tiếp tục nâng cao những kỳ vọng của các bạn yêu sneaker để đánh thức cảm hứng thời trang. DiscoverYOU.</p>
                                    <div class="button">
                                        <a href="#" class="btn">Shop Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Single Slider -->
</section>
<!--/ End Slider Area -->

<div ng-controller="index">
<!-- Start Product Area -->
<div class="product-area section" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li ng-repeat="c in categories" class="nav-item"><a class="nav-link @{{$index==0?'active':''}}" data-toggle="tab" href="" ng-click="getTrending(c.id)" role="tab">@{{c.name}}</a></li>
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" id="man" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12" ng-repeat="t in trends">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="/product-detail?id=@{{t.id}}&color_id=@{{t.color_id}}">
                                                    <img class="default-img" src="/upload/@{{t.image}}" alt="#">
                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action">
                                                        
                                                    </div>
                                                    <div class="product-action-2">
                                                        <a title="Add to cart" href="/product-detail?id=@{{t.id}}&color_id=@{{t.color_id}}">Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="/product-detail?id=@{{t.id}}&color_id=@{{t.color_id}}">@{{t.name}}-@{{t.color_name}}</a></h3>
                                                <div class="color" style="background-color: @{{t.color_value}}; width: 20px; height: 20px"></div>
                                                <div class="product-price">
                                                    <span>@{{t.sold_value | number}} VND</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->

<!-- Start Most Popular -->
<div class="product-area most-popular section" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>New Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-pane fade show active row">
                    <!-- Start Single Product -->
                    <div class="col-xl-3 col-lg-4 col-md-4" ng-repeat = "l in latests">
                        <div class="single-product" >
                            <div class="product-img">
                                <a href="/product-detail?id=@{{l.product_new.id}}&color_id=@{{l.id}}">
                                    <img class="default-img" src="/upload/@{{l.image[0].name}}" alt="#">
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        
                                    </div>
                                    <div class="product-action-2">
                                        <a ng-controller="cart" title="Add to cart" href="/product-detail?id=@{{l.product_new.id}}&color_id=@{{l.id}}">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="/product-detail?id=@{{l.product_new.id}}&color_id=@{{l.id}}">@{{l.product_new.name}}-@{{l.name}}</a></h3>
                                <div class="color" style="background-color: @{{l.value}}; width: 20px; height: 20px"></div>
                                <div class="product-price">
                                    <span>@{{l.price[0].sold_value | number}} VND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

<!-- Start Shop Home List  -->
<section class="shop-home-list section" >
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>On sale</h1>
                        </div>
                    </div>
                </div>
                <!-- Start Single List  -->
                <div class="single-list" ng-repeat="n in sales">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="/upload/@{{n.image[0].name}}" alt="#">
                                <a href="/product-detail?id=@{{n.product.id}}&color_id=@{{n.id}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="/product-detail?id=@{{n.product.id}}&color_id=@{{n.id}}">@{{n.product.name}}-@{{n.name}}</a></h5>
                                <p class="price with-discount">@{{n.price[0].sold_value | number}} VND</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Best Seller</h1>
                        </div>
                    </div>
                </div>
                <!-- Start Single List  -->
                <div class="single-list" ng-repeat = "t in trends">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="/upload/@{{t.image}}" alt="#">
                                <a href="/product-detail?id=@{{t.id}}&color_id=@{{t.color_id}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="/product-detail?id=@{{t.id}}&color_id=@{{t.color_id}}">@{{t.name}}</a></h5>
                                <p class="price with-discount">@{{t.sold_value | number}} VND</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>New items</h1>
                        </div>
                    </div>
                </div>
                <!-- Start Single List  -->
                <div class="single-list" ng-repeat="n in latests">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="/upload/@{{n.image[0].name}}" alt="#">
                                <a href="/product-detail?id=@{{n.product_new.id}}&color_id=@{{n.id}}" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="/product-detail?id=@{{n.product_new.id}}&color_id=@{{n.id}}">@{{n.product_new.name}}-@{{n.name}}</a></h5>
                                <p class="price with-discount">@{{n.price[0].sold_value | number}} VND</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->

<!-- Start Shop Services Area -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services Area -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" required="" type="email">
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->
<!-- Modal end -->
</div>
@stop
@section('js')
    <script src="/assets/shop/module/category.module.js"></script>
    <script src="/assets/shop/module/index.module.js"></script>
    <script src="/assets/shop/module/cart.module.js"></script>
    <script src="/assets/shop/module/search.module.js"></script>
@stop