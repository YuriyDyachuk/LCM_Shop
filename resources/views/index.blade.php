@extends('layouts.master')

@section('content')

    <section class="heroCarousel"
             data-slick='{
            "arrows": true,
            "mobileFirst": true,
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "autoplay": true,
            "autoplaySpeed": 5000,
            "lazyLoad": "anticipated"
        }'>
        <a href="https://mylci.leanconstruction.org/">
            <div class="heroCarousel-slide  heroCarousel-slide--first">
                <div class="heroCarousel-image-wrapper" style="height: 16.875vw">
                    <img class="heroCarousel-image"
                         src="{{ asset('assets/img/carousel/Shop_LCI_static_banner4847.jpg') }}"
                         alt="" title="" width="1600" height="270" />
                </div>
            </div>
        </a>
        <a href="https://www.lcicongress.org/2020/">
            <div class="heroCarousel-slide  ">
                <div class="heroCarousel-image-wrapper" style="height: 16.875vw">
                    <img class="heroCarousel-image"
                         data-lazy="{{ asset('assets/img/carousel/lcicongress2020_one-pager_1600x270__00551.jpg') }}"
                         alt="" title="" width="1600" height="270" />
                </div>
            </div>
        </a>
        <a href="https://www.leanconstruction.org/learning/lci-e-learning/">
            <div class="heroCarousel-slide  ">
                <div class="heroCarousel-image-wrapper" style="height: 16.875vw">
                    <img class="heroCarousel-image"
                         data-lazy="{{ asset('assets/img/carousel/LCI_TVD_banner_1600x270.jpg') }}"
                         alt="" title="" width="1600" height="270" />
                </div>
            </div>
        </a>
        <a href="https://www.leanconstruction.org/learning/research/">
            <div class="heroCarousel-slide  ">
                <div class="heroCarousel-image-wrapper" style="height: 16.875vw">
                    <img class="heroCarousel-image"
                         data-lazy="{{ asset('assets/img/carousel/LCI-research.jpg') }}"
                         alt="" title="" width="1600" height="270" />
                </div>
            </div>
        </a>
        <a href="https://www.leanconstruction.org/learning/getting-started-with-lean/#lean-videos">
            <div class="heroCarousel-slide  ">
                <div class="heroCarousel-image-wrapper" style="height: 16.875vw">
                    <img class="heroCarousel-image"
                         data-lazy="{{ asset('assets/img/carousel/LCI-gswl.jpg') }}"
                         alt="" title="" width="1600" height="270" />
                </div>
            </div>
        </a>
    </section>
    <!-- snippet location home_content -->

    <div class="container">


        <div class="main full homepage">
            <h2 class="page-heading">Featured Products</h2>

            <ul class="productGrid productGrid--maxCol4" data-product-type="featured">
                <li class="product">
                    <article class="card ">
                        <figure class="card-figure">
                            <a href="individual/index.html">
                                <div class="card-img-container">
                                    <img class="card-image lazyload" data-sizes="auto"
                                         src="{{ asset('assets/img/loading.svg') }}"
                                         data-src="{{ asset('assets/img/products/IndiMembership__05641.1547237449.png') }}"
                                         alt="Individual Membership" title="Individual Membership">
                                </div>
                            </a>
                        </figure>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="individual/index.html">Individual Membership</a>
                            </h4>

                            <div class="card-text" data-test-info-type="price">

                                <div class="price-section price-section--withoutTax rrp-price--withoutTax"
                                     style="display: none;">
                                    MSRP:
                                    <span data-product-rrp-price-without-tax class="price price--rrp">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax non-sale-price--withoutTax"
                                     style="display: none;">
                                    Was:
                                    <span data-product-non-sale-price-without-tax class="price price--non-sale">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax">
                                        <span class="price-label">

                                        </span>
                                    <span class="price-now-label" style="display: none;">
                                            Now:
                                        </span>
                                    <span data-product-price-without-tax
                                          class="price price--withoutTax">$400.00</span>
                                </div>
                            </div>
                        </div>
                        <figcaption class="card-figcaption">
                            <div class="card-figcaption-body">
                                <a href="product.html" class="button button--small card-figcaption-button"
                                   data-product-id="117">View</a>
                                <a href="cart.html?action=add&amp;product_id=117"
                                   class="button button--small card-figcaption-button">Add to Cart</a>
                            </div>
                        </figcaption>
                    </article>
                </li>
                <li class="product">
                    <article class="card ">
                        <figure class="card-figure">
                            <a href="product.html">
                                <div class="card-img-container">
                                    <img class="card-image lazyload" data-sizes="auto"
                                         src="{{ asset('assets/img/loading.svg') }}"
                                         data-src="{{ asset('assets/img/products/Dont_Conform-cover__01451.1541081413.jpg') }}"
                                         alt="Don’t Conform, Transform!" title="Don’t Conform, Transform!">
                                </div>
                            </a>
                        </figure>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="product.html">Don’t Conform, Transform!</a>
                            </h4>

                            <div class="card-text" data-test-info-type="price">

                                <div class="price-section price-section--withoutTax rrp-price--withoutTax"
                                     style="display: none;">
                                    MSRP:
                                    <span data-product-rrp-price-without-tax class="price price--rrp">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax non-sale-price--withoutTax"
                                     style="display: none;">
                                    Was:
                                    <span data-product-non-sale-price-without-tax class="price price--non-sale">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax">
                                        <span class="price-label">

                                        </span>
                                    <span class="price-now-label" style="display: none;">
                                            Now:
                                        </span>
                                    <span data-product-price-without-tax
                                          class="price price--withoutTax">$48.00</span>
                                </div>
                            </div>
                        </div>
                        <figcaption class="card-figcaption">
                            <div class="card-figcaption-body">
                                <a href="product.html"
                                   class="button button--small card-figcaption-button"
                                   data-product-id="116">View</a>
                                <a href="cart.html?action=add&amp;product_id=116"
                                   class="button button--small card-figcaption-button">Add to Cart</a>
                            </div>
                        </figcaption>
                    </article>
                </li>
                <li class="product">
                    <article class="card ">
                        <figure class="card-figure">
                            <a href="product.html">
                                <div class="card-img-container">
                                    <img class="card-image lazyload" data-sizes="auto"
                                         src="{{ asset('assets/img/loading.svg') }}"
                                         data-src="{{ asset('assets/img/products/TDC-FRONTCOVER-08.08.17__00201.1540898470.jpg') }}"
                                         alt="Transforming Design and Construction: A Framework for Change"
                                         title="Transforming Design and Construction: A Framework for Change">
                                </div>
                            </a>
                        </figure>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="product.html">Transforming
                                    Design and Construction: A Framework for Change</a>
                            </h4>

                            <div class="card-text" data-test-info-type="price">

                                <div class="price-section price-section--withoutTax rrp-price--withoutTax"
                                     style="display: none;">
                                    MSRP:
                                    <span data-product-rrp-price-without-tax class="price price--rrp">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax non-sale-price--withoutTax"
                                     style="display: none;">
                                    Was:
                                    <span data-product-non-sale-price-without-tax class="price price--non-sale">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax">
                                        <span class="price-label">

                                        </span>
                                    <span class="price-now-label" style="display: none;">
                                            Now:
                                        </span>
                                    <span data-product-price-without-tax
                                          class="price price--withoutTax">$48.00</span>
                                </div>
                            </div>
                        </div>
                        <figcaption class="card-figcaption">
                            <div class="card-figcaption-body">
                                <a href="product.html"
                                   class="button button--small card-figcaption-button"
                                   data-product-id="103">View</a>
                                <a href="cart.html?action=add&amp;product_id=103"
                                   class="button button--small card-figcaption-button">Add to Cart</a>
                            </div>
                        </figcaption>
                    </article>
                </li>
                <li class="product">
                    <article class="card ">
                        <figure class="card-figure">
                            <a
                                href="product.html">
                                <div class="card-img-container">
                                    <img class="card-image lazyload" data-sizes="auto"
                                         src="{{ asset('assets/img/loading.svg') }}"
                                         data-src="{{ asset('assets/img/products/TargetValueDeliveryFrontCover08.17.__68342.1540898426.jpg') }}"
                                         alt="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016"
                                         title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">
                                </div>
                            </a>
                        </figure>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a
                                    href="product.html">Target
                                    Value Delivery: Practitioner Guidebook to Implementation – Current State
                                    2016</a>
                            </h4>

                            <div class="card-text" data-test-info-type="price">

                                <div class="price-section price-section--withoutTax rrp-price--withoutTax"
                                     style="display: none;">
                                    MSRP:
                                    <span data-product-rrp-price-without-tax class="price price--rrp">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax non-sale-price--withoutTax"
                                     style="display: none;">
                                    Was:
                                    <span data-product-non-sale-price-without-tax class="price price--non-sale">

                                        </span>
                                </div>
                                <div class="price-section price-section--withoutTax">
                                        <span class="price-label">

                                        </span>
                                    <span class="price-now-label" style="display: none;">
                                            Now:
                                        </span>
                                    <span data-product-price-without-tax
                                          class="price price--withoutTax">$48.00</span>
                                </div>
                            </div>
                        </div>
                        <figcaption class="card-figcaption">
                            <div class="card-figcaption-body">
                                <a href="product.html"
                                   class="button button--small card-figcaption-button"
                                   data-product-id="97">View</a>
                                <a href="cart.html?action=add&amp;product_id=97"
                                   class="button button--small card-figcaption-button">Add to Cart</a>
                            </div>
                        </figcaption>
                    </article>
                </li>
            </ul>


        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/lazysizes/lazysizes.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
@endsection
