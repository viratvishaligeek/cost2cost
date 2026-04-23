@if (request()->is('/'))
    <header class="site-header mo-left header style-1 header-transparent">
    @else
        <header class="site-header mo-left header border-bottom">
@endif
<!-- Main Header Start -->
<div class="sticky-header main-bar-wraper navbar-expand-lg">
    <div class="main-bar clearfix">
        <div class="container-fluid clearfix d-lg-flex d-block">
            <div class="logo-header logo-dark me-md-5">
                <a href=""><img src="{{ URL::asset('frontend') }}/images/logo.svg" alt="logo"></a>
            </div>
            <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="header-nav w3menu navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                <div class="logo-header logo-dark">
                    <a href=""><img src="{{ URL::asset('frontend') }}/images/logo.svg" alt=""></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="auto-width menu-left">
                        <a href="javascript:void(0);"><span>Home</span></a>
                    </li>
                    <li class="has-mega-menu sub-menu-down">
                        <a href="javascript:void(0);"><span>Shop</span><i class="fas fa-chevron-down tabindex"></i></a>
                        <div class="mega-menu shop-menu">
                            <ul>
                                <li class="side-left">
                                    <ul>
                                        <li><a href="javascript:void(0);" class="menu-title">Shop
                                                Structure</a>
                                            <ul>
                                                <li><a href="">Shop Standard</a></li>
                                                <li><a href="">Shop List</a></li>
                                                <li><a href="">Shop Style 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);" class="menu-title">Shop
                                                Structure</a>
                                            <ul>
                                                <li><a href="">Shop Standard</a></li>
                                                <li><a href="">Shop List</a></li>
                                                <li><a href="">Shop Style 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);" class="menu-title">Shop
                                                Structure</a>
                                            <ul>
                                                <li><a href="">Shop Standard</a></li>
                                                <li><a href="">Shop List</a></li>
                                                <li><a href="">Shop Style 2</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);" class="menu-title">Shop
                                                Structure</a>
                                            <ul>
                                                <li><a href="">Shop Standard</a></li>
                                                <li><a href="">Shop List</a></li>
                                                <li><a href="">Shop Style 2</a></li>
                                            </ul>
                                        </li>
                                        <li class="month-deal">
                                            <div class="clearfix me-3">
                                                <h3>Deal of the month</h3>
                                                <p class="mb-0">Yes! Send me exclusive offers,
                                                    personalised, and unique gift ideas, tips for shopping
                                                    on Pixio <a href="" class="dz-link-2">View
                                                        All Products</a></p>
                                            </div>
                                            <div class="sale-countdown">
                                                <div class="countdown text-center">
                                                    <div class="date">
                                                        <span class="time days text-primary"></span>
                                                        <span class="work-time">Days</span>
                                                    </div>
                                                    <div class="date">
                                                        <span class="time hours text-primary"></span>
                                                        <span class="work-time">Hours</span>
                                                    </div>
                                                    <div class="date">
                                                        <span class="time mins text-primary"></span>
                                                        <span class="work-time">Minutess</span>
                                                    </div>
                                                    <div class="date">
                                                        <span class="time secs text-primary"></span>
                                                        <span class="work-time">Second</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="side-right">
                                    <div class="adv-media">
                                        <img src="{{ URL::asset('frontend') }}/images/adv-1.png" alt="/">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="dz-social-icon">
                    <ul>
                        <li><a class="fab fa-facebook-f" target="_blank" href=""></a></li>
                        <li><a class="fab fa-twitter" target="_blank" href=""></a></li>
                        <li><a class="fab fa-linkedin-in" target="_blank" href=""></a></li>
                        <li><a class="fab fa-instagram" target="_blank" href=""></a></li>
                    </ul>
                </div>
            </div>

            <!-- EXTRA NAV -->
            <div class="extra-nav">
                <div class="extra-cell">
                    <ul class="header-right">
                        <li class="nav-item login-link">
                            <a class="nav-link" href="">
                                Login / Register
                            </a>
                        </li>
                        <li class="nav-item search-link">
                            <a class="nav-link" href="javascript:void(0);" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                                <i class="iconly-Light-Search"></i>
                            </a>
                        </li>
                        <li class="nav-item wishlist-link">
                            <a class="nav-link" href="javascript:void(0);" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="iconly-Light-Heart2"></i>
                            </a>
                        </li>
                        <li class="nav-item cart-link">
                            <a href="javascript:void(0);" class="nav-link cart-btn" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="iconly-Broken-Buy"></i>
                                <span class="badge badge-circle">5</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Header End -->

