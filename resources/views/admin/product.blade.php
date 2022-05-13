@extends('_layout_admin')

@section('css')
    <style>
        .modal-lg{
            max-width: 98% !important;
        }
    </style>
@stop

@section('content')
<main ng-controller="product">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage product</li>
        </ol>
        <!-- <div class="card mb-4">
            <div class="card-body">
               
            </div>
        </div> -->
        <div class="card mb-4">
            <div class="card-header" style="display: flex; justify-content: space-between;">
                <div>
                    <i class="fa fa-table me-1"></i>
                    Product list
                </div>
                <div>
                    <button class='btn btn-primary' ng-click="openModal(-1,-1)">Create</button>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th style="width: 20px; text-align:center;">Index</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Release date</th>
                            <td><b>Quantity</b></td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat = "p in products">
                            <td style="width: 30px; text-align:center;">@{{$index+1}}</td>
                            <td><img style="width:100px;" src="/upload/@{{p.image}}" alt="" srcset=""></td>
                            <td>@{{p.name}}</td>
                            <td>@{{p.cate_name}}</td>
                            <td>@{{p.release_date}}</td>
                            <td style="text-align:right">@{{p.quantity==null?0:p.quantity}}</td>
                            <td style="width:100px; font-size: 16px; text-align:center">
                                <a ng-click="openModal(p.id, $index)" href="" style="margin-right:10px">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a ng-click="openConfirm(p.id, $index)" href="">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>

                <!-- create-update modal -->
                <div class="modal fade bd-example-modal-lg" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <div>
                                            <input id="name" type="text" ng-model="product.name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cat">Category:</label>
                                        <div>
                                            <select name="" id="cat" ng-model="product.category_id">
                                                <option ng-repeat="c in categories" value="@{{c.id}}">@{{c.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Release date:</label>
                                        <div>
                                            <input type="text" id="date" ng-model="product.release_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div>
                                        color code: <input type="text" style="margin-right: 10px;" ng-model="color.value"> 
                                        name: <input type ="text" style="margin-right: 10px;" ng-model="color.name"> 
                                        image: <input type="file" multiple id="file">
                                        <a ng-click="viewImage()" href=""><i class="fa fa-eye"></i></a>
                                        discount: <input type="number" ng-model="color.discount" style="margin-top: 10px;">
                                        <button class="btn btn-primary" style="margin-right: 10px;" ng-click="addColor()" style="margin-top: 10px;">Create</button>
                                        <button class="btn btn-primary" style="margin-right: 10px;" ng-click="updateColor()" style="margin-top: 10px;">Update</button>
                                    </div>
                                    <div style="margin-top: 30px">
                                        <div >
                                            <h4>Color list</h4>
                                        </div>
                                        <div>
                                            <table id="color-table">
                                                <thead>
                                                    <tr>
                                                        <td>Index</td>
                                                        <td>Name</td>
                                                        <td>Color</td>
                                                        <td>Price</td>
                                                        <td>Discount</td>
                                                        <td>Quantity</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="color-row" ng-repeat="c in colors" style="background-color:@{{getColorForColorRow($index)}}" ng-click="chooseColor($index)">
                                                        <td>@{{$index+1}}</td>
                                                        <td>@{{c.name}}</td>
                                                        <td><div style="width:20px; height:20px; background-color:@{{c.value}}"></div></td>
                                                        <td style="text-align:right;">@{{c.sold_value==null?0:c.sold_value}}</td>
                                                        <td style="text-align:right;">@{{c.discount==null?0:c.discount}}</td>
                                                        <td style="text-align:right;">@{{c.quantity==null?0:c.quantity}}</td>
                                                        <td style="width:100px; font-size: 16px; text-align:center">
                                                            <a ng-click="openConfirmColor($index)" href="">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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

                <!-- confirm to delete product -->
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

                <!-- confirm delete color -->
                <div class="modal fade" id="deletecolormodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        <p>Do you want to delete this color?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="removeColor()">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- view image modal -->
                <div class="modal fade" id="view-image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Product's images</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="position: relative;">
                            <i class="fa fa-trash" ng-click="openConfirmImage()" style="position:absolute; right:10px; top:20px;"></i>
                            <i class="fa fa-chevron-left" ng-click="viewPrev()" style="position:absolute; left:10px; top:50%;"></i>
                            <i class="fa fa-chevron-right" ng-click="viewNext()" style="position:absolute; right:10px; top:50%;"></i>
                            <div style="width:300px; margin:auto;">
                                <img style="width:100%;" src="@{{preview}}" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- confirm delete image -->
                <div class="modal fade" id="deleteimagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        <p>Do you want to delete this picture?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" ng-click="deleteImage()">Save changes</button>
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
    <script src="/assets/admin/js/product.module.js"></script>
@stop