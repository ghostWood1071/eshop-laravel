<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="/admin" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa fa-line-chart" aria-hidden="true"></i></div>
                    Dashboard
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                </a>
                <a class="nav-link collapsed" href="/admin/category" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa fa-bars" aria-hidden="true"></i></div>
                    Category manager
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                </a>
                <a class="nav-link collapsed" href="/admin/product" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa fa-columns"></i></div>
                    Product manager
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                </a>
                <a class="nav-link collapsed" href="/admin/import" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                    Import manager
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                </a>
                <a class="nav-link collapsed" href="/admin/order" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    
                    <div class="sb-nav-link-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                    Order manager
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                </a>

                <a class="nav-link collapsed" href="/admin/user" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    
                    <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                    Staff manager
                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer" ng-controller="sidebar">
            <div class="small">Logged in as:</div>
            @{{fullname}}
        </div>
    </nav>
</div>