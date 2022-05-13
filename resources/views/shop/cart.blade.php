@extends('shop_layout')
@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="blog-single.html">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
	<!-- End Breadcrumbs -->
			
	<!-- Shopping Cart -->
<div class="shopping-cart section" ng-controller="cart">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">DISCOUNT</th>
                            <th class="text-center">TOTAL</th> 
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="c in carts">
                            <td class="image" data-title="No"><img src="/upload/@{{c.image}}" alt="#"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name">@{{c.product_name}}</p>
                                <p class="product-des">
                                    <div style="width:20px; height:20px; background-color:@{{c.color}}"></div>
                                    size: @{{c.size_id}}
                                </p>
                            </td>
                            <td class="price" data-title="Price"><span>@{{c.price | number}} VND</span></td>
                            <td class="qty" data-title="Qty"><!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" ng-click="minus($index)">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text"  class="input-number"  ng-model="c.quantity">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" ng-click="plus($index)">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </td>
                            <td class="total-amount" data-title="Total"><span>@{{c.discount | number}} %</span></td>
                            <td class="total-amount" data-title="Total"><span>@{{c.price*c.quantity | number}} VND</span></td>
                            <td class="action" data-title="Remove"><a href="" ng-click="delete($index)"><i class="ti-trash remove-icon"></i></a></td>
                        </tr>
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                            
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span>@{{total | number}} VND</span></li>
                                    <li>Sale Price<span>@{{sale | number}} VND</span></li>
                                    <li>You Save<span>@{{total-sale | number}} VND</span></li>
                                    <li class="last">You Pay<span>@{{sale | number}} VND</span></li>
                                </ul>
                                <div class="button5">
                                    <a href="" ng-controller="login" class="btn" ng-click="auth()">Checkout</a>
                                    <a href="/product" class="btn">Continue shopping</a>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="/assets/shop/module/category.module.js"></script>
    <script src="/assets/shop/module/cart.module.js"></script>
    <script src="/assets/shop/module/search.module.js"></script>
@stop