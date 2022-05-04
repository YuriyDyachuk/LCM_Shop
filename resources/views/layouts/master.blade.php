<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <title>@yield('title') LCM Shop</title>

    <link rel="dns-prefetch preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="dns-prefetch preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="/favicon.ico" rel="shortcut icon">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <script>
        // Change document class from no-js to js so we can detect this in css
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
    </script>

    <link href="https://fonts.googleapis.com/css?family=Karla:400|Montserrat:400|Oswald:300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" />
    @yield('styles')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>

</head>

<body>
<svg data-src="{{ asset('assets/img/icon-sprite.svg') }}" class="icons-svg-sprite"></svg>
<!-- Header -->
<header class="header" role="banner">

    <a href="#" class="mobileMenu-toggle" data-mobile-menu-toggle="menu">
        <span class="mobileMenu-toggleIcon">Toggle menu</span>
    </a>
    <nav class="navUser">

        <ul class="navUser-section navUser-section--alt">
            <li class="navUser-item">
                <a class="navUser-action navUser-item--compare" href="index.html" data-compare-nav>Compare <span
                        class="countPill countPill--positive countPill--alt"></span></a>
            </li>
            <li class="navUser-item">
                <a class="navUser-action navUser-action--quickSearch" href="#" data-search="quickSearch"
                   aria-controls="quickSearch" aria-expanded="false">Search</a>
            </li>
            <li class="navUser-item disabled">
                <a class="navUser-action" href="giftcertificates.html">Gift Certificates</a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="navPages-item">
                    <a class="navUser-action" href="{{route('logout')}}">Logout</a>
                </li>
            @else
                <li class="navUser-item navUser-item--account">
                    <a class="navUser-action" href="/{{'login'}}">SIGN IN</a>
                    <span class="navUser-or">or</span>
                    <a class="navUser-action" href="{{route('register')}}">Register</a>
                </li>
            @endif
            <li class="navUser-item navUser-item--cart">
                <a class="navUser-action" data-cart-preview="" data-dropdown="cart-preview-dropdown" data-options="align:right" href="cart.html" aria-expanded="true">
                    <span class="navUser-item-cartLabel">Cart</span> <span class="countPill countPill--positive cart-quantity">
                        {{  $cartProducts ? count($cartProducts)  : 0}}</span>
                </a>
                <div class="dropdown-menu" id="cart-preview-dropdown" data-dropdown-content aria-hidden="true">
                    <div class="previewCart">
                        <ul class="previewCartList">
                            @if($cartProducts)
                                @foreach($cartProducts as $k => $product)
                                    <li class="previewCartItem">
                                        <div class="previewCartItem-image">
                                            <img class="lazyautosizes lazyloaded" data-sizes="auto"
                                                 style="width: 100%"
                                                 @if (!empty($product['img']))
                                                 src="{{asset('uploads/products/'.$product['img'])}}"
                                                 @else
                                                 src="{{ asset('assets/img/products/500x659/StudentMembership__07999.1547237277.png') }}"
                                                 @endif
                                                 alt="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016"
                                                 title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016"
                                                 sizes="72px"
                                            >
                                        </div>

                                        <div class="previewCartItem-content">
                                        <span class="previewCartItem-brand">

                                        </span>

                                            <h6 class="previewCartItem-name">
                                                <a href="{{ $product['url'] }}"
                                                   alt="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016"
                                                   title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">
                                                    {{ $product['name'] }}
                                                </a>
                                            </h6>

                                            <span class="previewCartItem-price">
                                            {{ $product['quantity'] }} * ${{ $product['price'] }}
                                        </span>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="previewCartAction">
                            <div class="previewCartAction-checkout">
                                @if($cartProducts)
                                    <a href="checkout.html" class="button button--small button--primary">
                                        Check out now
                                    </a>
                                @endif
                            </div>

                            <div class="previewCartAction-viewCart">
                                <a href="{{ route('product.cart') }}" class="button button--small button--action">
                                    View Cart
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </li>
        </ul>
        <div class="dropdown dropdown--quickSearch" id="quickSearch" aria-hidden="true" tabindex="-1"
             data-prevent-quick-search-close>
            <div class="container">
                <!-- snippet location forms_search -->
                <form class="form" action="search.html">
                    <fieldset class="form-fieldset">
                        <div class="form-field">
                            <label class="is-srOnly" for="search_query">Search</label>
                            <input class="form-input" data-search-quick name="search_query" id="search_query"
                                   data-error-message="Search field cannot be empty." placeholder="Search the store"
                                   autocomplete="off">
                        </div>
                    </fieldset>
                </form>
                <section class="quickSearchResults" data-bind="html: results"></section>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="tablediv">
            <h1 class="header-logo header-logo--left">
                <a href="https://www.leanconstruction.org/">
                    <img class="header-logo-image-unknown-size"
                         src="{{ asset('assets/img/logo_1540793222__56804.original.png') }}"
                         alt="Lean Construction Institute" title="Lean Construction Institute">
                </a>
            </h1>
            <div class="flag-container">
                <div>
                    <ul class="socialLinks socialLinks--alt">
                        <li class="socialLinks-item">
                            <a class="icon icon--facebook"
                               href="https://www.facebook.com/LeanConstructionUS/?ref=aymt_homepage_panel"
                               target="_blank">
                                <svg>
                                    <use xlink:href="#icon-facebook" />
                                </svg>
                            </a>
                        </li>
                        <li class="socialLinks-item">
                            <a class="icon icon--twitter" href="https://twitter.com/LeanConstruct" target="_blank">
                                <svg>
                                    <use xlink:href="#icon-twitter" /></svg>
                            </a>
                        </li>
                        <li class="socialLinks-item">
                            <a class="icon icon--linkedin" href="https://www.linkedin.com/groups/931137/profile"
                               target="_blank">
                                <svg>
                                    <use xlink:href="#icon-linkedin" /></svg>
                            </a>
                        </li>
                        <li class="socialLinks-item">
                            <a class="icon icon--youtube"
                               href="https://www.youtube.com/channel/UCKndROuwZEJplniw8_dMz0Q" target="_blank">
                                <svg>
                                    <use xlink:href="#icon-youtube" /></svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div data-content-region="header_bottom"></div>
    <div class="navPages-container" id="menu" data-menu>
        <nav class="navPages">
            <div class="navPages-quickSearch">
                <div class="container">
                    <!-- snippet location forms_search -->
                    <form class="form" action="https://shop.leanconstruction.org/search.php">
                        <fieldset class="form-fieldset">
                            <div class="form-field">
                                <label class="is-srOnly" for="search_query">Search</label>
                                <input class="form-input" data-search-quick name="search_query" id="search_query"
                                       data-error-message="Search field cannot be empty."
                                       placeholder="Search the store" autocomplete="off">
                            </div>
                        </fieldset>
                    </form>
                    <section class="quickSearchResults" data-bind="html: results"></section>
                </div>
            </div>
            <ul class="navPages-list" id="123456">
                <li class="navPages-item">
                    <a class="navPages-action" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="navPages-item">
                    <a class="navPages-action" href="{{ route('product.all') }}">All Items</a>
                </li>
                @foreach($productCategories as $categoryId=>$categoryName)
                <li class="navPages-item">
                    <a class="navPages-action" href="{{ route('product.category', ['category' => $categoryId]) }}">{{ $categoryName }}</a>
                </li>
                @endforeach
                <li class="navPages-item navPages-item-page">
                    <a class="navPages-action" href="shipping-returns.html">Shipping &amp; Returns</a>
                </li>
                <li class="navPages-item navPages-item-page">
                    <a class="navPages-action" href="contact.html">Contact</a>
                </li>
            </ul>
            <ul class="navPages-list navPages-list--user">
                <li class="navPages-item">
                    <a class="navPages-action" href="giftcertificates.html">Gift Certificates</a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="navPages-item">
                        <a class="navPages-action" href="login.html">Logout</a>
                    </li>
                @else
                    <li class="navPages-item">
                        <a class="navPages-action" href="login.html">Sign in</a>
                        or <a class="navPages-action" href="logind85d.html?action=create_account">Register</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
