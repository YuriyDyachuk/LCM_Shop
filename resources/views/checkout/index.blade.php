@extends('layouts.master')
{{--@section('title') {{ $pageTitle }} @endsection--}}
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/checkout.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/cart-summary.css')}}" type="text/css"/>
    <style>
        .form-label{
            display: flex !important;
            align-items: baseline;
        }
        legend{
            border-bottom: none !important;
        }
</style>
@endsection
@section('content')
    <div id="checkout-app">
        <div class="layout optimizedCheckout-contentPrimary">
            @if ($errors->any())
                <div class="alert alert-danger" style="color: red; display: flex; justify-content: center;">
                    <ul style="margin-bottom: 0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="layout-main">
                <ol class="checkout-steps">
{{--                TODO Login--}}
                    <li class="checkout-step optimizedCheckout-checkoutStep checkout-step--customer">
                        <div class="checkout-view-header" style="display: flex; justify-content: space-between; align-items: center">
                            <div class="stepHeader-figure stepHeader-column">
                                <div class="icon stepHeader-counter optimizedCheckout-step">
                                    <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
                                    </svg>
                                </div>
                                <h2 class="stepHeader-title optimizedCheckout-headingPrimary">Customer</h2>
                            </div>
                            @if(auth()->check())
                                <span>{{Auth::user()->email}}</span>
                                <a href="{{route('logout')}}" class="button button--tertiary button--tiny optimizedCheckout-buttonSecondary" style="margin: 0 !important;">
                                    Sign Out
                                </a>
                            @endif
                        </div>
                        @if(!auth()->check())
                            <div class="custom-login-info">
                                <form method="post" action="{{route('login')}}" class="checkout-form">
                                    @csrf
                                    <legend class="form-legend is-srOnly">Returning Customer</legend>
                                    <div class="form-body">
                                        <p>Don't have an account? <a href="{{route('register')}}">Create an account</a> to continue.</p>
                                        <div class="form-field">
                                            <label for="email" class="form-label optimizedCheckout-form-label">
                                                Email Address
                                            </label>
                                            <input name="email" id="email"
                                                   class="form-input optimizedCheckout-form-input"
                                                   type="email">
                                        </div>
                                        <div class="form-field">
                                            <label for="password" class="form-label optimizedCheckout-form-label">
                                                Password
                                            </label>
                                            <div class="form-field-password">
                                                <input name="password" id="password"
                                                       class="form-input optimizedCheckout-form-input form-input--withIcon"
                                                       type="password">
                                                <a class="form-toggle-password form-input-icon" href="#">
                                                    <div class="icon">
                                                        <svg viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M634 471L36 3.51A16 16 0 0 0 13.51 6l-10 12.49A16 16 0 0 0 6 41l598 467.49a16 16 0 0 0 22.49-2.49l10-12.49A16 16 0 0 0 634 471zM296.79 146.47l134.79 105.38C429.36 191.91 380.48 144 320 144a112.26 112.26 0 0 0-23.21 2.47zm46.42 219.07L208.42 260.16C210.65 320.09 259.53 368 320 368a113 113 0 0 0 23.21-2.46zM320 112c98.65 0 189.09 55 237.93 144a285.53 285.53 0 0 1-44 60.2l37.74 29.5a333.7 333.7 0 0 0 52.9-75.11 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64c-36.7 0-71.71 7-104.63 18.81l46.41 36.29c18.94-4.3 38.34-7.1 58.22-7.1zm0 288c-98.65 0-189.08-55-237.93-144a285.47 285.47 0 0 1 44.05-60.19l-37.74-29.5a333.6 333.6 0 0 0-52.89 75.1 32.35 32.35 0 0 0 0 29.19C89.72 376.41 197.08 448 320 448c36.7 0 71.71-7.05 104.63-18.81l-46.41-36.28C359.28 397.2 339.89 400 320 400z"></path>
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                            <a href="https://shop.leanconstruction.org/login.php?action=reset_password" rel="noopener noreferrer" target="_blank">Forgot password?</a>
                                        </div>
                                        <div class="form-actions">
                                            <button id="checkout-customer-continue"
                                                    class="button button--primary optimizedCheckout-buttonPrimary"
                                                    type="submit">Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </li>
{{--                TODO Shipping--}}
                    <li class="checkout-step optimizedCheckout-checkoutStep checkout-step--shipping">
                        <div class="checkout-view-header">
                            <a class="stepHeader is-readonly">
                                <div class="stepHeader-figure stepHeader-column">
                                    <div class="icon stepHeader-counter optimizedCheckout-step">
                                        <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="stepHeader-title optimizedCheckout-headingPrimary">Shipping</h2>
                                </div>
                            </a>
                        </div>
                        @if(auth()->check())
                            <div class="checkout-view-content checkout-view-content-enter-done">
                                <div class="checkout-form">
                                    @if(!$user->checkoutAddress->isEmpty())
{{--                                         TODO add dropdown addresses this user--}}
                                        <div class="form-legend-container">
                                            <legend class="form-legend optimizedCheckout-headingSecondary">
                                                Shipping Address
                                            </legend>
                                        </div>

                                        <div class="form-field">
                                            <label for="countryCodeInput" class="form-label optimizedCheckout-form-label">
                                                Your address
                                            </label>
                                            <select class="form-select optimizedCheckout-form-select"
                                                    onchange="getValue(this.value)"
                                                    id="myAddress"
                                                    name="myAddress">
                                                <option value="">Select a address</option>
                                                @foreach($user->checkoutAddress as $address)
                                                    <option value="{{ $address->id }}">{{ $address->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                        <form action="{{route('product.checkout.shipping')}}" method="post">
                                            @csrf
                                            <fieldset class="form-fieldset">
                                                <div class="form-body">
                                                    <div class="form-fieldset">
                                                        <div class="form-body">
                                                            <div class="form-body">
                                                                <div class="checkout-address">
                                                                    <div class="dynamic-form-field dynamic-form-field--countryCode">
                                                                        <div class="form-field">
                                                                            <label for="countryCodeInput" class="form-label optimizedCheckout-form-label">
                                                                                Country
                                                                            </label>
                                                                            <select class="form-select optimizedCheckout-form-select"
                                                                                    id="countryCodeInput"
                                                                                    name="country">
                                                                                <option value="">Select a country</option>
                                                                                <option value="US">US</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--firstName">
                                                                        <div class="form-field">
                                                                            <label for="firstNameInput" class="form-label optimizedCheckout-form-label">
                                                                                First Name
                                                                            </label>
                                                                            <input id="firstNameInput"
                                                                                   name="first_name"
                                                                                   class="form-input optimizedCheckout-form-input"
                                                                                   type="text"
                                                                                   value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--lastName">
                                                                        <div class="form-field">
                                                                            <label for="lastNameInput" class="form-label optimizedCheckout-form-label">
                                                                                Last Name
                                                                            </label>
                                                                            <input
                                                                                    id="lastNameInput"
                                                                                    name="last_name"
                                                                                    class="form-input optimizedCheckout-form-input"
                                                                                    type="text"
                                                                                    value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--addressLine1">
                                                                        <div class="form-field">
                                                                            <label for="addressLine1Input" class="form-label optimizedCheckout-form-label">
                                                                                Address
                                                                            </label>
                                                                            <input id="addressLine1Input"
                                                                                   name="address"
                                                                                   class="form-input optimizedCheckout-form-input"
                                                                                   type="text"
                                                                                   value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--addressLine2">
                                                                        <div class="form-field">
                                                                            <label for="addressLine2Input" class="form-label optimizedCheckout-form-label">
                                                                                Apartment/Suite/Building (Optional)
                                                                            </label>
                                                                            <input id="addressLine2Input"
                                                                                   name="suite"
                                                                                   class="form-input optimizedCheckout-form-input"
                                                                                   type="text"
                                                                                   value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--company">
                                                                        <div class="form-field">
                                                                            <label for="companyInput" class="form-label optimizedCheckout-form-label">
                                                                                Company Name (Optional)
                                                                            </label>
                                                                            <input id="companyInput"
                                                                                   name="company"
                                                                                   class="form-input optimizedCheckout-form-input"
                                                                                   type="text"
                                                                                   value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--city">
                                                                        <div class="form-field">
                                                                            <label for="cityInput" class="form-label optimizedCheckout-form-label">
                                                                                City
                                                                            </label>
                                                                            <input id="cityInput"
                                                                                   name="city"
                                                                                   class="form-input optimizedCheckout-form-input"
                                                                                   type="text"
                                                                                   value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--province">
                                                                        <div class="form-field">
                                                                            <label for="provinceInput" class="form-label optimizedCheckout-form-label">
                                                                                State/Province (Optional)
                                                                            </label>
                                                                            <select name="state"
                                                                                    class="form-select optimizedCheckout-form-select"
                                                                                    id="provinceInput">
                                                                                <option value="">Select a state</option>
                                                                                <option value="AL">Alabama</option>
                                                                                <option value="AK">Alaska</option>
                                                                                <option value="AS">American Samoa</option>
                                                                                <option value="AZ">Arizona</option>
                                                                                <option value="AR">Arkansas</option>
                                                                                <option value="AA">Armed Forces Americas</option>
                                                                                <option value="AE">Armed Forces Europe</option>
                                                                                <option value="AP">Armed Forces Pacific</option>
                                                                                <option value="CA">California</option>
                                                                                <option value="CO">Colorado</option>
                                                                                <option value="CT">Connecticut</option>
                                                                                <option value="DE">Delaware</option>
                                                                                <option value="DC">District of Columbia</option>
                                                                                <option value="FM">Federated States Of Micronesia</option>
                                                                                <option value="FL">Florida</option>
                                                                                <option value="GA">Georgia</option>
                                                                                <option value="GU">Guam</option>
                                                                                <option value="HI">Hawaii</option>
                                                                                <option value="ID">Idaho</option>
                                                                                <option value="IL">Illinois</option>
                                                                                <option value="IN">Indiana</option>
                                                                                <option value="IA">Iowa</option>
                                                                                <option value="KS">Kansas</option>
                                                                                <option value="KY">Kentucky</option>
                                                                                <option value="LA">Louisiana</option>
                                                                                <option value="ME">Maine</option>
                                                                                <option value="MH">Marshall Islands</option>
                                                                                <option value="MD">Maryland</option>
                                                                                <option value="MA">Massachusetts</option>
                                                                                <option value="MI">Michigan</option>
                                                                                <option value="MN">Minnesota</option>
                                                                                <option value="MS">Mississippi</option>
                                                                                <option value="MO">Missouri</option>
                                                                                <option value="MT">Montana</option>
                                                                                <option value="NE">Nebraska</option>
                                                                                <option value="NV">Nevada</option>
                                                                                <option value="NH">New Hampshire</option>
                                                                                <option value="NJ">New Jersey</option>
                                                                                <option value="NM">New Mexico</option>
                                                                                <option value="NY">New York</option>
                                                                                <option value="NC">North Carolina</option>
                                                                                <option value="ND">North Dakota</option>
                                                                                <option value="MP">Northern Mariana Islands</option>
                                                                                <option value="OH">Ohio</option>
                                                                                <option value="OK">Oklahoma</option>
                                                                                <option value="OR">Oregon</option>
                                                                                <option value="PW">Palau</option>
                                                                                <option value="PA">Pennsylvania</option>
                                                                                <option value="PR">Puerto Rico</option>
                                                                                <option value="RI">Rhode Island</option>
                                                                                <option value="SC">South Carolina</option>
                                                                                <option value="SD">South Dakota</option>
                                                                                <option value="TN">Tennessee</option>
                                                                                <option value="TX">Texas</option>
                                                                                <option value="UT">Utah</option>
                                                                                <option value="VT">Vermont</option>
                                                                                <option value="VI">Virgin Islands</option>
                                                                                <option value="VA">Virginia</option>
                                                                                <option value="WA">Washington</option>
                                                                                <option value="WV">West Virginia</option>
                                                                                <option value="WI">Wisconsin</option>
                                                                                <option value="WY">Wyoming</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--postCode">
                                                                        <div class="form-field">
                                                                            <label for="postCodeInput" class="form-label optimizedCheckout-form-label">
                                                                                Postal Code
                                                                            </label>
                                                                            <input
                                                                                    id="postCodeInput"
                                                                                    name="post_code"
                                                                                    class="form-input optimizedCheckout-form-input"
                                                                                    type="text"
                                                                                    value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="dynamic-form-field dynamic-form-field--phone">
                                                                        <div class="form-field">
                                                                            <label for="phoneInput" class="form-label optimizedCheckout-form-label">
                                                                                Phone Number (Optional)
                                                                            </label>
                                                                            <input
                                                                                    id="phoneInput"
                                                                                    name="phone"
                                                                                    class="form-input optimizedCheckout-form-input"
                                                                                    type="text"
                                                                                    value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-field">
                                                                <input
                                                                        name="shipping_address"
                                                                        id="shippingAddress"
                                                                        class="form-checkbox optimizedCheckout-form-checkbox"
                                                                        type="checkbox">
                                                                <label for="shippingAddress"
                                                                       class="form-label optimizedCheckout-form-label">
                                                                    Save this address in my address book.
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-field">
                                                            <input name="billing_same"
                                                                   class="form-checkbox optimizedCheckout-form-checkbox"
                                                                   id="sameAsBilling"
                                                                   type="checkbox">
                                                            <label for="sameAsBilling"
                                                                   class="form-label optimizedCheckout-form-label">
                                                                My billing address is the same as my shipping address.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            //TODO shipping method
                                            <fieldset id="checkout-shipping-options" class="form-fieldset">
                                                <legend class="form-legend optimizedCheckout-headingSecondary">
                                                    Shipping Method
                                                </legend>
                                                <div class="form-body">
                                                    <div class="shippingOptions-container form-fieldset">
                                                        <div class="loadingOverlay-container">
                                                            <ul class="form-checklist optimizedCheckout-form-checklist">
                                                                <li class="form-checklist-item optimizedCheckout-form-checklist-item form-checklist-item--selected optimizedCheckout-form-checklist-item--selected">
                                                                    <div class="form-checklist-header form-checklist-header--selected">
                                                                        <div class="form-field">
                                                                            <input name="shipping_option_id" class="form-checklist-checkbox optimizedCheckout-form-checklist-checkbox" value="shipping_id" id="shippingOptionRadio-61c043cd4303b-031a03044f4cf19c93cf58ef146fe04f" type="radio" checked="">
                                                                            <label for="shippingOptionRadio-61c043cd4303b-031a03044f4cf19c93cf58ef146fe04f" class="form-label optimizedCheckout-form-label">
                                                                                <div class="shippingOptionLabel">
                                                                                    <div class="shippingOption shippingOption--alt">
                                                    <span class="shippingOption-desc">
                                                        USPS priority flat rate
                                                    </span>
                                                                                        <span class="shippingOption-price">$9.00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="form-checklist-item optimizedCheckout-form-checklist-item form-checklist-item--selected optimizedCheckout-form-checklist-item--selected">
                                                                    <div class="form-checklist-header form-checklist-header--selected">
                                                                        <div class="form-field">
                                                                            <input name="shipping_option_id" class="form-checklist-checkbox optimizedCheckout-form-checklist-checkbox" id="shippingOptionRadio-2" value="shipping_id" type="radio">
                                                                            <label for="shippingOptionRadio-2" class="form-label optimizedCheckout-form-label">
                                                                                <div class="shippingOptionLabel">
                                                                                    <div class="shippingOption shippingOption--alt">
                                                                                        <span class="shippingOption-desc">Option 2</span>
                                                                                        <span class="shippingOption-price">$10.00</span>
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            //TODO end shipping method
                                            <fieldset class="form-fieldset" data-test="checkout-shipping-comments">
                                                <legend class="form-legend optimizedCheckout-headingSecondary">
                                                    Order Comments
                                                </legend>
                                                <div class="form-body">
                                                    <div class="form-field">
                                                        <label for="orderComment" class="form-label is-srOnly optimizedCheckout-form-label">
                                                            Order Comments
                                                        </label>
                                                        <input name="order_comment"
                                                               id="orderComment"
                                                               maxlength="2000"
                                                               class="form-input optimizedCheckout-form-input"
                                                               type="text"
                                                               value="">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="form-actions">
                                                <button id="checkout-shipping-continue"
                                                        class="button button--primary optimizedCheckout-buttonPrimary"
                                                        type="submit">
                                                    Continue
                                                </button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        @endif
                    </li>
{{--                TODO Billing--}}
                    <li class="checkout-step optimizedCheckout-checkoutStep checkout-step--billing">
                        <div class="checkout-view-content checkout-view-content-enter-done">
                            <div class="checkout-view-header">
                                <a class="stepHeader is-readonly">
                                    <div class="stepHeader-figure stepHeader-column">
                                        <div class="icon stepHeader-counter optimizedCheckout-step">
                                            <svg height="24"
                                                 viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
                                            </svg>
                                        </div>
                                        <h2 class="stepHeader-title optimizedCheckout-headingPrimary">Billing</h2>
                                    </div>
                                </a>
                            </div>
                            <div class="checkout-form">
                                <form class="billingForm">
                                    <fieldset class="form-fieldset">
                                        <div class="form-body">
                                            <div class="form-fieldset">
                                                <div class="form-body">
                                                    <div class="form-body">
                                                        <div class="checkout-address">
                                                            <div class="dynamic-form-field dynamic-form-field--addressLine1">
                                                                <div class="form-field">
                                                                    <label for="addressLine1Input" class="form-label optimizedCheckout-form-label">
                                                                        Address
                                                                    </label>
                                                                    <input id="addressLine1Input"
                                                                           name="billing[address]"
                                                                           class="form-input optimizedCheckout-form-input"
                                                                           type="text"
                                                                           value="">
                                                                </div>
                                                            </div>
                                                            <div class="dynamic-form-field dynamic-form-field--city">
                                                                <div class="form-field">
                                                                    <label for="cityInput" class="form-label optimizedCheckout-form-label">
                                                                        City
                                                                    </label>
                                                                    <input id="cityInput"
                                                                           name="billing[city]"
                                                                           class="form-input optimizedCheckout-form-input"
                                                                           type="text"
                                                                           value="">
                                                                </div>
                                                            </div>
                                                            <div class="dynamic-form-field dynamic-form-field--province">
                                                                <div class="form-field">
                                                                    <label for="provinceInput" class="form-label optimizedCheckout-form-label">
                                                                        State/Province (Optional)
                                                                    </label>
                                                                    <select name="billing[state]"
                                                                            class="form-select optimizedCheckout-form-select"
                                                                            id="provinceInput">
                                                                        <option value="">Select a state</option>
                                                                        <option value="AL">Alabama</option>
                                                                        <option value="AK">Alaska</option>
                                                                        <option value="AS">American Samoa</option>
                                                                        <option value="AZ">Arizona</option>
                                                                        <option value="AR">Arkansas</option>
                                                                        <option value="AA">Armed Forces Americas</option>
                                                                        <option value="AE">Armed Forces Europe</option>
                                                                        <option value="AP">Armed Forces Pacific</option>
                                                                        <option value="CA">California</option>
                                                                        <option value="CO">Colorado</option>
                                                                        <option value="CT">Connecticut</option>
                                                                        <option value="DE">Delaware</option>
                                                                        <option value="DC">District of Columbia</option>
                                                                        <option value="FM">Federated States Of Micronesia</option>
                                                                        <option value="FL">Florida</option>
                                                                        <option value="GA">Georgia</option>
                                                                        <option value="GU">Guam</option>
                                                                        <option value="HI">Hawaii</option>
                                                                        <option value="ID">Idaho</option>
                                                                        <option value="IL">Illinois</option>
                                                                        <option value="IN">Indiana</option>
                                                                        <option value="IA">Iowa</option>
                                                                        <option value="KS">Kansas</option>
                                                                        <option value="KY">Kentucky</option>
                                                                        <option value="LA">Louisiana</option>
                                                                        <option value="ME">Maine</option>
                                                                        <option value="MH">Marshall Islands</option>
                                                                        <option value="MD">Maryland</option>
                                                                        <option value="MA">Massachusetts</option>
                                                                        <option value="MI">Michigan</option>
                                                                        <option value="MN">Minnesota</option>
                                                                        <option value="MS">Mississippi</option>
                                                                        <option value="MO">Missouri</option>
                                                                        <option value="MT">Montana</option>
                                                                        <option value="NE">Nebraska</option>
                                                                        <option value="NV">Nevada</option>
                                                                        <option value="NH">New Hampshire</option>
                                                                        <option value="NJ">New Jersey</option>
                                                                        <option value="NM">New Mexico</option>
                                                                        <option value="NY">New York</option>
                                                                        <option value="NC">North Carolina</option>
                                                                        <option value="ND">North Dakota</option>
                                                                        <option value="MP">Northern Mariana Islands</option>
                                                                        <option value="OH">Ohio</option>
                                                                        <option value="OK">Oklahoma</option>
                                                                        <option value="OR">Oregon</option>
                                                                        <option value="PW">Palau</option>
                                                                        <option value="PA">Pennsylvania</option>
                                                                        <option value="PR">Puerto Rico</option>
                                                                        <option value="RI">Rhode Island</option>
                                                                        <option value="SC">South Carolina</option>
                                                                        <option value="SD">South Dakota</option>
                                                                        <option value="TN">Tennessee</option>
                                                                        <option value="TX">Texas</option>
                                                                        <option value="UT">Utah</option>
                                                                        <option value="VT">Vermont</option>
                                                                        <option value="VI">Virgin Islands</option>
                                                                        <option value="VA">Virginia</option>
                                                                        <option value="WA">Washington</option>
                                                                        <option value="WV">West Virginia</option>
                                                                        <option value="WI">Wisconsin</option>
                                                                        <option value="WY">Wyoming</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="dynamic-form-field dynamic-form-field--postCode">
                                                                <div class="form-field">
                                                                    <label for="postCodeInput" class="form-label optimizedCheckout-form-label">
                                                                        Postal Code
                                                                    </label>
                                                                    <input
                                                                            id="postCodeInput"
                                                                            name="billing[post_code]"
                                                                            class="form-input optimizedCheckout-form-input"
                                                                            type="text"
                                                                            value="">
                                                                </div>
                                                            </div>
                                                            <div class="dynamic-form-field dynamic-form-field--countryCode">
                                                                <div class="form-field">
                                                                    <label for="countryCodeInput" class="form-label optimizedCheckout-form-label">
                                                                        Country
                                                                    </label>
                                                                    <select class="form-select optimizedCheckout-form-select"
                                                                            id="countryCodeInput"
                                                                            name="billing[country]">
                                                                        <option value="">Select a country</option>
                                                                        <option value="US">US</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="form-actions">
                                        <button id="checkout-shipping-continue"
                                                class="button button--primary optimizedCheckout-buttonPrimary"
                                                type="submit">
                                            Continue
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </li>
{{--                TODO Payment--}}
                    <li class="checkout-step optimizedCheckout-checkoutStep checkout-step--payment">
                        <div class="checkout-view-header">
                            <a class="stepHeader is-readonly">
                                <div class="stepHeader-figure stepHeader-column">
                                    <div class="icon stepHeader-counter optimizedCheckout-step">
                                        <svg height="24"
                                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="stepHeader-title optimizedCheckout-headingPrimary">Payment</h2>
                                </div>
                            </a>
                        </div>
                        <div class="checkout-view-content checkout-view-content-enter-done">
                            <form class="checkout-form" data-test="payment-form" novalidate="">
                                <fieldset class="form-fieldset">
                                    <div class="form-body">
                                        <ul class="form-checklist optimizedCheckout-form-checklist">
                                            <li style="display: flex; justify-content: space-around;"
                                                class="form-checklist-item optimizedCheckout-form-checklist-item form-checklist-item--selected optimizedCheckout-form-checklist-item--selected">

                                                <div class="paymentProviderHeader-cc" style="display: flex; align-items: center; cursor: pointer;">
                                                    <ul class="creditCardTypes-list">
                                                        <label for="radio-paypal-card"
                                                               class="form-label optimizedCheckout-form-label">
                                                            <li class="creditCardTypes-list-item">
                                                            <span class="cardIcon">
                                                                <div
                                                                        class="icon cardIcon-icon icon--medium"
                                                                        data-test="credit-card-icon-visa">
                                                                    <svg
                                                                            aria-labelledby="iconCardVisaTitle"
                                                                            height="100"
                                                                            role="img"
                                                                            viewBox="0 0 148 100"
                                                                            width="148"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                        <title
                                                                                id="iconCardVisaTitle">
                                                                            Visa</title>
                                                                        <g fill="none"
                                                                           fill-rule="evenodd">
                                                                            <path
                                                                                    d="M148 84c0 6.6-5.55 12-12 12H12C5.55 96 0 90.6 0 84V12C0 5.4 5.55 0 12 0h124c6.45 0 12 5.4 12 12v72z"
                                                                                    fill="#F3F4F4">
                                                                            </path>
                                                                            <path
                                                                                    d="M0 24V12C0 5.4 5.74 0 12 0h124c6.26 0 12 5.4 12 12v12"
                                                                                    fill="#01579F">
                                                                            </path>
                                                                            <path
                                                                                    d="M148 76v12c0 8.667-5.74 12-12 12H12c-6.26 0-12-3.333-12-12V76"
                                                                                    fill="#FAA41D">
                                                                            </path>
                                                                            <path
                                                                                    d="M55.01 65.267l4.72-29.186h7.546l-4.72 29.19H55.01M89.913 36.8c-1.49-.59-3.85-1.242-6.77-1.242-7.452 0-12.7 3.974-12.73 9.656-.063 4.19 3.756 6.52 6.613 7.918 2.92 1.428 3.913 2.36 3.913 3.633-.04 1.957-2.36 2.857-4.54 2.857-3.014 0-4.628-.465-7.08-1.552l-.996-.466-1.055 6.55c1.77.808 5.03 1.52 8.415 1.553 7.92 0 13.075-3.912 13.137-9.967.03-3.322-1.987-5.868-6.334-7.948-2.64-1.336-4.256-2.236-4.256-3.602.032-1.242 1.367-2.514 4.348-2.514 2.453-.06 4.254.53 5.62 1.12l.684.31L89.91 36.8m10.03 18.13c.62-1.675 3.013-8.165 3.013-8.165-.03.062.62-1.707.994-2.794l.525 2.52s1.428 6.986 1.74 8.445H99.94zm9.317-18.846h-5.84c-1.8 0-3.17.53-3.945 2.424L88.265 65.27h7.918s1.305-3.6 1.585-4.377h9.687c.217 1.024.9 4.377.9 4.377h6.987l-6.082-29.19zm-60.555 0l-7.39 19.904-.807-4.037c-1.37-4.652-5.653-9.713-10.435-12.23l6.77 25.52h7.98L56.68 36.09H48.7"
                                                                                    fill="#3B5CAA">
                                                                            </path>
                                                                            <path
                                                                                    d="M34.454 36.08H22.312l-.124.59c9.47 2.423 15.744 8.26 18.32 15.277L37.87 38.534c-.436-1.863-1.77-2.39-3.416-2.453"
                                                                                    fill="#F8A51D">
                                                                            </path>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </span>
                                                            </li>
                                                            <li class="creditCardTypes-list-item">
                                                            <span class="cardIcon">
                                                                <div
                                                                        class="icon cardIcon-icon icon--medium"
                                                                        data-test="credit-card-icon-mastercard">
                                                                    <svg
                                                                            aria-labelledby="iconCardMasterTitle"
                                                                            role="img"
                                                                            viewBox="0 0 131.39 86.9"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                        <title
                                                                                id="iconCardMasterTitle">
                                                                            Master</title>
                                                                        <path
                                                                                d="M48.37 15.14h34.66v56.61H48.37z"
                                                                                fill="#ff5f00">
                                                                        </path>
                                                                        <path
                                                                                d="M51.94 43.45a35.94 35.94 0 0113.75-28.3 36 36 0 100 56.61 35.94 35.94 0 01-13.75-28.31z"
                                                                                fill="#eb001b">
                                                                        </path>
                                                                        <path
                                                                                d="M120.5 65.76V64.6h.5v-.24h-1.19v.24h.47v1.16zm2.31 0v-1.4h-.36l-.42 1-.42-1h-.36v1.4h.26V64.7l.39.91h.27l.39-.91v1.06zM123.94 43.45a36 36 0 01-58.25 28.3 36 36 0 000-56.61 36 36 0 0158.25 28.3z"
                                                                                fill="#f79e1b">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                            </span>
                                                            </li>
                                                            <li class="creditCardTypes-list-item">
                                                            <span class="cardIcon">
                                                                <div
                                                                        class="icon cardIcon-icon icon--medium"
                                                                        data-test="credit-card-icon-american-express">
                                                                    <svg
                                                                            aria-labelledby="iconCardAmexTitle"
                                                                            height="104"
                                                                            role="img"
                                                                            viewBox="0 0 156 104"
                                                                            width="156"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                        <title
                                                                                id="iconCardAmexTitle">
                                                                            Amex</title>
                                                                        <g fill="none"
                                                                           fill-rule="evenodd">
                                                                            <path
                                                                                    d="M144 104H12c-6.15 0-12-5.85-12-12V12C0 5.85 5.85 0 12 0h132c6.15 0 12 5.85 12 12v80c0 6.15-5.85 12-12 12z"
                                                                                    fill="#60C7EE">
                                                                            </path>
                                                                            <g fill="#FFF">
                                                                                <path
                                                                                        d="M95.05 46.532v3.68h12.93v4.723H95.05V59.5h12.79l5.244-6.824-4.673-6.144H95.05m-59.707 9.382h5.906l-2.97-8.324-2.94 8.324">
                                                                                </path>
                                                                                <path
                                                                                        d="M128.833 52.77l11.29-15.125h-19.067l-2.536 3.9-2.608-3.9h-46.59l-1.254 4.224-1.264-4.227H31.27L17.72 68.687h17.326l1.31-3.822h3.824l1.345 3.822h73.594l3.28-4.594 3.28 4.594h19.36l-4.867-6.343-7.342-9.574zM83.185 64.744H76.38v-17.66l-5.243 17.66h-6.16l-5.233-17.66v17.66H44.318l-1.345-3.823H33.54l-1.312 3.826h-8.483L33.85 41.588h9.065L52.94 64.56V41.59h10.927l4.214 14.09 4.187-14.09h10.92v23.156zm40.524 0l-5.31-7.44-5.31 7.44H86.72V41.588h27.085l4.76 7.124 4.63-7.124h9.062l-8.37 11.215 9.16 11.94h-9.338z">
                                                                                </path>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </span>
                                                            </li>
                                                            <li class="creditCardTypes-list-item">
                                                            <span class="cardIcon">
                                                                <div
                                                                        class="icon cardIcon-icon icon--medium"
                                                                        data-test="credit-card-icon-discover">
                                                                    <svg
                                                                            aria-labelledby="iconCardDiscoverTitle"
                                                                            height="104"
                                                                            role="img"
                                                                            viewBox="0 0 152 104"
                                                                            width="152"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <title
                                                                                id="iconCardDiscoverTitle">
                                                                            Discover</title>
                                                                        <defs>
                                                                            <rect
                                                                                    height="104"
                                                                                    id="a"
                                                                                    rx="12"
                                                                                    width="152">
                                                                            </rect>
                                                                        </defs>
                                                                        <g fill="none"
                                                                           fill-rule="evenodd">
                                                                            <mask
                                                                                    fill="#fff"
                                                                                    id="b">
                                                                                <use
                                                                                        xlink:href="#a">
                                                                                </use>
                                                                            </mask>
                                                                            <use
                                                                                    fill="#F4F4F4"
                                                                                    xlink:href="#a">
                                                                            </use>
                                                                            <rect
                                                                                    fill="#F4F4F4"
                                                                                    height="104"
                                                                                    mask="url(#b)"
                                                                                    rx="12"
                                                                                    width="152"
                                                                                    x="1">
                                                                            </rect>
                                                                            <path
                                                                                    d="M70.553 104H149c2.21 0 4-1.783 4-4.007V46.597C142.305 71.907 111.28 93.04 70.553 104z"
                                                                                    fill="#F76E20"
                                                                                    mask="url(#b)">
                                                                            </path>
                                                                            <g mask="url(#b)"
                                                                               transform="translate(19 42)">
                                                                                <path
                                                                                        d="M14.763 9.22c0 2.94-.824 5.19-2.47 6.752-1.652 1.56-4.035 2.344-7.15 2.344H.155V.466H5.68c2.876 0 5.106.772 6.69 2.31C13.97 4.31 14.764 6.46 14.764 9.22zm-3.876.1c0-3.834-1.672-5.75-5.004-5.75h-1.99v11.62h1.602c3.596.002 5.392-1.957 5.392-5.87zM17.51 18.316V.466h3.733v17.85H17.51zM34.774 13.608c0 1.616-.57 2.88-1.718 3.81-1.146.927-2.734 1.397-4.773 1.397-1.874 0-3.54-.36-4.987-1.074v-3.516c1.19.543 2.196.915 3.017 1.14.822.218 1.577.327 2.26.327.815 0 1.446-.16 1.882-.475.43-.313.657-.792.657-1.413 0-.35-.095-.66-.292-.933-.188-.277-.474-.54-.85-.79-.374-.25-1.134-.657-2.28-1.21-1.073-.512-1.877-1.008-2.42-1.477-.542-.47-.967-1.018-1.288-1.65-.32-.63-.48-1.363-.48-2.2 0-1.577.526-2.818 1.582-3.72 1.06-.908 2.514-1.356 4.38-1.356.913 0 1.787.108 2.617.328.83.217 1.702.53 2.607.927l-1.203 2.942c-.94-.39-1.72-.67-2.334-.818-.616-.153-1.22-.232-1.81-.232-.71 0-1.254.164-1.627.502-.38.334-.567.768-.567 1.305 0 .335.076.623.23.875.152.25.395.487.728.72.332.23 1.125.647 2.366 1.25 1.643.8 2.77 1.6 3.384 2.4.613.796.92 1.778.92 2.943zM46.018 3.62c-1.406 0-2.49.54-3.263 1.605C41.98 6.295 41.6 7.79 41.6 9.7c0 3.978 1.473 5.97 4.418 5.97 1.238 0 2.727-.305 4.492-.94v3.175c-1.446.613-3.06.916-4.842.916-2.56 0-4.52-.79-5.875-2.367-1.357-1.572-2.034-3.834-2.034-6.782 0-1.855.335-3.48 1.003-4.874.662-1.402 1.623-2.467 2.87-3.212C42.884.84 44.345.467 46.022.467c1.71 0 3.43.42 5.152 1.258l-1.203 3.077c-.663-.317-1.32-.592-1.99-.83-.67-.238-1.322-.352-1.964-.352zM81.828.467h3.77l-5.98 17.85h-4.07L69.578.466h3.772l3.312 10.62c.182.632.38 1.356.572 2.195.19.836.316 1.408.368 1.737.087-.75.387-2.05.902-3.932L81.828.468zM97.072 18.316h-10.14V.466h10.14V3.57h-6.407v3.92h5.964v3.1h-5.965v4.6h6.407v3.126zM105.128 11.467v6.85h-3.732V.466h5.13c2.39 0 4.158.44 5.31 1.326 1.145.882 1.72 2.22 1.72 4.02 0 1.048-.286 1.987-.853 2.802-.57.82-1.376 1.46-2.418 1.925 2.647 4.007 4.37 6.603 5.175 7.773h-4.142l-4.203-6.85-1.987.004zm0-3.077h1.206c1.177 0 2.05-.2 2.612-.596.558-.402.842-1.03.842-1.883 0-.847-.29-1.445-.862-1.806-.573-.36-1.46-.537-2.664-.537h-1.14l.006 4.823z"
                                                                                        fill="#414042">
                                                                                </path>
                                                                                <ellipse
                                                                                        cx="61.024"
                                                                                        cy="9.393"
                                                                                        fill="#F76E20"
                                                                                        rx="8.802"
                                                                                        ry="8.926">
                                                                                </ellipse>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </span>
                                                            </li>
                                                        </label>
                                                    </ul>
                                                </div>

                                                <div class="form-checklist-header pay1 form-checklist-header--selected pay-pal" style="display: flex; align-items: center;">
                                                    <div class="form-field">
                                                        <label for="radio-paypal" class="form-label optimizedCheckout-form-label">
                                                            <img alt="PayPal"
                                                                 class="paymentProviderHeader-img"
                                                                 data-test="payment-method-logo"
                                                                 src="{{asset('assets/img/payment-providers/paypal_commerce_logo.svg')}}">
                                                        </label>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        <div class="dynamic-form-field" id="payPalButton" style="display: none; margin-top: 20px;">
                            <form action="{{ route('processTransaction') }}" method="GET">
                                @csrf
                                <input type="hidden" name="total_sum" value="{{$total_price}}">
                                <input type="hidden" name="ids" value="{{$ids}}">
                                <input type="hidden" name="description" value="Pay this product for card">
                                <button id="checkout-shipping-continue" class="button button--primary optimizedCheckout-buttonPrimary" type="submit">
                                    Pay
                                </button>
                            </form>
                        </div>

                        <div id="card-form" style="margin-top: 30px; display: none;">
                            <form class="billingForm" action="{{ route('processTransaction') }}" method="GET">
                                @csrf
                                <fieldset class="form-fieldset">
                                    <div class="form-body">
                                        <div class="form-fieldset">
                                            <div class="form-body">
                                                <div class="form-body">
                                                    <div class="checkout-address">

                                                        <div class="dynamic-form-field dynamic-form-field--city">
                                                            <div class="form-field">
                                                                <label for="firstNameCard" class="form-label optimizedCheckout-form-label">
                                                                    First Name
                                                                </label>
                                                                <input id="firstNameCard"
                                                                       name="card[first_name]"
                                                                       class="form-input optimizedCheckout-form-input"
                                                                       type="text"
                                                                       value="">
                                                            </div>
                                                        </div>
                                                        <div class="dynamic-form-field dynamic-form-field--province">
                                                            <div class="form-field">
                                                                <label for="lastNameCard" class="form-label optimizedCheckout-form-label">
                                                                    Surname
                                                                </label>
                                                                <input id="lastNameCard"
                                                                       name="card[last_name]"
                                                                       class="form-input optimizedCheckout-form-input"
                                                                       type="text"
                                                                       value="">
                                                            </div>
                                                        </div>
                                                        <div class="dynamic-form-field dynamic-form-field--city">
                                                            <div class="form-field">
                                                                <label for="numberCard" class="form-label optimizedCheckout-form-label">
                                                                    Card Number
                                                                </label>
                                                                <input id="numberCard"
                                                                       name="card[number_card]"
                                                                       placeholder="Card Number"
                                                                       class="ccFormatMonitor form-input optimizedCheckout-form-input"
                                                                       type="text"
                                                                       value="">
                                                            </div>
                                                        </div>
                                                        <div class="dynamic-form-field dynamic-form-field--city">
                                                            <div class="form-field">
                                                                <label for="cardExpiry" class="form-label optimizedCheckout-form-label">
                                                                    Expiry Card
                                                                </label>
                                                                <input
                                                                        type="text"
                                                                        id="inputExpDate"
                                                                        placeholder="MM / YY"
                                                                        class="form-input optimizedCheckout-form-input"
                                                                        maxlength='7'
                                                                        value="">
                                                            </div>
                                                        </div>
                                                        <div class="dynamic-form-field dynamic-form-field--province">
                                                            <div class="form-field">
                                                                <div class="form-field">
                                                                    <label for="ccvCard" class="form-label optimizedCheckout-form-label">
                                                                        CCV
                                                                    </label>
                                                                    <input
                                                                            id="ccvCard"
                                                                            name="card[ccv]"
                                                                            type="password"
                                                                            class="cvv form-input optimizedCheckout-form-input"
                                                                            placeholder="CVV">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="dynamic-form-field">
                                                            <input type="hidden" name="total_sum" value="{{$total_price}}">
                                                            <input type="hidden" name="ids" value="{{$ids}}">
                                                            <input type="hidden" name="description" value="Pay this product for card">
                                                            <button id="checkout-shipping-continue" class="button button--primary optimizedCheckout-buttonPrimary" type="submit">
                                                                Pay
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                            </form>
                        </div>
                    </li>
                </ol>
            </div>
{{--        TODO Order Summary--}}
            <aside class="layout-cart">
                <div class="cart optimizedCheckout-orderSummary">
                    <header class="cart-header">
                        <h3 class="cart-title optimizedCheckout-headingSecondary">Order Summary</h3>
                        <a class="cart-header-link" href="{{route('product.cart')}}" id="cart-edit-link" target="_top">Edit Cart</a>
                    </header>
                    <section class="cart-section optimizedCheckout-orderSummary-cartSection">
                        <h3 class="cart-section-heading optimizedCheckout-contentPrimary">{{$item_count}} Items</h3>
                        <ul aria-live="polite" class="productList">
                            @if(!empty($cookie_prod))
                                @foreach($cookie_prod as $prod)
                                    <li class="productList-item is-visible">
                                        <div class="product" data-test="cart-item">
                                            <figure class="product-column product-figure"><img
                                                    alt="{{$prod['name']}}"
                                                    data-test="cart-item-image"
                                                    @if (!empty($prod['img']))
                                                    src="{{asset('uploads/products/'.$prod['img'])}}"
                                                    @else
                                                    src="{{ asset('assets/img/products/500x659/StudentMembership__07999.1547237277.png') }}"
                                                    @endif>
                                            </figure>
                                            <div class="product-column product-body">
                                                <h5 class="product-title optimizedCheckout-contentPrimary">{{$prod['name']}}</h5>
                                            </div>
                                            <div class="product-column product-actions">
                                                <div class="product-price optimizedCheckout-contentPrimary">{{$prod['quantity']}} * ${{$prod['price']}}</div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="cart-section optimizedCheckout-orderSummary-cartSection">
                        <div class="cart-priceItem optimizedCheckout-contentPrimary cart-priceItem--subtotal">
                            <span class="cart-priceItem-label">
                                <span>Subtotal</span>
                            </span>
                            <span class="cart-priceItem-value">
                                <span>${{$total}}</span>
                            </span>
                        </div>
                        <div class="cart-priceItem optimizedCheckout-contentPrimary">
                            <span class="cart-priceItem-label">
                                <span>Shipping</span>
                            </span>
                            <span class="cart-priceItem-value">
                                <span>--</span>
                            </span>
                        </div>
                        <div class="cart-priceItem optimizedCheckout-contentPrimary">
                            <span class="cart-priceItem-label">
                                <span>Tax</span>
                            </span>
                            <span class="cart-priceItem-value">
                                <span>$0.00</span>
                            </span>
                        </div>
                        <div class="redeemable-label">Coupon/Gift Certificate: @if(isset($promo_name)) {{$promo_name}} @endif </div>
                        <form class="form-fieldset redeemable-entry" action="{{route('product.coupon')}}" method="get">
                            <div class="form-field">
                                <label for="redeemableCode" class="form-label is-srOnly optimizedCheckout-form-label">
                                    Gift Certificate or Coupon Code
                                </label>
                                <div class="form-prefixPostfix">
                                    <input name="couponcode" class="form-input optimizedCheckout-form-input" type="text">
                                    <button id="applyRedeemableButton"
                                            class="button form-prefixPostfix-button--postfix button--tertiary optimizedCheckout-buttonSecondary"
                                            type="submit">
                                        @if(isset($promo_name))
                                            Change
                                        @else
                                            Apply
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <section class="cart-section optimizedCheckout-orderSummary-cartSection">
                        <div class="cart-priceItem optimizedCheckout-contentPrimary cart-priceItem--total">
                            <span class="cart-priceItem-label">
                                <span>Total (USD)</span>
                            </span>
                            <span class="cart-priceItem-value">
                                <span>${{$total_price}}</span>
                            </span>
                        </div>
                    </section>
                </div>
            </aside>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('assets/vendor/svg-injector/dist/svg-injector.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/lazysizes/lazysizes.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/easyzoom/dist/easyzoom.js')}}"></script>

    <script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.sandbox.client_id')}}&currency=USD"></script>

    <script>

        var sel = document.getElementById('countryCodeInput').value;

        function getValue(value) {

            if (sel == "") {
                document.getElementById('addressLine1Input').value = '';
                document.getElementById('addressLine2Input').value = '';
                document.getElementById('countryCodeInput').value = '';
                document.getElementById('firstNameInput').value = '';
                document.getElementById('lastNameInput').value = '';
                document.getElementById('provinceInput').value = '';
                document.getElementById('postCodeInput').value = '';
                document.getElementById('companyInput').value = '';
                document.getElementById('phoneInput').value = '';
                document.getElementById('cityInput').value = '';
            }

            /**
             * Select my address with list
             */

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            if (value != "") {
                $.ajax({
                    type:'GET',
                    url: '{{ url('check/address/') }}' + '/' + value,
                    data: {id : value},
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: (data) => {
                        if (data) {

                            var address = data.data;
                            let addressFirst = document.getElementById('addressLine1Input').value = address['address'];
                            let addressLast = document.getElementById('addressLine2Input').value = address['suite'];
                            let firstName = document.getElementById('firstNameInput').value = address['first_name'];
                            let company = document.getElementById('companyInput').value = address['company_name'];
                            let country = document.getElementById('countryCodeInput').value = address['country'];
                            let lastName = document.getElementById('lastNameInput').value = address['last_name'];
                            let postCode = document.getElementById('postCodeInput').value = address['post_code'];
                            let state = document.getElementById('provinceInput').value = address['state'];
                            let phone = document.getElementById('phoneInput').value = address['phone'];
                            let city = document.getElementById('cityInput').value = address['city'];

                            console.log('Success ajax!')
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }
        }

        $('#sameAsBilling[type="checkbox"]').on('change', function() {
            if ($(this).is(':checked')) {
                document.querySelector('.billingForm').style.display = 'none';
            }
            else {
                document.querySelector('.billingForm').style.display = 'block';
            }
        });


        $('.paymentProviderHeader-cc').on('click', function() {
            document.querySelector('#card-form').style.display = "block";
        });

        $('.pay-pal').on('click', function() {
            document.querySelector('#card-form').style.display = "none";
        });

        $('.pay1').on('click', function() {
            document.querySelector('#payPalButton').style.display = "block";
        });

        $('.paymentProviderHeader-cc').on('click', function() {
            document.querySelector('#payPalButton').style.display = "none";
        });


        /* Init form card exp date */
        var app;

        (function() {
            'use strict';

            app = {
                monthAndSlashRegex: /^\d\d \/ $/, // regex to match "MM / "
                monthRegex: /^\d\d$/, // regex to match "MM"

                el_cardNumber: '.ccFormatMonitor',
                el_expDate: '#inputExpDate',
                el_cvv: '.cvv',
                el_ccUnknown: 'cc_type_unknown',
                el_ccTypePrefix: 'cc_type_',
                el_monthSelect: '#monthSelect',
                el_yearSelect: '#yearSelect',

                cardTypes: {
                    'American Express': {
                        name: 'American Express',
                        code: 'ax',
                        security: 4,
                        pattern: /^3[47]/,
                        valid_length: [15],
                        formats: {
                            length: 15,
                            format: 'xxxx xxxxxxx xxxx'
                        }
                    },
                    'Visa': {
                        name: 'Visa',
                        code: 'vs',
                        security: 3,
                        pattern: /^4/,
                        valid_length: [16],
                        formats: {
                            length: 16,
                            format: 'xxxx xxxx xxxx xxxx'
                        }
                    },
                    'Maestro': {
                        name: 'Maestro',
                        code: 'ma',
                        security: 3,
                        pattern: /^(50(18|20|38)|5612|5893|63(04|90)|67(59|6[1-3])|0604)/,
                        valid_length: [16],
                        formats: {
                            length: 16,
                            format: 'xxxx xxxx xxxx xxxx'
                        }
                    },
                    'Mastercard': {
                        name: 'Mastercard',
                        code: 'mc',
                        security: 3,
                        pattern: /^5[1-5]/,
                        valid_length: [16],
                        formats: {
                            length: 16,
                            format: 'xxxx xxxx xxxx xxxx'
                        }
                    }
                }
            };

            app.addListeners = function() {
                $(app.el_expDate).on('keydown', function(e) {
                    app.removeSlash(e);
                });

                $(app.el_expDate).on('keyup', function(e) {
                    app.addSlash(e);
                });

                $(app.el_expDate).on('blur', function(e) {
                    app.populateDate(e);
                });

                $(app.el_cvv +', '+ app.el_expDate).on('keypress', function(e) {
                    return e.charCode >= 48 && e.charCode <= 57;
                });
            };

            app.addSlash = function (e) {
                var isMonthEntered = app.monthRegex.exec(e.target.value);
                if (e.key >= 0 && e.key <= 9 && isMonthEntered) {
                    e.target.value = e.target.value + " / ";
                }
            };

            app.removeSlash = function(e) {
                var isMonthAndSlashEntered = app.monthAndSlashRegex.exec(e.target.value);
                if (isMonthAndSlashEntered && e.key === 'Backspace') {
                    e.target.value = e.target.value.slice(0, -3);
                }
            };

            app.populateDate = function(e) {
                var month, year;

                if (e.target.value.length == 7) {
                    month = parseInt(e.target.value.slice(0, -5));
                    year = "20" + e.target.value.slice(5);

                    if (app.checkMonth(month)) {
                        $(app.el_monthSelect).val(month);
                    } else {
                        $(app.el_monthSelect).val(0);
                    }

                    if (app.checkYear(year)) {
                        $(app.el_yearSelect).val(year);
                    } else {
                        $(app.el_yearSelect).val(0);
                    }

                }
            };

            app.checkMonth = function(month) {
                if (month <= 12) {
                    var monthSelectOptions = app.getSelectOptions($(app.el_monthSelect));
                    month = month.toString();
                    if (monthSelectOptions.includes(month)) {
                        return true;
                    }
                }
            };

            app.checkYear = function(year) {
                var yearSelectOptions = app.getSelectOptions($(app.el_yearSelect));
                if (yearSelectOptions.includes(year)) {
                    return true;
                }
            };

            app.getSelectOptions = function(select) {
                var options = select.find('option');
                var optionValues = [];
                for (var i = 0; i < options.length; i++) {
                    optionValues[i] = options[i].value;
                }
                return optionValues;
            };

            app.setMaxLength = function ($elem, length) {
                if($elem.length && app.isInteger(length)) {
                    $elem.attr('maxlength', length);
                }else if($elem.length){
                    $elem.attr('maxlength', '');
                }
            };

            app.isInteger = function(x) {
                return (typeof x === 'number') && (x % 1 === 0);
            };

            app.createExpDateField = function() {
                $(app.el_monthSelect +', '+ app.el_yearSelect).hide();
                $(app.el_monthSelect).parent().prepend('<input type="text" class="ccFormatMonitor">');
            };


            app.isValidLength = function(cc_num, card_type) {
                for(var i in card_type.valid_length) {
                    if (cc_num.length <= card_type.valid_length[i]) {
                        return true;
                    }
                }
                return false;
            };

            app.getCardType = function(cc_num) {
                for(var i in app.cardTypes) {
                    var card_type = app.cardTypes[i];
                    if (cc_num.match(card_type.pattern) && app.isValidLength(cc_num, card_type)) {
                        return card_type;
                    }
                }
            };

            app.getCardFormatString = function(cc_num, card_type) {
                for(var i in card_type.formats) {
                    var format = card_type.formats[i];
                    if (cc_num.length <= format.length) {
                        return format;
                    }
                }
            };

            app.formatCardNumber = function(cc_num, card_type) {
                var numAppendedChars = 0;
                var formattedNumber = '';
                var cardFormatIndex = '';

                if (!card_type) {
                    return cc_num;
                }

                var cardFormatString = app.getCardFormatString(cc_num, card_type);
                for(var i = 0; i < cc_num.length; i++) {
                    cardFormatIndex = i + numAppendedChars;
                    if (!cardFormatString || cardFormatIndex >= cardFormatString.length) {
                        return cc_num;
                    }

                    if (cardFormatString.charAt(cardFormatIndex) !== 'x') {
                        numAppendedChars++;
                        formattedNumber += cardFormatString.charAt(cardFormatIndex) + cc_num.charAt(i);
                    } else {
                        formattedNumber += cc_num.charAt(i);
                    }
                }

                return formattedNumber;
            };

            app.monitorCcFormat = function($elem) {
                var cc_num = $elem.val().replace(/\D/g,'');
                var card_type = app.getCardType(cc_num);
                $elem.val(app.formatCardNumber(cc_num, card_type));
                app.addCardClassIdentifier($elem, card_type);
            };

            app.addCardClassIdentifier = function($elem, card_type) {
                var classIdentifier = app.el_ccUnknown;
                if (card_type) {
                    classIdentifier = app.el_ccTypePrefix + card_type.code;
                    app.setMaxLength($(app.el_cvv), card_type.security);
                } else {
                    app.setMaxLength($(app.el_cvv));
                }

                if (!$elem.hasClass(classIdentifier)) {
                    var classes = '';
                    for(var i in app.cardTypes) {
                        classes += app.el_ccTypePrefix + app.cardTypes[i].code + ' ';
                    }
                    $elem.removeClass(classes + app.el_ccUnknown);
                    $elem.addClass(classIdentifier);
                }
            };


            app.init = function() {

                $(document).find(app.el_cardNumber).each(function() {
                    var $elem = $(this);
                    if ($elem.is('input')) {
                        $elem.on('input', function() {
                            app.monitorCcFormat($elem);
                        });
                    }
                });

                app.addListeners();

            }();

        })();

    </script>
@endsection
