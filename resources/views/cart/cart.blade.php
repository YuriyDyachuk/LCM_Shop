@extends('layouts.master')
{{--@section('title') {{ $pageTitle }} @endsection--}}

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="page">
            <main class="page-content" data-cart="">
                <ul class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li class="breadcrumb " itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="#" class="breadcrumb-label" itemprop="item"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="0">
                    </li>
                    <li class="breadcrumb is-active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="cart.html" class="breadcrumb-label" itemprop="item"><span itemprop="name">Your Cart</span></a>
                        <meta itemprop="position" content="1">
                    </li>
                </ul>

                <h1 class="page-heading" data-cart-page-title="">
                    Your Cart ( {{$item_count}} items)
                </h1>

                <div data-cart-status="">
                </div>

                <div class="loadingOverlay" style="display: none;"></div>

                <div data-cart-content="">
                    <table class="cart" data-cart-quantity="28">
                        <thead class="cart-header">
                        <tr>
                            <th class="cart-header-item" colspan="2">Item</th>
                            <th class="cart-header-item">Price</th>
                            <th class="cart-header-item cart-header-quantity">Quantity</th>
                            <th class="cart-header-item">Total</th>
                        </tr>
                        </thead>
                        <tbody class="cart-list">
                            @if(!empty($cookie_prod))
                                @foreach($cookie_prod as $x)
                                    <tr class="cart-item" data-item-row="">
                                        <td class="cart-item-block cart-item-figure">
                                            <img class="cart-item-image lazyload" data-sizes="auto"
                                                 src="{{ asset('assets/img/loading.svg') }}"
                                                 style="width: 100%"
                                                 @if (!empty($x['img']))
                                                    data-src="{{asset('uploads/products/'.$x['img'])}}"
                                                 @else
                                                    data-src="{{ asset('assets/img/products/500x659/StudentMembership__07999.1547237277.png') }}"
                                                 @endif
                                                 sizes="100%">
                                        </td>
                                        <td class="cart-item-block cart-item-title">
                                            <h4 class="cart-item-name"><a href="{{$x['url']}}">{{$x['name']}}</a></h4>
                                        </td>
                                        <td class="cart-item-block cart-item-info">
                                            <span class="cart-item-label">Price</span>
                                            <span class="cart-item-value">${{$x['price']}}</span>
                                        </td>

                                        <td class="cart-item-block cart-item-info cart-item-quantity">
                                            <div class="form-field form-field--increments">
                                                <div class="form-increment" data-quantity-change>
                                                    <button class="button button--icon quantity-down" data-id="{{$x['id']}}" data-action="dec">
                                                        <span class="is-srOnly">Decrease Quantity:</span>
                                                        <i class="icon" aria-hidden="true">
                                                            <svg>
                                                                <use xlink:href="#icon-keyboard-arrow-down" />
                                                            </svg>
                                                        </i>
                                                    </button>
                                                    <input class="form-input form-input--incrementTotal cart-item-qty-input" id="qty[]" name="qty[]"
                                                           type="tel" value="{{$x['quantity']}}" data-id="{{$x['id']}}" data-quantity-min="0" data-quantity-max="0" min="1"
                                                           pattern="[0-9]*" aria-live="polite">
                                                    <button class="button button--icon quantity-up" data-id="{{$x['id']}}" data-action="inc">
                                                        <span class="is-srOnly">Increase Quantity:</span>
                                                        <i class="icon" aria-hidden="true">
                                                            <svg>
                                                                <use xlink:href="#icon-keyboard-arrow-up" />
                                                            </svg>
                                                        </i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-item-block cart-item-info">
                                            <form action="{{route('product.cart.remove')}}" method="post">
                                                @csrf
                                                <span class="cart-item-label">Total</span>
                                                <strong class="cart-item-value  data-total">$<span class="p-12">{{$x['total']}}</strong>
{{--                                                <a class="cart-remove icon" data-cart-itemid="d29b29ff-5842-4d97-b787-bdbf5040b8fc" href="#" data-confirm-delete="Are you sure you want to delete this item?">--}}
{{--                                                </a>--}}
                                                <input type="hidden" value="{{$x['id']}}" name="remove">
                                                <button type="submit" class="cart-remove icon">
                                                    <svg>
                                                        <use xlink:href="#icon-close"></use>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div>
                    <ul class="cart-totals">
                        <li class="cart-total">
                            <div class="cart-total-label">
                                <strong>Subtotal:</strong>
                            </div>
                            <div class="cart-total-value">
                                $<span id="sub_total_price">{{$sub_total_price}}</span>
                            </div>
                        </li>
{{--                        <li class="cart-total">--}}
{{--                            <div class="cart-total-label">--}}
{{--                                <strong>Shipping:</strong>--}}
{{--                            </div>--}}
{{--                            <div class="cart-total-value">--}}
{{--                                <button class="shipping-estimate-show">Add Info</button>--}}
{{--                                <button class="shipping-estimate-hide" style="display: none;">Cancel</button>--}}
{{--                            </div>--}}