<!-- SearchBar -->
<div class="dz-search-area dz-offcanvas offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
        &times;
    </button>
    <div class="container">
        <form class="header-item-search">
            <div class="input-group search-input">
                <input type="search" class="form-control" placeholder="Search Product">
                <button class="btn" type="button">
                    <i class="iconly-Light-Search"></i>
                </button>
            </div>
            <ul class="recent-tag">
                <li class="pe-0"><span>Quick Search :</span></li>
                <li><a href="">Clothes</a></li>
                <li><a href="">UrbanSkirt</a></li>
            </ul>
        </form>
        <div class="row">
            <div class="col-xl-12">
                <h5 class="mb-3">You May Also Like</h5>
                <div class="swiper category-swiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="shop-card">
                                <div class="dz-media ">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product/1.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <h6 class="title"><a href="">SilkBliss Dress</a></h6>
                                    <h6 class="price">$40.00</h6>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="shop-card">
                                <div class="dz-media ">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product/4.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <h6 class="title"><a href="">SilkBliss Dress</a></h6>
                                    <h6 class="price">$60.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SearchBar -->

<!-- Sidebar cart -->
<div class="offcanvas dz-offcanvas offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
        &times;
    </button>
    <div class="offcanvas-body">
        <div class="product-description">
            <div class="dz-tabs">
                <ul class="nav nav-tabs center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="shopping-cart" data-bs-toggle="tab"
                            data-bs-target="#shopping-cart-pane" type="button" role="tab"
                            aria-controls="shopping-cart-pane" aria-selected="true">Shopping Cart
                            <span class="badge badge-light">5</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="wishlist" data-bs-toggle="tab" data-bs-target="#wishlist-pane"
                            type="button" role="tab" aria-controls="wishlist-pane"
                            aria-selected="false">Wishlist
                            <span class="badge badge-light">2</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content pt-4" id="dz-shopcart-sidebar">
                    <div class="tab-pane fade show active" id="shopping-cart-pane" role="tabpanel"
                        aria-labelledby="shopping-cart" tabindex="0">
                        <div class="shop-sidebar-cart">
                            <ul class="sidebar-cart-list">
                                <li>
                                    <div class="cart-widget">
                                        <div class="dz-media me-3">
                                            <img src="{{ URL::asset('frontend') }}/images/shop/shop-cart/pic3.jpg"
                                                alt="">
                                        </div>
                                        <div class="cart-content">
                                            <h6 class="title"><a href="">Athletic
                                                    Mesh Sports Leggings</a></h6>
                                            <div class="d-flex align-items-center">
                                                <div class="btn-quantity light quantity-sm me-3">
                                                    <input type="text" value="1" name="demo_vertical2">
                                                </div>
                                                <h6 class="dz-price  mb-0">$65.00</h6>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="dz-close">
                                            <i class="ti-close"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <div class="cart-total">
                                <h5 class="mb-0">Subtotal:</h5>
                                <h5 class="mb-0">300.00$</h5>
                            </div>
                            <div class="mt-auto">
                                <div class="shipping-time">
                                    <div class="dz-icon">
                                        <i class="flaticon flaticon-ship"></i>
                                    </div>
                                    <div class="shipping-content">
                                        <h6 class="title pe-4">Congratulations , you've got free shipping!
                                        </h6>
                                        <div class="progress">
                                            <div class="progress-bar progress-animated border-0" style="width: 75%;"
                                                role="progressbar">
                                                <span class="sr-only">75% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="" class="btn btn-outline-secondary btn-block m-b20">Checkout</a>
                                <a href="" class="btn btn-secondary btn-block">View Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="wishlist-pane" role="tabpanel" aria-labelledby="wishlist"
                        tabindex="0">
                        <div class="shop-sidebar-cart">
                            <ul class="sidebar-cart-list">
                                <li>
                                    <div class="cart-widget">
                                        <div class="dz-media me-3">
                                            <img src="{{ URL::asset('frontend') }}/images/shop/shop-cart/pic3.jpg"
                                                alt="">
                                        </div>
                                        <div class="cart-content">
                                            <h6 class="title"><a href="">Athletic
                                                    Mesh Sports Leggings</a></h6>
                                            <div class="d-flex align-items-center">
                                                <h6 class="dz-price  mb-0">$65.00</h6>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="dz-close">
                                            <i class="ti-close"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-auto">
                                <a href="" class="btn btn-secondary btn-block">Check
                                    Your Favourite</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar cart -->
</header>
<!-- Header End -->
