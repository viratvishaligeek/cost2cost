<!DOCTYPE html>
<html lang="en">
@include('frontend.include.meta')

<body id="bg">
    <div class="page-wraper">

        <div id="loading-area" class="preloader-wrapper-4">
            <img src="{{ URL::asset('frontend') }}/images/loading.gif" alt="">
        </div>

        @include('frontend.include.header')
        <div class="page-content bg-light">
            @yield('content')
        </div>

        @include('frontend.include.footer')
        <button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
        <!-- Quick Modal Start -->
        <div class="modal quick-view-modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="icon feather icon-x"></i>
                    </button>
                    <div class="modal-body">
                        <div class="row g-xl-4 g-3">
                            <div class="col-xl-6 col-md-6">
                                <div class="dz-product-detail mb-0">
                                    <div class="swiper-btn-center-lr">
                                        <div class="swiper quick-modal-swiper2">
                                            <div class="swiper-wrapper" id="lightgallery">
                                                <div class="swiper-slide">
                                                    <div class="dz-media DZoomImage">
                                                        <a class="mfp-link lg-item" href="images/products/lady-1.png"
                                                            data-src="{{ URL::asset('frontend') }}/images/products/lady-1.png">
                                                            <i class="feather icon-maximize dz-maximize top-right"></i>
                                                        </a>
                                                        <img src="{{ URL::asset('frontend') }}/images/products/lady-1.png"
                                                            alt="image">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="dz-media DZoomImage">
                                                        <a class="mfp-link lg-item" href="images/products/lady-2.png"
                                                            data-src="{{ URL::asset('frontend') }}/images/products/lady-2.png">
                                                            <i class="feather icon-maximize dz-maximize top-right"></i>
                                                        </a>
                                                        <img src="{{ URL::asset('frontend') }}/images/products/lady-2.png"
                                                            alt="image">
                                                    </div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="dz-media DZoomImage">
                                                        <a class="mfp-link lg-item" href="images/products/lady-3.png"
                                                            data-src="{{ URL::asset('frontend') }}/images/products/lady-3.png">
                                                            <i class="feather icon-maximize dz-maximize top-right"></i>
                                                        </a>
                                                        <img src="{{ URL::asset('frontend') }}/images/products/lady-3.png"
                                                            alt="image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper quick-modal-swiper thumb-swiper-lg thumb-sm swiper-vertical">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="{{ URL::asset('frontend') }}/images/products/thumb-img/lady-1.png"
                                                        alt="image">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="{{ URL::asset('frontend') }}/images/products/thumb-img/lady-2.png"
                                                        alt="image">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="{{ URL::asset('frontend') }}/images/products/thumb-img/lady-3.png"
                                                        alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="dz-product-detail style-2 ps-xl-3 ps-0 pt-2 mb-0">
                                    <div class="dz-content">
                                        <div class="dz-content-footer">
                                            <div class="dz-content-start">
                                                <span class="badge bg-secondary mb-2">SALE 20% Off</span>
                                                <h4 class="title mb-1"><a href="">Cozy Knit
                                                        Cardiganddf
                                                        Sweater</a></h4>
                                                <div class="review-num">
                                                    <ul class="dz-rating me-2">
                                                        <li class="star-fill">
                                                            <i class="flaticon-star-1"></i>
                                                        </li>
                                                        <li class="star-fill">
                                                            <i class="flaticon-star-1"></i>
                                                        </li>
                                                        <li class="star-fill">
                                                            <i class="flaticon-star-1"></i>
                                                        </li>
                                                        <li>
                                                            <i class="flaticon-star-1"></i>
                                                        </li>
                                                        <li>
                                                            <i class="flaticon-star-1"></i>
                                                        </li>
                                                    </ul>
                                                    <span class="text-secondary me-2">4.7 Rating</span>
                                                    <a href="javascript:void(0);">(5 customer reviews)</a>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="para-text">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting
                                            industry.
                                            Lorem Ipsum has.
                                        </p>
                                        <div class="meta-content m-b20 d-flex align-items-end">
                                            <div class="me-3">
                                                <span class="form-label">Price</span>
                                                <span class="price">$125.75 <del>$132.17</del></span>
                                            </div>
                                            <div class="btn-quantity light me-0">
                                                <label class="form-label">Quantity</label>
                                                <input type="text" value="1" name="demo_vertical2">
                                            </div>
                                        </div>
                                        <div class=" cart-btn">
                                            <a href="" class="btn btn-secondary text-uppercase">Add To
                                                Cart</a>
                                            <a href="" class="btn btn-md btn-outline-secondary btn-icon">
                                                <i class="icon feather icon-heart"></i>
                                                Add To Wishlist
                                            </a>
                                        </div>
                                        <div class="dz-info mb-0">
                                            <ul>
                                                <li><strong>SKU:</strong></li>
                                                <li>PRT584E63A</li>
                                            </ul>
                                            <ul>
                                                <li><strong>Category:</strong></li>
                                                <li><a href="">Dresses,</a></li>
                                                <li><a href="">Jeans,</a></li>
                                                <li><a href="">Swimwear,</a></li>
                                                <li><a href="">Summer,</a></li>
                                                <li><a href="">Clothing</a></li>
                                            </ul>
                                            <ul>
                                                <li><strong>Tags:</strong></li>
                                                <li><a href="">Casual</a></li>
                                                <li><a href="">Athletic,</a></li>
                                                <li><a href="">Workwear,</a></li>
                                                <li><a href="">Accessories</a></li>
                                            </ul>
                                            <div class="dz-social-icon">
                                                <ul>
                                                    <li><a target="_blank" class="text-dark" href="">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a></li>
                                                    <li><a target="_blank" class="text-dark" href="">
                                                            <i class="fab fa-twitter"></i>
                                                        </a></li>
                                                    <li><a target="_blank" class="text-dark" href="">
                                                            <i class="fa-brands fa-youtube"></i>
                                                        </a></li>
                                                    <li><a target="_blank" class="text-dark" href="">
                                                            <i class="fa-brands fa-linkedin-in"></i>
                                                        </a></li>
                                                    <li><a target="_blank" class="text-dark" href="">
                                                            <i class="fab fa-instagram"></i>
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('frontend') }}/js/jquery.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/wow/wow.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/bootstrap-touchspin/bootstrap-touchspin.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/imagesloaded/imagesloaded.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/masonry/masonry-4.2.2.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/masonry/isotope.pkgd.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/countdown/jquery.countdown.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/wnumb/wNumb.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/nouislider/nouislider.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/slick/slick.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/lightgallery/dist/lightgallery.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js"></script>
    <script src="{{ URL::asset('frontend') }}/js/dz.carousel.js"></script>
    <script src="{{ URL::asset('frontend') }}/js/dz.ajax.js"></script>
    <script src="{{ URL::asset('frontend') }}/js/custom.min.js"></script>
    </bdy>

</html>