{{--                            <div class="shipping-estimator u-hiddenVisually">--}}
{{--                                <form class="form estimator-form" data-shipping-estimator="">--}}
{{--                                    <dl>--}}
{{--                                        <dt class="estimator-form-label">--}}
{{--                                            <label class="form-label" for="shipping-country">Country</label>--}}
{{--                                        </dt>--}}
{{--                                        <dd class="estimator-form-input">--}}
{{--                                            <select class="form-select" id="shipping-country" name="shipping-country" data-field-type="Country">--}}
{{--                                                <option>Country</option>--}}
{{--                                                <option value="226" selected="selected">United States</option>--}}
{{--                                            </select>--}}
{{--                                            <span style="display: none;"></span></dd>--}}
{{--                                        <dt class="estimator-form-label">--}}
{{--                                            <label class="form-label" for="shipping-state">State/province</label>--}}
{{--                                        </dt>--}}
{{--                                        <dd class="estimator-form-input">--}}
{{--                                            <select class="form-select" id="shipping-state" name="shipping-state" data-field-type="State">--}}
{{--                                                <option>State/province</option>--}}
{{--                                                <option value="1">Alabama</option>--}}
{{--                                                <option value="2">Alaska</option>--}}
{{--                                                <option value="3">American Samoa</option>--}}
{{--                                                <option value="4">Arizona</option>--}}
{{--                                                <option value="5">Arkansas</option>--}}
{{--                                                <option value="6">Armed Forces Africa</option>--}}
{{--                                                <option value="7">Armed Forces Americas</option>--}}
{{--                                                <option value="8">Armed Forces Canada</option>--}}
{{--                                                <option value="9">Armed Forces Europe</option>--}}
{{--                                                <option value="10">Armed Forces Middle East</option>--}}
{{--                                                <option value="11">Armed Forces Pacific</option>--}}
{{--                                                <option value="12">California</option>--}}
{{--                                                <option value="13">Colorado</option>--}}
{{--                                                <option value="14">Connecticut</option>--}}
{{--                                                <option value="15">Delaware</option>--}}
{{--                                                <option value="16">District of Columbia</option>--}}
{{--                                                <option value="17">Federated States Of Micronesia</option>--}}
{{--                                                <option value="18">Florida</option>--}}
{{--                                                <option value="19">Georgia</option>--}}
{{--                                                <option value="20">Guam</option>--}}
{{--                                                <option value="21">Hawaii</option>--}}
{{--                                                <option value="22">Idaho</option>--}}
{{--                                                <option value="23">Illinois</option>--}}
{{--                                                <option value="24">Indiana</option>--}}
{{--                                                <option value="25">Iowa</option>--}}
{{--                                                <option value="26">Kansas</option>--}}
{{--                                                <option value="27">Kentucky</option>--}}
{{--                                                <option value="28">Louisiana</option>--}}
{{--                                                <option value="29">Maine</option>--}}
{{--                                                <option value="30">Marshall Islands</option>--}}
{{--                                                <option value="31">Maryland</option>--}}
{{--                                                <option value="32">Massachusetts</option>--}}
{{--                                                <option value="33">Michigan</option>--}}
{{--                                                <option value="34">Minnesota</option>--}}
{{--                                                <option value="35">Mississippi</option>--}}
{{--                                                <option value="36">Missouri</option>--}}
{{--                                                <option value="37">Montana</option>--}}
{{--                                                <option value="38">Nebraska</option>--}}
{{--                                                <option value="39">Nevada</option>--}}
{{--                                                <option value="40">New Hampshire</option>--}}
{{--                                                <option value="41">New Jersey</option>--}}
{{--                                                <option value="42">New Mexico</option>--}}
{{--                                                <option value="43">New York</option>--}}
{{--                                                <option value="44">North Carolina</option>--}}
{{--                                                <option value="45">North Dakota</option>--}}
{{--                                                <option value="46">Northern Mariana Islands</option>--}}
{{--                                                <option value="47">Ohio</option>--}}
{{--                                                <option value="48">Oklahoma</option>--}}
{{--                                                <option value="49">Oregon</option>--}}
{{--                                                <option value="50">Palau</option>--}}
{{--                                                <option value="51">Pennsylvania</option>--}}
{{--                                                <option value="52">Puerto Rico</option>--}}
{{--                                                <option value="53">Rhode Island</option>--}}
{{--                                                <option value="54">South Carolina</option>--}}
{{--                                                <option value="55">South Dakota</option>--}}
{{--                                                <option value="56">Tennessee</option>--}}
{{--                                                <option value="57">Texas</option>--}}
{{--                                                <option value="58">Utah</option>--}}
{{--                                                <option value="59">Vermont</option>--}}
{{--                                                <option value="60">Virgin Islands</option>--}}
{{--                                                <option value="61">Virginia</option>--}}
{{--                                                <option value="62">Washington</option>--}}
{{--                                                <option value="63">West Virginia</option>--}}
{{--                                                <option value="64">Wisconsin</option>--}}
{{--                                                <option value="65">Wyoming</option>--}}
{{--                                            </select>--}}
{{--                                            <span style="display: none;"></span></dd>--}}
{{--                                        <dt class="estimator-form-label">--}}
{{--                                            <label class="form-label" for="shipping-city">Suburb/city</label>--}}
{{--                                        </dt>--}}
{{--                                        <dd class="estimator-form-input">--}}
{{--                                            <input class="form-input" type="text" id="shipping-city" name="shipping-city" value="" placeholder="Suburb/city">--}}
{{--                                        </dd>--}}

