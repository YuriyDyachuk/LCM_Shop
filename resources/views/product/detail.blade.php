@extends('layouts.master')

@section('title') {{ $pageTitle }} @endsection

@section('content')

<div class="container">
    <ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
        <li class="breadcrumb " itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="{{ route('home.index') }}" class="breadcrumb-label" itemprop="item"><span
                    itemprop="name">Home</span></a>
            <meta itemprop="position" content="0" />
        </li>
        <li class="breadcrumb " itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="{{ $category['url'] }}" class="breadcrumb-label" itemprop="item">
                <span itemprop="name">{{ $category['name'] }}</span>
            </a>
            <meta itemprop="position" content="1" />
        </li>
        <li class="breadcrumb is-active" itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
            <a href="#" class="breadcrumb-label" itemprop="item">
                <span itemprop="name">{{ $pageTitle }}</span>
            </a>
            <meta itemprop="position" content="2" />
        </li>
    </ul>

    @if (empty($item['quantity']))
    <div class="alertBox alertBox--info">
        <div class="alertBox-column alertBox-icon">
            <icon glyph="ic-success" class="icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg"
                                                                          width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                    </path>
                </svg></icon>
        </div>
        <p class="alertBox-column alertBox-message">
            <span>Unfortunately this product is not available for purchase.</span>
        </p>
    </div>
    @endif

    <div itemscope itemtype="http://schema.org/Product">
        <div class="productView">

            <section class="productView-details">
                <div class="productView-product">
                    <h1 class="productView-title" itemprop="name">{{ $item['name'] }}</h1>
                    <div class="productView-price">

                        <div class="price-section price-section--withoutTax" itemprop="offers" itemscope
                             itemtype="http://schema.org/Offer">
                            <span class="price-label">

                            </span>
                            <span class="price-now-label" style="display: none;">
                                Now:
                            </span>
                            <span data-product-price-without-tax class="price price--withoutTax">${{ $item['price'] }}</span>
                            <meta itemprop="availability" itemtype="http://schema.org/ItemAvailability"
                                  content="http://schema.org/InStock">
                            <meta itemprop="itemCondition" itemtype="http://schema.org/OfferItemCondition"
                                  content="http://schema.org/Condition">
                            <div itemprop="priceSpecification" itemscope
                                 itemtype="http://schema.org/PriceSpecification">
                                <meta itemprop="price" content="{{ $item['price'] }}">
                                <meta itemprop="priceCurrency" content="USD">
                                <meta itemprop="valueAddedTaxIncluded" content="false">
                            </div>
                        </div>

                    </div>

                </div>
            </section>

            <section class="productView-images" data-image-gallery>
                <figure class="productView-image" data-image-gallery-main
                        data-zoom-image>
                    <div class="productView-img-container">
                        <a
                            href="{{ asset('assets/img/products/1280x1280/Dont_Conform-cover__01451.15410814134847.jpg') }}">

                            <img class="productView-image--default lazyload" data-sizes="auto"
                                 src="{{ asset('assets/img/loading.svg') }}"
                                 data-src="{{ asset('assets/img/products/500x659/Dont_Conform-cover__01451.15410814134847.jpg') }}"
                                 alt="Don’t Conform, Transform!" title="{{ $item['name'] }}"
                                 data-main-image>

                        </a>
                    </div>
                </figure>
            </section>

            <section class="productView-details">
                <div class="productView-options">
                    <div class="form-field form-field--increments">
                        <label class="form-label form-label--alternate" for="qty[]">Quantity:</label>

                        <div class="form-increment" data-quantity-change>
                            <button class="button button--icon" data-action="dec">
                                <span class="is-srOnly">Decrease Quantity:</span>
                                <i class="icon" aria-hidden="true">
                                    <svg>
                                        <use xlink:href="#icon-keyboard-arrow-down" />
                                    </svg>
                                </i>
                            </button>
                            <input class="form-input form-input--incrementTotal" id="qty[]" name="qty[]"
                                   type="tel" value="1" data-quantity-min="0" data-quantity-max="0" min="1"
                                   pattern="[0-9]*" aria-live="polite">
                            <button class="button button--icon" data-action="inc">
                                <span class="is-srOnly">Increase Quantity:</span>
                                <i class="icon" aria-hidden="true">
                                    <svg>
                                        <use xlink:href="#icon-keyboard-arrow-up" />
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </div>

                    <div class="alertBox productAttributes-message" style="display:none">
                        <div class="alertBox-column alertBox-icon">
                            <icon glyph="ic-success" class="icon" aria-hidden="true"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z">
                                    </path>
                                </svg></icon>
                        </div>
                        <p class="alertBox-column alertBox-message"></p>
                    </div>
                    <div class="form-action">
                        <input id="form-action-addToCart" data-wait-message="Adding to cart…"
                               class="button button--primary" type="click" value="Add to Cart">
                    </div>
                </div>

                <div class="addthis_toolbox addthis_32x32_style" addthis:url="" addthis:title="">
                    <ul class="socialLinks">
                        <li class="socialLinks-item socialLinks-item--facebook">
                            <a class="addthis_button_facebook icon icon--facebook">
                                <svg>
                                    <use xlink:href="#icon-facebook" />
                                </svg>
                            </a>
                        </li>
                        <li class="socialLinks-item socialLinks-item--email">
                            <a class="addthis_button_email icon icon--email">
                                <svg>
                                    <use xlink:href="#icon-envelope" />
                                </svg>
                            </a>
                        </li>
                        <li class="socialLinks-item socialLinks-item--print">
                            <a class="addthis_button_print icon icon--print">
                                <svg>
                                    <use xlink:href="#icon-print" />
                                </svg>
                            </a>
                        </li>
                        <li class="socialLinks-item socialLinks-item--twitter">
                            <a class="addthis_button_twitter icon icon--twitter">
                                <svg>
                                    <use xlink:href="#icon-twitter" />
                                </svg>
                            </a>
                        </li>
                        <li class="socialLinks-item socialLinks-item--pinterest">
                            <a class="addthis_button_pinterest icon icon--pinterest">
                                <svg>
                                    <use xlink:href="#icon-pinterest" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <script type="text/javascript"
                            src="{{ asset('assets/vendor/addthis/addthis_widget.js#pubid=ra-4e94ed470ee51e32') }}"></script>
                    <script>
                        if (typeof (addthis) === "object") {
                            addthis.toolbox('.addthis_toolbox');
                        }
                    </script>
                </div>
                <!-- snippet location product_details -->
            </section>

            <article class="productView-description" itemprop="description">
                <ul class="tabs" data-tab>
                    <li class="tab is-active">
                        <a class="tab-title" href="#tab-description">Description</a>
                    </li>
                </ul>
                <div class="tabs-contents">
                    <div class="tab-content is-active" id="tab-description">
                        {!! $item['description'] !!}
                    </div>
                </div>
            </article>
        </div>

    </div>

</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/lazysizes/lazysizes.min.js') }}"></script>
@endsection
