@extends('_layout_admin')
@section('css')
    <style>
        .modal-lg{
            max-width: 98% !important;
        }
    </style>
@stop
@section('content')
<main ng-controller="import">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Import product management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Import product manager</li>
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
                    <button class='btn btn-primary' ng-click="openModal(-1,-1)">Create</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Staff</th>
                            <th>Import date</th>
                            <th>Total price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Index</th>
                            <th>Staff</th>
                            <th>Import date</th>
                            <th>Total price</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr ng-repeat = "i in imports">
                            <td style="width: 30px; text-align=center;">@{{$index+1}}</td>
                            <td>@{{i.user.fullname}}</td>
                            <td>@{{i.import_date}}</td>
                            <td>@{{i.total_price}}</td>
                            <td style="width:100px; font-size: 16px; text-align:center">
                                <a ng-click="openModal(i.id, $index)" href="" style="margin-right:10px">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a ng-click="openConfirm(i.id, $index)" href="">
                                    <i class="fa fa-trash"></i>
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
                            <h5 class="modal-title" id="exampleModalLabel">@{{title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid row">
                                <div class="col-lg-8">
                                    <div style="display:flex;">
                                        <div class="form-group">
                                            <label for="name">Staff:</label>
                                            <div>
                                                <select ng-model="import.user_id">
                                                    <option ng-repeat="u in users" value="@{{u.id}}">@{{u.fullname}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-left:20px">
                                            <label for="des">Import date:</label>
                                            <div>
                                                <input type="text" id="date" ng-model="import.import_date" style="height:25.2px;">
                                            </div>
                                        </div>
                                    </div>
                                    <h4>Import products</h4>
                                    <table id="impordetailtable">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px; text-align:center;">Index</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                                <th>import price</th>
                                                <th>sold price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat = "d in details">
                                                <td style="width: 30px; text-align:center;">@{{$index+1}}</td>
                                                <td><img style="width:50px;" src="/upload/@{{d.image}}" alt="" srcset=""></td>
                                                <td style="width:30px;">@{{d.name}}</td>
                                                <td ><input style="width:100%;" type="text" ng-model="d.size" ng-change="change($index)" ng-disabled="@{{d.id!=null}}"></td>
                                                <td><input style="width:100%;" type="number" ng-model="d.quantity"ng-change="change($index)"></td>
                                                <td><input style="width:100%;" type="number" ng-model="d.import_price"ng-change="change($index)"></td>
                                                <td><input style="width:100%;" type="number" ng-model="d.sold_price"ng-change="change($index)"></td>
                                                <td style="width:30px; font-size: 16px; text-align:center">
                                                    <a href="" ng-click="confirmDetail($index)"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-4">
                                    <h4>Product list</h4>
                                    <table id="producttable">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px; text-align:center;">Index</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Color</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat = "p in products" ng-click="chooseProduct($index)">
                                                <td style="width: 30px; text-align:center;">@{{$index+1}}</td>
                                                <td><img style="width:40px;" src="/upload/@{{p.image[0].name}}" alt="" srcset=""></td>
                                                <td>@{{p.product.name}}-@{{p.name}}</td>
                                                <td><div style="width: 30px; height: 30px; background-color:@{{p.value}}"></div></td>
                                                <!-- <td style="width:30px; font-size: 16px; text-align:center">
                                                    <input type="checkbox" ng-change="chooseProduct($index)" ng-model="p.check">
                                                </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="paginate">
                                        <ul uib-pagination total-items="ptotalItems" ng-model="pcurrentPage" max-size="pmaxSize" class="pagination-sm" boundary-link-numbers="true" ng-change="loadPr()"></ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" ng-click="closeUpdateModal()">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="save()">Save changes</button>
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
                <div class="modal fade" id="deletedetailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-primary" ng-click="removeDetail()">Save changes</button>
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
    <script>
        $('#date').datepicker({ dateFormat: 'dd-mm-yy' })
    </script>
    <script src="/assets/admin/js/import.module.js"></script>
@stop