@extends('_layout_admin')
@section('content')
<main ng-controller="user">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Staff management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Staff manager</li>
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
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat = "c in users | filter: txtSearch">
                            <td style="width: 30px; text-align=center;">@{{$index+1}}</td>
                            <td>@{{c.fullname}}</td>
                            <td>@{{c.address}}</td>
                            <td>@{{c.phone}}</td>
                            <td style="width:100px; font-size: 16px; text-align:center">
                                <a ng-click="openModal(c.id, $index)" href="" style="margin-right:10px">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a ng-click="openConfirm(c.id, $index)" href="">
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@{{title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <div>
                                        <input id="name" type="text" ng-model="user.fullname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="des">Address: </label>
                                    <div>
                                        <input type="text" ng-model="user.address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="des">Phone: </label>
                                    <div>
                                        <input type="text" ng-model="user.phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="des">Account: </label>
                                    <div>
                                        <input type="text" ng-model="user.account">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            </div>
        </div>
    </div>
</main>
@stop

@section('js')
    <script src="/assets/admin/js/user.module.js"></script>
@stop