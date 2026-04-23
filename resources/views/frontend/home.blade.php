@extends('frontend.include.layout')
@section('content')
    <div class="main-slider-wrapper">
        <div class="slider-inner">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slider-main">
                        <div class="slick-slide">
                            <div class="content-info">
                                <h1 class="title">Beautiful Woman Purple Sweater.</h1>
                                <div class="swiper-meta-items">
                                    <div class="meta-content">
                                        <span class="price-name">Price</span>
                                        <span class="price-num d-inline-block">&#036;80.00</span>
                                    </div>
                                </div>
                                <div class="content-btn m-b30">
                                    <a href="" class="btn btn-secondary me-xl-3 me-2 btnhover20">ADD
                                        TO CART</a>
                                    <a href="" class="btn btn-outline-secondary btnhover20">VIEW
                                        DETAIL </a>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="content-info">
                                <h1 class="title">Shot Slad Curly Woman.</h1>
                                <div class="swiper-meta-items">
                                    <div class="meta-content">
                                        <span class="price-name">Price</span>
                                        <span class="price-num d-inline-block">&#036;30.00</span>
                                    </div>
                                </div>
                                <div class="content-btn m-b30">
                                    <a href="" class="btn btn-secondary me-xl-3 me-2 btnhover20">ADD
                                        TO CART</a>
                                    <a href="" class="btn btn-outline-secondary btnhover20">VIEW
                                        DETAIL </a>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="content-info">
                                <h1 class="title">Beautiful Woman Purple Sweater.</h1>
                                <div class="swiper-meta-items">
                                    <div class="meta-content">
                                        <span class="price-name">Price</span>
                                        <span class="price-num d-inline-block">&#036;80.00</span>
                                    </div>
                                </div>
                                <div class="content-btn m-b30">
                                    <a href="" class="btn btn-secondary me-xl-3 me-2 btnhover20">ADD
                                        TO CART</a>
                                    <a href="" class="btn btn-outline-secondary btnhover20">VIEW
                                        DETAIL </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slider-thumbs">
                        <div class="slick-slide">
                            <div class="banner-media" data-name="Winter">
                                <div class="img-preview">
                                    <img src="{{ URL::asset('frontend') }}/images/banner/banner-media.png"
                                        alt="banner-media">
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="banner-media" data-name="Summer">
                                <div class="img-preview">
                                    <img src="{{ URL::asset('frontend') }}/images/banner/banner-media2.png"
                                        alt="banner-media">
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="banner-media" data-name="Winter">
                                <div class="img-preview">
                                    <img src="{{ URL::asset('frontend') }}/images/banner/banner-media.png"
                                        alt="banner-media">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-content align-items-end wow fadeInUp" data-wow-delay="1.0s">
                <i class="igk-asterisk" style="color: black; font-size: 76px"></i>
                <div>
                    <span class="sub-title">Summer Collection</span>
                    <h4 class="title">Trendy and Classic for the New Season</h4>
                </div>
            </div>
            <i class="igk-sun star-1" style="font-size: 90px;"></i>
            <i class="igk-star star-2" style="font-size: 90px; color: black;"></i>

            <a class="animation-btn popup-youtube" href="https://www.youtube.com/watch?v=1111111111">
                <div class="text-row word-rotate-box c-black">
                    <span class="word-rotate"> More Collection Explore </span>
                    <i class="fa-solid fa-play text-dark badge__emoji"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- Shop Section Start -->
    <section class="shop-section overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 left-box">
                    <div class="swiper swiper-shop">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/1.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shirts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="shop-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/clothes/2.png"
                                            alt="image">
                                    </div>
                                    <h6 class="product-name"><a href="">Shorts</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="icon-button" href="">
                        <div class="text-row word-rotate-box c-black border-secondary">
                            <span class="word-rotate">More Collection Explore </span>
                            <i class="igk-arrow-left badge__emoji" style="color:black;font-size: 50px"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 right-box">
                    <div>
                        <h3 class="title wow fadeInUp" data-wow-delay="1.2s">Featured Categories</h3>
                        <p class="text wow fadeInUp" data-wow-delay="1.4s">Discover the most trending
                            products in Pixio.</p>
                        <div class="pagination-align wow fadeInUp" data-wow-delay="1.6s">
                            <div class="shop-button-prev">
                                <i class="igk-arrow-left" style="color:black;font-size: 35px"></i>
                            </div>
                            <div class="shop-button-next">
                                <i class="igk-arrow-right" style="color:white;font-size: 35px"></i>
                            </div>
                        </div>
                    </div>
                    <a class="icon-button" href="">
                        <div class="text-row word-rotate-box c-black border-white">
                            <span class="word-rotate">More Collection Explore </span>
                            <i class="igk-arrow-left badge__emoji" style="color:black;font-size: 50px"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- About Section Start -->
    <section class="content-inner overflow-hidden">
        <div class="container">
            <div class="row about-style1">
                <div class="col-lg-6 col-md-12 m-b30">
                    <div class="about-thumb wow fadeInUp  position-relative" data-wow-delay="0.2s">
                        <div class="dz-media h-100">
                            <img src="{{ URL::asset('frontend') }}/images/women.png" alt="">
                        </div>
                        <a href="" class="btn btn-outline-secondary btn-light btn-xl">Woman
                            collection</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 align-self-center">
                    <div class="about-content">
                        <div class="section-head style-1 wow fadeInUp" data-wow-delay="0.4s">
                            <h3 class="title ">Set your wardrobe with our amazing selection!</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the</p>
                        </div>
                        <a class="service-btn-2 wow fadeInUp" data-wow-delay="0.6s" href="">
                            <i class="igk-arrow-right-up icon-wrapper" style="color:black;font-size: 50px"></i>
                        </a>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop-card style-6 wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/1.png"
                                            alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <a href="" class="btn btn-outline-secondary btn-light btn-md">Child
                                            Fashion</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop-card style-6 wow fadeInUp" data-wow-delay="1.0s">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/2.png"
                                            alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <a href="" class="btn btn-outline-secondary btn-light btn-md">Man
                                            collection</a>
                                    </div>
                                    <span class="sale-badge">50%<br>Sale <img
                                            src="{{ URL::asset('frontend') }}/images/star.png" alt=""></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Dz Silder Start -->
    <section class="content-inner-3 overflow-hidden">
        <div class="dz-features-wrapper overflow-hidden">
            <ul class="dz-features text-wrapper">
                <li class="item">
                    <h2 class="title">Jacket</h2>
                </li>
                <li class="item">
                    <i class="igk-ninja-blade" style="color:#000;font-size: 60px"></i>
                </li>
                <li class="item">
                    <h2 class="title">Jeans</h2>
                </li>
                <li class="item">
                    <i class="igk-ninja-blade" style="color:#000;font-size: 60px"></i>
                </li>
            </ul>
        </div>
    </section>
    <!-- Dz Silder End -->

    <!-- Products Section Start -->
    <section class="content-inner">
        <div class="container">
            <div class=" row justify-content-md-between align-items-start">
                <div class="col-lg-6 col-md-12">
                    <div class="section-head style-1 m-b30  wow fadeInUp" data-wow-delay="0.2s">
                        <div class="left-content">
                            <h2 class="title">Most popular products</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="site-filters clearfix style-1 align-items-center wow fadeInUp ms-lg-auto"
                        data-wow-delay="0.4s">
                        <ul class="filters" data-bs-toggle="buttons">
                            <li class="btn active">
                                <input type="radio">
                                <a href="javascript:void(0);">ALL</a>
                            </li>
                            <li data-filter=".Dresses" class="btn">
                                <input type="radio">
                                <a href="javascript:void(0);">Dresses</a>
                            </li>
                            <li data-filter=".Tops" class="btn">
                                <input type="radio">
                                <a href="javascript:void(0);">Tops</a>
                            </li>
                            <li data-filter=".Outerwear" class="btn">
                                <input type="radio">
                                <a href="javascript:void(0);">Outerwear</a>
                            </li>
                            <li data-filter=".Jacket" class="btn">
                                <input type="radio">
                                <a href="javascript:void(0);">Jacket</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <ul id="masonry" class="row g-xl-4 g-3">
                    @foreach ($product as $item)
                        <li class="card-container col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 Tops wow fadeInUp"
                            data-wow-delay="0.6s">
                            <div class="shop-card">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product/1.png" alt="image">
                                    <div class="shop-meta">
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-md btn-rounded"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-eye d-md-none d-block"></i>
                                            <span class="d-md-block d-none">Quick View</span>
                                        </a>
                                        <a href="" class="btn btn-primary meta-icon dz-wishicon">
                                            <i class="icon feather icon-heart dz-heart"></i>
                                            <i class="icon feather icon-heart-on dz-heart-fill"></i>
                                        </a>
                                        <a href="" class="btn btn-primary meta-icon dz-carticon">
                                            <i class="flaticon flaticon-basket"></i>
                                            <i class="flaticon flaticon-basket-on dz-heart-fill"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a
                                            href="{{ route('product.show', $item->slug) }}">{{ $item->name }}</a>
                                    </h5>
                                    <h5 class="price">$80</h5>
                                </div>
                                <div class="product-tag">
                                    <span class="badge ">Get 20% Off</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- Products Section Start -->

    <!-- Collection Section Start -->
    <section class="adv-area">
        <div class="container-fluid px-0">
            <div class="row product-style2 g-0">
                <div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-box style-4">
                        <div class="product-media" style="background-image: url('images/shop/large/product1.png');">
                        </div>
                        <div class="sale-box">
                            <div class="badge style-1 mb-1">Sale Up to 50% Off</div>
                            <h2 class="sale-name">Summer<span>2024</span></h2>
                            <a href="" class="btn btn-outline-secondary btn-lg text-uppercase">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="product-box style-4">
                        <div class="product-media" style="background-image: url('images/shop/large/product2.png');">
                        </div>
                        <div class="product-content">
                            <div class="main-content">
                                <div class="badge style-1 mb-3">Sale Up to 50% Off</div>
                                <h2 class="product-name">New Summer Collection</h2>
                            </div>
                            <a href="" class="btn btn-secondary btn-lg text-uppercase">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Collection Section End -->

    <!-- About Section Start -->
    <section class="content-inner-2 overflow-hidden">
        <div class="container">
            <div class="row  align-items-xl-center align-items-start">
                <div class=" col-lg-5 col-md-12 m-b30 align-self-center">
                    <div class="dz-media style-1 img-ho1 wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{ URL::asset('frontend') }}/images/about/pic3.jpg" alt="image">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="section-head style-1 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="left-content">
                                    <h2 class="title">Users Who Viewed This Also Checked Out These Similar
                                        Profiles</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 text-md-end wow fadeInUp" data-wow-delay="0.6s">
                            <a class="icon-button d-md-block d-none ms-md-auto m-b30" href="">
                                <div class="text-row word-rotate-box c-black">
                                    <span class="word-rotate">all products - all products - </span>
                                    <i class="igk-arrow-left badge__emoji"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 m-b15">
                            <div class="shop-card style-5 wow fadeInUp" data-wow-delay="0.8s">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product-2/1.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <div>
                                        <span class="sale-title">up to 79% off</span>
                                        <h6 class="title"><a href="">Cozy Knit Cardigan
                                                Sweater</a></h6>
                                    </div>
                                    <h6 class="price">
                                        $80
                                        <del>$95</del>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 m-b15">
                            <div class="shop-card style-5 wow fadeInUp" data-wow-delay="1.0s">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product-2/2.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <div>
                                        <span class="sale-title">up to 79% off</span>
                                        <h6 class="title"><a href="">Sophisticated Swagger
                                                Suit</a></h6>
                                    </div>
                                    <h6 class="price">
                                        $80
                                        <del>$95</del>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- About Section -->
    <section class="content-inner overflow-hidden p-b0">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 col-md-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                            <div class="shop-card style-3 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product-2/1.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <div>
                                        <span class="sale-title">up to 79% off</span>
                                        <h6 class="title"><a href="">Cozy Knit Cardigan
                                                Sweater</a></h6>
                                    </div>
                                    <h6 class="price">
                                        $80
                                        <del>$95</del>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                            <div class="shop-card style-3 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product-2/2.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <div>
                                        <span class="sale-title text-success">Free delivery</span>
                                        <h6 class="title"><a href="">Sophisticated Swagger
                                                Suit</a></h6>
                                    </div>
                                    <h6 class="price">
                                        $80
                                        <del>$95</del>
                                    </h6>
                                </div>
                                <span class="sale-badge">50%<br>Sale <img
                                        src="{{ URL::asset('frontend') }}/images/star.png" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 m-b30">
                    <div class="about-box style-1  clearfix h-100 right">
                        <div class="dz-media h-100">
                            <img src="{{ URL::asset('frontend') }}/images/about/pic1.jpg" alt="">
                            <div class="media-contant">
                                <h2 class="title">Great saving on everyday essentials</h2>
                                <h5 class="sub-title">Up to 60% off + up to $107 Cashback</h5>
                                <a href="" class="btn btn-white btn-lg">See All</a>
                            </div>
                            <svg class="title animation-text" viewBox="0 0 1320 300">
                                <text x="0" y="">Great saving</text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->

    <!-- Map Area Start-->
    <section class="content-inner-3 overflow-hidden " id="Maping">
        <div class="container-fluid p-0">
            <div class="row align-items-start">
                <div class="col-xl-7 col-lg-12 col-md-12">
                    <div class="map-area">
                        <img src="{{ URL::asset('frontend') }}/images/map/map2.png" alt="image">
                        <div class="map-line" id="map-line"><img
                                src="{{ URL::asset('frontend') }}/images/map/map-line.png" alt="image">
                        </div>
                        <div class="loction-b wow" data-wow-delay="0.2s">
                            <i class="igk-map-b" style="font-size: 50px"></i>
                        </div>
                        <div class="loction-center wow fadeInUp" data-wow-delay="1.0s">
                            <i class="igk-map-km" style="font-size: 50px"></i>
                        </div>
                        <div class="loction-a wow" data-wow-delay="1.2s">
                            <i class="igk-map-a" style="font-size: 50px"></i>
                        </div>

                        <div class="area-box1 wow" data-wow-delay="1.4s">
                            <div class="shop-card style-7 ">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/3.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="">Cozy Knit Cardigan
                                            Sweater</a></h5>
                                    <span class="sale-title">up to 79% off</span>
                                </div>
                            </div>
                        </div>
                        <div class="area-box2 wow" data-wow-delay="1.6s">
                            <div class="shop-card style-7 ">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/4.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="">Sophisticated Swagger
                                            Suit</a></h5>
                                    <span class="sale-title">up to 79% off</span>
                                </div>
                            </div>
                        </div>
                        <div class="area-box3 wow" data-wow-delay="1.8s">
                            <div class="shop-card style-7 ">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/5.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <h5 class="title"><a href="">Classic Denim Skinny
                                            Jeans</a></h5>
                                    <span class="sale-title">up to 79% off</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12 col-md-12 custom-width">
                    <div class="section-head style-1 wow fadeInUp d-lg-flex align-items-end justify-content-between"
                        data-wow-delay="0.1s">
                        <div class="left-content">
                            <h2 class="title">Discovering the Hottest Nearby Destinations in Your Area</h2>
                            <p class="text-capitalize text-secondary m-0">Up to 60% off + up to $107 Cashback
                            </p>
                        </div>
                        <a href="" class="text-secondary font-14 d-flex align-items-center gap-1 m-b15">See
                            All
                            <i class="icon feather icon-chevron-right font-18"></i>
                        </a>
                    </div>
                    <div class="swiper swiper-shop2 swiper-visible">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="0.1s">
                                <div class="shop-card style-7 ">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/3.png"
                                            alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h5 class="title"><a href="">Cardigan Sweater</a>
                                        </h5>
                                        <span class="sale-title text-success">up to 79% off</span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="0.2s">
                                <div class="shop-card style-7 ">
                                    <div class="dz-media">
                                        <img src="{{ URL::asset('frontend') }}/images/shop/product/medium/4.png"
                                            alt="image">
                                    </div>
                                    <div class="dz-content">
                                        <h5 class="title"><a href="">Swagger Suit</a></h5>
                                        <span class="sale-title">up to 79% off</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blockbuster deal Start -->
    <section class="content-inner-2 overflow-hidden">
        <div class="container">
            <div class="section-head style-1 wow fadeInUp d-lg-flex justify-content-between" data-wow-delay="0.2s">
                <div class="left-content">
                    <h2 class="title">Blockbuster deals</h2>
                </div>
                <a href="" class="text-secondary font-14 d-flex align-items-center gap-1">See
                    all deals
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
            <div class="swiper swiper-four swiper-visible">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-card style-2 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="dz-media">
                                <img src="{{ URL::asset('frontend') }}/images/shop/product/shart/1.png" alt="image">
                            </div>
                            <div class="dz-content">
                                <div>
                                    <span class="sale-title">up to 79% off</span>
                                    <h5 class="title"><a href="">Printed Spread Collar Casual
                                            Shirt</a></h5>
                                </div>
                                <h6 class="price">
                                    $80
                                    <del>$95</del>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-card style-2 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="dz-media">
                                <img src="{{ URL::asset('frontend') }}/images/shop/product/shart/2.png" alt="image">
                            </div>
                            <div class="dz-content">
                                <div>
                                    <span class="sale-title">up to 79% off</span>
                                    <h5 class="title"><a href="">Checkered Slim Collar Casual
                                            Shirt</a></h5>
                                </div>
                                <h6 class="price">
                                    $80
                                    <del>$95</del>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blockbuster deal Start -->

    <!-- Offer Section Start -->
    <section class="content-inner-2">
        <div class="container">
            <div class="section-head style-1 wow fadeInUp d-flex justify-content-between m-b30" data-wow-delay="0.2s">
                <div class="left-content">
                    <h2 class="title">Featured offer for you</h2>
                </div>
                <a href="" class="text-secondary font-14 d-flex align-items-center gap-1">See
                    All
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
        </div>
        <div class="container-fluid px-3">
            <div class="swiper swiper-product">
                <div class="swiper-wrapper product-style2">
                    <div class="swiper-slide">
                        <div class="product-box style-2 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="product-media" style="background-image: url('images/clothes/1.png');"></div>
                            <div class="product-content">
                                <div class="main-content">
                                    <span class="offer">20% Off</span>
                                    <h2 class="product-name">Luxury Bras</h2>
                                    <a href="" class="btn btn-outline-secondary btn-rounded btn-lg">Collect
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product End -->

    <!-- Featured Section Start -->
    <section class="content-inner  overflow-hidden">
        <div class="container">
            <div class="section-head style-1 wow fadeInUp d-flex justify-content-between" data-wow-delay="0.2s">
                <div class="left-content">
                    <h2 class="title">Featured now </h2>
                </div>
                <a href="" class="text-secondary font-14 d-flex align-items-center gap-1">See All
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
            <div class="swiper swiper-product2 swiper-visible ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="dz-media">
                                <img src="{{ URL::asset('frontend') }}/images/shop/product/1.png" alt="image">
                            </div>
                            <div class="dz-content">
                                <div>
                                    <h6 class="title"><a href="">Cozy Knit Cardigan
                                            Sweater</a></h6>
                                    <span class="sale-title">Up to 40% Off</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="price">$80<del>$95</del></h6>
                                    <span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-card style-4 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="dz-media">
                                <img src="{{ URL::asset('frontend') }}/images/shop/product/2.png" alt="image">
                            </div>
                            <div class="dz-content">
                                <div>
                                    <h6 class="title"><a href="">Sophisticated Swagger
                                            Suit</a></h6>
                                    <span class="sale-title">Up to 40% Off</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="price">$80<del>$95</del></h6>
                                    <span class="review"><i class="fa-solid fa-star"></i>(2k Review)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- About Section -->
    <section class="content-inner overflow-hidden p-b0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 m-b30">
                    <div class="about-box style-1 wow fadeInUp  clearfix h-100" data-wow-delay="0.2s">
                        <div class="dz-media h-100">
                            <img src="{{ URL::asset('frontend') }}/images/about/pic2.jpg" alt="">
                            <div class="media-contant">
                                <h2 class="title">Recent Additions to Your Shortlist</h2>
                                <a href="" class="btn btn-white">Shop Now</a>
                            </div>
                            <svg class="title animation-text" viewBox="0 0 1320 300">
                                <text x="0" y="">Shortlist</text>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                            <div class="shop-card style-3 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product-2/1.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <div>
                                        <span class="sale-title">up to 79% off</span>
                                        <h6 class="title"><a href="">Cozy Knit Cardigan
                                                Sweater</a></h6>
                                    </div>
                                    <h6 class="price">
                                        $80
                                        <del>$95</del>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                            <div class="shop-card style-3 wow fadeInUp" data-wow-delay="0.6s">
                                <div class="dz-media">
                                    <img src="{{ URL::asset('frontend') }}/images/shop/product-2/2.png" alt="image">
                                </div>
                                <div class="dz-content">
                                    <div>
                                        <span class="sale-title">up to 79% off</span>
                                        <h6 class="title"><a href="">Sophisticated Swagger
                                                Suit</a></h6>
                                    </div>
                                    <h6 class="price">
                                        $80
                                        <del>$95</del>
                                    </h6>
                                </div>
                                <span class="sale-badge">50%<br>Sale <img
                                        src="{{ URL::asset('frontend') }}/images/star.png" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->

    <!-- company-box Start -->
    <section class="content-inner-2">
        <div class="container">
            <div class="section-head style-1 wow fadeInUp d-flex  justify-content-between" data-wow-delay="0.2s">
                <div class="left-content">
                    <h2 class="title">Sponsored</h2>
                </div>
                <a href="" class="text-secondary font-14 d-flex align-items-center gap-1">See
                    All
                    <i class="icon feather icon-chevron-right font-18"></i>
                </a>
            </div>
            <div class="swiper swiper-company">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="company-box style-1 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="dz-media">
                                <img src="{{ URL::asset('frontend') }}/images/company/1.jpg" alt="image"
                                    class="company-img">
                                <img src="{{ URL::asset('frontend') }}/images/company/logo/logo1.png" alt="image"
                                    class="logo">
                            </div>
                            <div class="dz-content">
                                <h6 class="title">Outdoor Shoes </h6>
                                <span class="sale-title">Min. 30% Off</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="company-box style-1 wow fadeInUp" data-wow-delay="1.4s">
                            <div class="dz-media">
                                <img src="{{ URL::asset('frontend') }}/images/company/2.jpg" alt="image"
                                    class="company-img">
                                <img src="{{ URL::asset('frontend') }}/images/company/logo/logo2.png" alt="image"
                                    class="logo">
                                <span class="sale-badge">in Store</span>
                            </div>
                            <div class="dz-content">
                                <h6 class="title">Best Cloths</h6>
                                <span class="sale-title">Up To 20% Off</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- company-box End -->

    <!-- Blog Start -->
    <section class="content-inner-3 overflow-hidden p-b0">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="section-head style-2 m-0 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="left-content">
                            <h2 class="title">Discover the most trending Post in Pixio.</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 text-md-end m-b30 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="icon-button d-md-inline-block d-none" href="">
                        <div class="text-row word-rotate-box c-black">
                            <span class="word-rotate">latest news - latest news -</span>
                            <i class="fas fa-arrow-right badge__emoji"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="swiper swiper-blog-post">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="dz-media">
                            <img src="{{ URL::asset('frontend') }}/images/blog/grid/1.jpg" alt="">
                            <div class="post-date">17 May 2024</div>
                        </div>
                        <div class="dz-info">
                            <h4 class="dz-title mb-0">
                                <a href="">Style
                                    Diaries: A Week in Fashion</a>
                            </h4>
                            <ul class="blog-social">
                                <li>
                                    <a class="share-btn" href="javascript:void(0);">
                                        <i class="icon feather icon-arrow-up-right text-black"></i>
                                    </a>
                                    <ul class="sub-team-social">
                                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i
                                                    class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.linkedin.com/" target="_blank"><i
                                                    class="fa-brands fa-linkedin-in"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="dz-media">
                            <img src="{{ URL::asset('frontend') }}/images/blog/grid/1.jpg" alt="">
                            <div class="post-date">17 May 2024</div>
                        </div>
                        <div class="dz-info">
                            <h4 class="dz-title mb-0">
                                <a href="">Style
                                    Diaries: A Week in Fashion</a>
                            </h4>
                            <ul class="blog-social">
                                <li>
                                    <a class="share-btn" href="javascript:void(0);">
                                        <i class="icon feather icon-arrow-up-right text-black"></i>
                                    </a>
                                    <ul class="sub-team-social">
                                        <li><a href="https://www.facebook.com/" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/" target="_blank"><i
                                                    class="fab fa-twitter"></i></a></li>
                                        <li><a href="https://www.instagram.com/" target="_blank"><i
                                                    class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.linkedin.com/" target="_blank"><i
                                                    class="fa-brands fa-linkedin-in"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog End -->

    <!-- collection-bx -->
    <section class="collection-bx content-inner-3 overflow-hidden">
        <div class="container">
            <h2 class="title wow fadeInUp" data-wow-delay="0.2s">Upgrade your style with our top-notch
                collection.</h2>
            <div class="text-center">
                <a href="" class="btn btn-secondary btn-lg wow fadeInUp m-b30" data-wow-delay="0.4s">All
                    Collections</a>
            </div>
        </div>
        <div class="collection1"><img src="{{ URL::asset('frontend') }}/images/collection/1.png" alt="">
        </div>
        <div class="collection2"><img src="{{ URL::asset('frontend') }}/images/collection/2.png" alt="">
        </div>
        <div class="collection3"><img src="{{ URL::asset('frontend') }}/images/collection/3.png" alt="">
        </div>
        <div class="collection4"><img src="{{ URL::asset('frontend') }}/images/collection/4.png" alt="">
        </div>
        <div class="collection5"><img src="{{ URL::asset('frontend') }}/images/collection/5.png" alt="">
        </div>
    </section>
    <!-- collection-bx -->
@endsection
