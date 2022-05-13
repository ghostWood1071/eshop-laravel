@extends('shop_layout')
@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="blog-single.html">Shop Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="shop single section" ng-controller="product_detail">
    <div class="container">
        <div class="row"> 
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <!-- Images slider -->
                            <div class="flexslider-thumbnails">
                                <div class="flex-viewport" style="overflow: hidden; position: relative;">
                                    <ul class="slides" >
                                        <li class="clone">
                                            <img src="/upload/@{{image.name}}" alt="#">
                                        </li>
                                    </ul>
                                </div>
                                <ol class="flex-control-nav flex-control-thumbs">
                                    <li ng-repeat = "i in images" ng-click="chooseImg($index)"><img src="/upload/@{{i.name}}"></li>
                                </ol>
                                <ul class="flex-direction-nav">
                                    <li><a class="flex-prev" href="#"></a></li>
                                    <li><a class="flex-next" href="#"></a></li>
                                </ul>
                            </div>
                            <!-- End Images slider -->
                        </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="product-des">
                            <!-- Description -->
                            <div class="short">
                                <h4>@{{product.name}}</h4>
                                
                                <p class="price">
                                    <span class="discount">@{{color.price[0].sold_value-color.price[0].sold_value*color.discount | number}} VND</span>
                                    <s style="visibility: @{{color.discount==0?'hidden':'visible'}}">@{{color.price[0].sold_value | number}} VND</s>
                                </p>
                                <!-- <p class="description">eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in</p> -->
                            </div>
                            <!--/ End Description -->
                            <!-- Color -->
                            <div class="color" style="margin-top: 50px;">
                                <h4>Available Options <span>Color</span></h4>
                                <ul>
                                    <li ng-repeat="c in colors">
                                        <a href="" ng-click="chooseColor($index)" style="background: @{{c.value}}">
                                            <i class="ti-check" style="opacity: @{{c.id==color.id?1:0}}; visibility: @{{c.id==color.id?'visible':'hidden'}}"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--/ End Color -->
                            <!-- Size -->
                            <div class="size">
                                <h4>Size</h4>
                                <ul>
                                    <li ng-repeat="s in sizes" style="visibility: @{{s.quantity==0?'hidden':'visible'}}">
                                        <a href="" ng-click="chooseSize($index)" style="color: @{{s.id==size.id?'#F7941D':'black'}}">@{{s.value}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!--/ End Size -->
                            <!-- Product Buy -->
                            <div class="product-buy">
                                <div class="quantity">
                                    <h6>Quantity :</h6>
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" ng-click="minus()">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="input-number" ng-model="quantity">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" ng-click="plus()">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <a ng-controller="cart" href="" ng-click="addCart(product, color, size, images[0], quantity)" class="btn">Add to cart</a>
                                </div>
                                <p class="cat">Category : @{{product.category.name}}</p>
                                <p style="visibility: @{{size==undefine?'hidden':'visible'}}" class="availability">Availability : @{{inStock}} Products In Stock</p>
                            </div>
                            <!--/ End Product Buy -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">
                            <div class="nav-main">
                                <!-- Tab Nav -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
                                </ul>
                                <!--/ End Tab Nav -->
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="row">
                                            <div class="col-12" style="margin-top:50px;">
                                                @{{product.category.description}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop


@section('js')
    <script src="/assets/shop/module/product.detail.module.js"></script>
    <script src="/assets/shop/module/category.module.js"></script>
    <script src="/assets/shop/module/cart.module.js"></script>
    <script src="/assets/shop/module/search.module.js"></script>
@stop