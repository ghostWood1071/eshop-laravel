<!DOCTYPE html>
<html lang="en" ng-app="admin">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Trang quản trị</title>
        <link href="/assets/admin/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="/js/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="/js/toastr/toastr.min.css" rel="stylesheet" type="text/css">
        <style>
            .paginate{
                display: flex;
                justify-content: center;
                width: 100%;
            }
        </style>
        @yield('css')
    </head>
    <body class="sb-nav-fixed" >
        <!-- header -->
        @include('includes.header')
        <div id="layoutSidenav">
            <!-- sidebar -->
            @include('includes.sidebar')
            <div id="layoutSidenav_content">
                <!-- content -->
                @yield('content')
                <!-- footer -->
                @include('includes.footer')
            </div>
        </div>
        <script src="/assets/admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/assets/admin/js/datatables-simple-demo.js"></script>
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/jquery-ui/jquery-ui.js"></script>
        <script src="/assets/admin/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/toastr/toastr.min.js"></script>
        <script src="/js/angular.min.js"></script>
        <script src="/js/angular-chart.min.js"></script>
        <script src="/js/ui-bootstrap-tpls-3.0.6.min.js"></script>
        <script src="/assets/admin/js/main.js"></script>
        @yield('js')
    </body>
</html>