<!-- end: Header -->
<!-- Content -->
<div class="body">
    @yield('content')
</div>
<!-- end: Content -->
<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <section class="footer-info">
            <article class="footer-info-col footer-info-col--small-12345" data-section-type="footer-webPages">
                <h5 class="footer-info-heading">Navigate</h5>
                <ul class="footer-info-list">
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="shipping-returns.html">Shipping & Returns</a></li>
                    <li>
                        <a href="sitemap.html">Sitemap</a>
                    </li>
                    <li><a href="terms-of-use.html">Terms of Use</a></li>
                </ul>
            </article>

            <article class="footer-info-col footer-info-col--small-12345" data-section-type="footer-categories">
                <h5 class="footer-info-heading">Categories</h5>
                <ul class="footer-info-list">
                    <li>
                        <a href="{{ route('product.all') }}">All Items</a>
                    </li>
                    @foreach($productCategories as $categoryId=>$categoryName)
                    <li>
                        <a href="{{ route('product.category', ['category' => $categoryId]) }}">{{ $categoryName }}</a>
                    </li>
                    @endforeach
                </ul>
            </article>


            <article class="footer-info-col footer-info-col--small-12345" data-section-type="storeInfo">
                <h5 class="footer-info-heading">Contact Info</h5>
                <address>1400 North 14th Street, 12th Floor<br>
                    Arlington, VA 22209</address>
                <strong>Call us at 703.387.3038 or 703.387.3050</strong>
            </article>
        </section>

        <div class="footer-copyright">
            <p class="powered-by">&copy; 2021 Lean Construction Institute </p>
        </div>
    </div>
</footer>
<!-- end: Footer -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('assets/vendor/svg-injector/dist/svg-injector.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
@yield('scripts')

</body>

</html>
