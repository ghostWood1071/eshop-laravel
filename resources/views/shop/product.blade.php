@extends('shop_layout')
@section('content')
<div ng-controller="product">
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Shop Grid</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Style -->
    <section class="product-area shop-sidebar shop section" >
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar">
                            <!-- Single Widget -->
                            <div class="single-widget category" ng-controller = "category">
                                <h3 class="title">Categories</h3>
                                <ul class="categor-list">
                                    <li><a href="" ng-click="getProductAccordingCategory('')">All</a></li>
                                    <li ng-repeat="c in categories"><a href="" ng-click="getProductAccordingCategory(c.id)">@{{c.name}}</a></li>
                                </ul>
                            </div>
                           
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Shop Top -->
                            <div class="shop-top">
                                <div class="shop-shorter">
                                    <div class="single-shorter">
                                        <label>Show :</label>
                                        <select ng-model="maxSize" ng-change="loadProducts()">
                                            <option selected="selected" value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <label>Sort By :</label>
                                        <select ng-model="sort">
                                            <option selected="selected" value="product.name">Name</option>
                                            <option value="price[0].sold_value">Price</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="view-mode">
                                    
                                </ul>
                            </div>
                            <!--/ End Shop Top -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12" ng-repeat="p in products | orderBy: sort | filter: txtSearch">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="/product-detail?id=@{{p.product.id}}&color_id=@{{p.id}}">
                                        <img class="default-img" src="/upload/@{{p.image[0].name}}" alt="#">
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                        </div>
                                        <div class="product-action-2">
                                            <a title="Add to cart"  href="/product-detail?id=@{{p.product.id}}&color_id=@{{p.id}}">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a  href="/product-detail?id=@{{p.product.id}}&color_id=@{{p.id}}">@{{p.product.name}}-@{{p.name}}</a></h3>
                                    <div style="background-color: @{{p.value}}; width:20px; height: 20px;"></div>
                                    <div class="product-price">
                                        <span>@{{p.price[0].sold_value | number}} VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <ul uib-pagination total-items="totalItems" ng-model="currentPage" max-size="maxSize" class="pagination-sm" boundary-link-numbers="true" ng-change="loadProducts()"></ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!--/ End Product Style 1  -->	
</div>
@stop

@section('js')
    <script src="/assets/shop/module/product.module.js"></script>
    <script src="/assets/shop/module/category.module.js"></script>
    <script src="/assets/shop/module/cart.module.js"></script>
    <script src="/assets/shop/module/search.module.js"></script>
@stop