{{--                                        <dt class="estimator-form-label">--}}
{{--                                            <label class="form-label" for="shipping-zip">Zip/postcode</label>--}}
{{--                                        </dt>--}}
{{--                                        <dd class="estimator-form-input">--}}
{{--                                            <input class="form-input" type="text" id="shipping-zip" name="shipping-zip" value="" placeholder="Zip/postcode">--}}
{{--                                        </dd>--}}
{{--                                        <button class="button button--primary button--small shipping-estimate-submit">Estimate--}}
{{--                                            Shipping</button>--}}
{{--                                    </dl>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <li class="cart-total">
                            <div class="cart-total-label">
                                <strong>Coupon Code: @if(isset($promo_name)) {{$promo_name}} @endif</strong>
                            </div>
                            <div class="cart-total-value">
                                <button class="coupon-code-add">@if(!isset($coupon)) Add Coupon @else Change Coupon @endif</button>
                                <button class="coupon-code-cancel" style="display: none;">Cancel</button>
                            </div>

                            <div class="cart-form coupon-code" style="display: none;">
                                <form class="form form--hiddenLabels coupon-form" method="get" action="{{route('product.coupon')}}">
                                    <label class="form-label" for="couponcode">Enter your coupon code</label>
                                    <input class="form-input" data-error="Please enter your coupon code." id="couponcode" type="text" name="couponcode" value="" placeholder="Enter your coupon code">

                                    <input class="button button--primary button--small" type="submit" value="Apply">
                                    <input type="hidden" name="action" value="applycoupon">
                                </form>
                            </div>
                        </li>
                        <li class="cart-total">
                            <div class="cart-total-label">
                                <strong>Gift Certificate:</strong>
                            </div>
                            <div class="cart-total-value">

                                <button class="gift-certificate-add">Gift Certificate</button>

                                <button class="gift-certificate-cancel" style="display: none;">Cancel</button>
                            </div>

                            <div class="cart-form gift-certificate-code" style="display: none;">
                                <form class="form form--hiddenLabels cart-gift-certificate-form" method="post" action="/cart.php">
                                    <label class="form-label" for="certcode">Enter your certificate code</label>
                                    <input class="form-input" data-error="Please enter your valid certificate code." id="certcode" type="text" name="certcode" value="" placeholder="Add Certificate">
                                    <input class="button button--primary button--small" type="submit" value="Apply">
                                    <input type="hidden" name="action" value="applycoupon">
                                </form>
                            </div>
                        </li>
                        <li class="cart-total">
                            <div class="cart-total-label">
                                <strong>Grand total:</strong>
                            </div>
                            <div class="cart-total-value cart-total-grandTotal">
                                $<span id="g-total">{{$total}}</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="cart-actions">
                    <a class="button button--primary" href="{{route('product.checkout')}}" title="Click here to proceed to checkout">Check out</a>
                </div>
            </main>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/lazysizes/lazysizes.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/cart.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript">
        $('body').on('change','.cart-item-qty-input',function () {
            disable_buttons()
            let cookie_id = $(this).attr('data-id')
            let val  = $(this).val();
            quantity(cookie_id,'up',val,$(this))
        })
        $('body').on('click','.quantity-up',function () {
            disable_buttons()
            let cookie_id = $(this).attr('data-id')
            quantity(cookie_id, 0, null, $(this))
        })
        $('body').on('click','.quantity-down',function () {
            disable_buttons()
            let cookie_id = $(this).attr('data-id')
            quantity(cookie_id, 1, null, $(this))
        })
        function quantity(cookie_id, down = 0, up = null, el){
            $.ajax({
                type: 'GET',
                url: `/product/cart/qty/${cookie_id}`,
                data: {down,up},
                dataType: 'json',
                success: function ({data}) {
                    const parent = el.closest('tr');
                    if(!parent.length) {
                        window.location.href;
                        return;
                    }
                    if(parent.find('[name="qty[]"]').length) {
                        parent.find('[name="qty[]"]').val(data.quantity)
                    }
                    if(parent.find('.cart-item-value.data-total .p-12').length) {
                        parent.find('.cart-item-value.data-total .p-12').empty().html(data.total)
                    }
                    getAllTotal()
                    enable_buttons();

                },
                cache: function () {
                    enable_buttons()
                }
            });
        }

        function getAllTotal() {
            let t = 0;
            $('.cart-item-value.data-total .p-12').map(function () {
                const b = parseInt($(this).text());
                if(!isNaN(b)) {
                    t+= parseInt($(this).text())
                }
            });
            let global_price = parseInt($('#g-total').text());
            let sub_price = parseInt($('#sub_total_price').text());
            if (global_price < sub_price){
                let sale = sub_price - global_price;
                $('#g-total').empty().html(t - sale);
            }
            else {
                $('#g-total').empty().html(t);
            }
            $('#sub_total_price').empty().html(t);
        }
        function disable_buttons() {
            $('.quantity-up').attr('disabled','true')
            $('.quantity-down').attr('disabled','true')
            return true;
        }
        function enable_buttons() {
            $('.quantity-up').removeAttr('disabled')
            $('.quantity-down').removeAttr('disabled');
            return true;
        }
        // $(window).on('load', function () {
        //     getAllTotal()
        // })
    </script>
@endsection
