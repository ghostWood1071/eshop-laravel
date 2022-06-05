@extends('shop_layout')
@section('content')
    <div class="container-fluid" ng-controller='order' style="margin-top: 30px; margin-bottom: 30px;">
        <div class="container border border-primary" style="margin-top: 30px" ng-repeat='o in orders'>
            <div>
                <div style="padding: 12px; display: flex; justify-content: space-between">
                    <div>
                        Address: @{{o.address}} <br>
                        Order date: @{{o.order_date | date}} <br>
                        Total: @{{o.total_price | number}} VND <br>
                        Status: <select ng-model="o.status" style="margin-bottom: 10px" ng-disabled="true">
                            <option value="0">ordered</option>
                            <option value="1">preparing</option>
                            <option value="2">transporting</option>
                            <option value="3">shipping</option>
                            <option value="4">successful delivery</option>
                            <option value="5">cancel</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary" ng-disabled="@{{o.status>1}}" ng-click="save($index)">Cancel</button>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Color</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='d in o.details'>
                            <th scope="row">@{{$index+1}}</th>
                            <td>
                                <img style="width:100px" src="/upload/@{{d.color.image[0].name}}" alt="" srcset="">
                            </td>
                            <td>@{{d.color.product.name}}</td>
                            <td>
                                <div style="width: 30px; height: 30px; background-color: @{{d.color.value}}"></div>
                            </td>
                            <td>@{{d.size_id}}</td>
                            <td>@{{d.quantity}}</td>
                            <td>@{{d.unit_price | number}} VND</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop 
@section('js')
    <script src="/assets/shop/module/order.module.js"></script>
    <script src="/assets/shop/module/category.module.js"></script>
    <script src="/assets/shop/module/cart.module.js"></script>
    <script src="/assets/shop/module/search.module.js"></script>
@stop