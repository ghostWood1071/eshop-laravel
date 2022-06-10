@extends('_layout_admin')

@section('content')
<main ng-controller="dashboard">
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Month profit series
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class="">

                                </div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class="">

                                </div>
                            </div>
                        </div>
                        <canvas id="line" class="chart chart-line" chart-data="monthData"
                            chart-labels="months" chart-series="monthSeries" chart-options="monthOptions"
                            chart-dataset-override="datasetOverride" chart-click="onClick">
                        </canvas>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Years profit
                    </div>
                    <div class="card-body"><div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class="">
                            </div>
                        </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class="">
                        </div>
                    </div>
                </div>
                <canvas id="bar" class="chart chart-bar"chart-data="yearData" chart-labels="years"> chart-series="series"
                </canvas>
            </div>
            
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Category distribution
                    </div>
                    <div class="card-body"><div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class="">
                            </div>
                        </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class="">
                        </div>
                    </div>
                </div>
                <canvas class="chart chart-doughnut" chart-data="cateData" chart-labels="categories"> chart-series="series"
                </canvas>
            </div>

        </div>
        <div class="row" style="padding-right: 20px; padding-left:20px;">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                    Top customer
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="c in customers">
                                    <th scope="row">@{{$index+1}}</th>
                                    <td>@{{c.fullname}}</td>
                                    <td>@{{c.address}}</td>
                                    <td>@{{c.phone}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-right: 20px; padding-left:20px;">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                    Top product
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="c in products">
                                    <th scope="row">@{{$index+1}}</th>
                                    <td><img src="/upload/@{{c.image}}" alt="" style= "width: 100px; height: 100px;"></td>
                                    <td>@{{c.name}}</td>
                                    <td><div style="width: 20px; height: 20px; background-color: @{{c.color_value}}"></div></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@section('js')
    <script src="/assets/admin/js/dashboard.module.js"></script>
@stop