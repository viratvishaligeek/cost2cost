  <footer class="site-footer style-1">
      <div class="footer-top">
          <div class="container">
              <div class="row">
                  <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                      <div class="widget widget_about me-2">
                          <div class="footer-logo logo-white">
                              <a href="index.html"><img src="{{ URL::asset('frontend') }}/images/logo.svg"
                                      alt=""></a>
                          </div>
                          <ul class="widget-address">
                              <li>
                                  <p><span>Address</span> : 451 Wall Street, UK, London</p>
                              </li>
                              <li>
                                  <p><span>E-mail</span> : example@info.com</p>
                              </li>
                              <li>
                                  <p><span>Phone</span> : 8989898989</p>
                              </li>
                          </ul>
                          <div class="subscribe_widget">
                              <h6 class="title fw-medium text-capitalize">subscribe to our newsletter</h6>
                              <form class="dzSubscribe style-1" action="" method="post">
                                  <div class="dzSubscribeMsg"></div>
                                  <div class="form-group">
                                      <div class="input-group mb-0">
                                          <input name="dzEmail" required="required" type="email" class="form-control"
                                              placeholder="Your Email Address">
                                          <div class="input-group-addon">
                                              <button name="submit" value="Submit" type="submit" class="btn">
                                                  <i class="icon feather icon-arrow-right"></i>
                                              </button>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.2s">
                      <div class="widget widget_post">
                          <h5 class="footer-title">Recent Posts</h5>
                          <ul>
                              <li>
                                  <div class="dz-media">
                                      <img src="{{ URL::asset('frontend') }}/images/shop/product/small/1.png"
                                          alt="">
                                  </div>
                                  <div class="dz-content">
                                      <h6 class="name"><a href="">Cozy Knit Cardigan
                                              Sweater</a></h6>
                                      <span class="time">July 23, 2024</span>
                                  </div>
                              </li>
                              <li>
                                  <div class="dz-media">
                                      <img src="{{ URL::asset('frontend') }}/images/shop/product/small/2.png"
                                          alt="">
                                  </div>
                                  <div class="dz-content">
                                      <h6 class="name"><a href="">Sophisticated Swagger
                                              Suit</a></h6>
                                      <span class="time">July 23, 2024</span>
                                  </div>
                              </li>
                              <li>
                                  <div class="dz-media">
                                      <img src="{{ URL::asset('frontend') }}/images/shop/product/small/3.png"
                                          alt="">
                                  </div>
                                  <div class="dz-content">
                                      <h6 class="name"><a href="">Athletic Mesh Sports
                                              Leggings</a></h6>
                                      <span class="time">July 23, 2024</span>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-2 col-md-4 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.3s">
                      <div class="widget widget_services">
                          <h5 class="footer-title">Our Stores</h5>
                          <ul>
                              <li><a href="">New York</a></li>
                              <li><a href="">London SF</a></li>
                              <li><a href="">Edinburgh</a></li>
                              <li><a href="">Los Angeles</a></li>
                              <li><a href="">Chicago</a></li>
                              <li><a href="">Las Vegas</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-2 col-md-4 col-sm-4 col-6 wow fadeInUp" data-wow-delay="0.4s">
                      <div class="widget widget_services">
                          <h5 class="footer-title">Useful Links</h5>
                          <ul>
                              <li><a href="">Privacy Policy</a></li>
                              <li><a href="">Returns</a></li>
                              <li><a href="">Terms & Conditions</a></li>
                              <li><a href="">Contact Us</a></li>
                              <li><a href="">Latest News</a></li>
                              <li><a href="">Our Sitemap</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-xl-2 col-md-4 col-sm-4 wow fadeInUp" data-wow-delay="0.5s">
                      <div class="widget widget_services">
                          <h5 class="footer-title">Footer Menu</h5>
                          <ul>
                              <li><a href="">Instagram profile</a></li>
                              <li><a href="">New Collection</a></li>
                              <li><a href="">Woman Dress</a></li>
                              <li><a href="">Contact Us</a></li>
                              <li><a href="">Latest News</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer-bottom">
          <div class="container">
              <div class="row fb-inner wow fadeInUp" data-wow-delay="0.1s">
                  <div class="col-lg-6 col-md-12 text-start">
                      <p class="copyright-text">© <span class="current-year">{{ date('Y') }}</span> <a
                              href="">Cost2Cost Supplements</a>. All Rights Reserved.</p>
                  </div>
                  <div class="col-lg-6 col-md-12 text-end">
                      <div
                          class="d-flex align-items-center justify-content-center justify-content-md-center justify-content-xl-end">
                          <span class="me-3">We Accept: </span>
                          <img src="{{ URL::asset('frontend') }}/images/footer-img.png" alt="">
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>
