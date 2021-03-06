<header class="header shop">
			<!-- Topbar -->
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
                <!-- Top Left -->
            
                <!--/ End Top Left -->
            </div>
            <div class="col-lg-8 col-md-12 col-12">
                <!-- Top Right -->
                <div class="right-content">
                    <ul class="list-main">
                        <li><i class="ti-location-pin"></i> Store location</li>
                        <li><i class="fa fa-truck"></i> <a href="/your-orders">My orders</a></li>
                        <li><i class="ti-user"></i> <a href="/login">My account</a></li>
                        <li><a href="/cart" class="single-icon"><i class="ti-bag"></i>Cart<span ng-controller="cart">(@{{carts.length}})</span></a></li>
                        <li><i class="fa fa-power-off" aria-hidden="true"></i><a href="/logout">Logout</a></li>
                    </ul>
                </div>
                <!-- End Top Right -->
            </div>
        </div>
    </div>
</div>
<!-- End Topbar -->
<div class="middle-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-12">
                <!-- Logo -->
                <div class="logo" style="margin-top: 0px;">
                    <a href="/"><img src="/upload/Logo_Ananas_Header.svg" alt="logo"></a>
                </div>
                <!--/ End Logo -->
                <!-- Search Form -->
                <div class="search-top">
                    <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                    <!-- Search Form -->
                    <div class="search-top">
                        <form class="search-form">
                            <input type="text" placeholder="Search here..." name="search">
                            <button value="search" type="submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                    <!--/ End Search Form -->
                </div>
                <!--/ End Search Form -->
                
            </div>
            <div class="col-lg-8 col-md-7 col-12">
                <div class="search-bar-top">
                    <div class="search-bar">
                        <div ng-controller="search">
                            <input name="search" placeholder="Search Products Here....." style="width:100%" ng-model="keyword">
                            <button class="btnn" ng-click="search()"><i class="ti-search" ></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-12">
                <div class="right-bar">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Inner -->
<div class="header-inner">
    <div class="container">
        <div class="cat-nav-head">
            <div class="row">
                <div class="col-12">
                    <div class="menu-area">
                        <!-- Main Menu -->
                        <nav class="navbar navbar-expand-lg">
                            <div class="navbar-collapse">	
                                <div class="nav-inner">	
                                    <ul class="nav main-menu menu navbar-nav">
                                        <li class="active"><a href="#">Home</a></li>
                                        <li><a href="#">Product</a></li>												
                                        <li><a href="#">Service</a></li>
                                        <li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
                                            <ul class="dropdown">
                                                <li><a href="shop-grid.html">Shop Grid</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Pages</a></li>									
                                        <li><a href="#">Blog<i class="ti-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <!--/ End Main Menu -->	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Header Inner -->
</header>