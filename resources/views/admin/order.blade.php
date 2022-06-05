@extends('_layout_admin')
@section('content')
<main ng-controller="order">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Order management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Order manager</li>
        </ol>
        <!-- <div class="card mb-4">
            <div class="card-body">
               
            </div>
        </div> -->
        <div class="card mb-4">
            <div class="card-header" style="display: flex; justify-content: space-between;">
                <div>
                    <div>
                        <input type="text" ng-model="txtSearch" style="height:36px;">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                    <div style="margin-top: 20px">
                        <select ng-model="maxSize" ng-change="load()">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                        items per page
                    </div>
                </div>
                <div>
                    <button class='btn btn-primary' ng-click="save()">Save</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Customer</th>
                            <th>Order date</th>
                            <th>Total price</th>
                            <th>Shipping address</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat = "o in orders | filter: txtSearch">
                            <td style="width: 30px; text-align=center;">@{{$index+1}}</td>
                            <td>@{{o.user.fullname}}</td>
                            <td>@{{o.order_date}}</td>
                            <td style="text-align:right">@{{o.total_price | number}}</td>
                            <td>@{{o.address}}</td>
                            <td>@{{getPayment(o.payment)}}</td>
                            <!-- <td>@{{getStatus(o.status)}}</td> -->
                            <td>
                                <select ng-model="o.status" ng-change="change(o)">
                                    <option value="0">ordered</option>
                                    <option value="1">preparing</option>
                                    <option value="2">transporting</option>
                                    <option value="3">shipping</option>
                                    <option value="4">successful delivery</option>
                                    <option value="5">cancel</option>
                                </select>
                            </td>
                            <td style="width:100px; font-size: 16px; text-align:center">
                                <a ng-click="openModal($index)" href="" style="margin-right:10px">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="paginate">
                    <ul uib-pagination total-items="totalItems" ng-model="currentPage" max-size="maxSize" class="pagination-sm" boundary-link-numbers="true" ng-change="load()"></ul>
                </div>
                <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Index</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Unit price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="d in details">
                                            <th scope="row">@{{$index+1}}</th>
                                            <td>@{{d.name}}</td>
                                            <td><div style="background-color: @{{d.value}}; width: 20px; height: 20px;"></div></td>
                                            <td style="text-align:right">@{{d.size_id}}</td>
                                            <td style="text-align:right">@{{d.quantity}}</td>
                                            <td style="text-align:right">@{{d.discount}}</td>
                                            <td style="text-align:right">@{{d.unit_price}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        <p>bạn có muốn xóa không?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="delete()">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@section('js')
    <script src="/assets/admin/js/order.module.js"></script>
@stop