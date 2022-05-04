@extends('admin.layouts.master')

@section('title') Place new order @endsection

@section('css')
    <!-- bootstrap-datepicker css -->
    <link href="{{ URL::asset('admin-panel/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert-->
    <link href="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap-touchspin css -->
    <link href="{{ URL::asset('admin-panel/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Place new order</h4>

            <div>
                <a href="#" class="btn btn-primary btn-rounded waves-effect waves-light my-2"><i class="mdi mdi-content-save-outline me-1"></i> Save</a>
            </div>

        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                        <div class="od-header">
                            <h4 class="od-header__title card-title my-0">General</h4>
                        </div>

                        <div class="mt-3">
                            <label for="select_customer" class="form-label">Customer:</label>
                            <div class="pe-lg-4 pe-xxl-5">
                                <select class="form-control js-customer-select2" style="width: 100%;" id="select_customer">
                                    <option value=""></option>
                                    <option value="1">Barry Dick</option>
                                    <option value="2">Clark Benson</option>
                                    <option value="3">Dustin Moser</option>
                                    <option value="4">Jacob Hunter</option>
                                    <option value="5">Jamal Burnett</option>
                                    <option value="6">Juan Mitchell</option>
                                    <option value="7">Neal Matthews</option>
                                    <option value="8">Ronald Taylor</option>
                                    <option value="9">Tomas Sample</option>
                                    <option value="10">William Cruz</option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-3">
                            <a href="javascript:void(0);" class="btn btn-sm btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addNewCustomerModal">Add new customer<i class="mdi mdi-plus ms-1"></i></a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                        <div class="od-header">
                            <h4 class="od-header__title card-title my-0 me-2">Billing</h4>
                            <a href="javascript:void(0);" class="text-body waves-effect waves-light od-header__edit" data-bs-toggle="modal" data-bs-target="#addBillingAddressModal"><i class="mdi mdi-pencil font-size-15"></i></a>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="od-header">
                            <h4 class="od-header__title card-title my-0 me-2">Shipping</h4>
                            <a href="javascript:void(0);" class="text-body waves-effect waves-light od-header__edit" data-bs-toggle="modal" data-bs-target="#addShippingAddressModal"><i class="mdi mdi-pencil font-size-15"></i></a>
                        </div>

                    </div>
                </div>

            </div>
        </div> <!-- end card -->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="td-fit">Image</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th colspan="2">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-wrap-reverse">

                    <table class="table mb-0 ms-auto table-fit">
                        <tr>
                            <td class="border-0 text-end">
                                <strong>Items Subtotal:</strong>
                            </td>
                            <td class="border-0 text-end">$0.00</td>
                        </tr>
                        <tr>
                            <td class="border-0 text-end">
                                <strong>Shipping:</strong>
                            </td>
                            <td class="border-0 text-end">$0.00</td>
                        </tr>
                        <tr>
                            <td class="border-0 text-end">
                                <strong>Total:</strong>
                            </td>
                            <td class="border-0 text-end">
                                <h4 class="m-0">$0.00</h4>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row justify-content-between">
                    <div class="col-sm-auto">
                        <a href="javascript:void(0);" class="btn btn-primary mt-3 me-3" data-bs-toggle="modal" data-bs-target="#addItemsModal">Add item(s)</a>
                        <a href="javascript:void(0);" class="btn btn-primary mt-3 me-3" data-bs-toggle="modal" data-bs-target="#applyCouponModal">Apply coupon</a>
                        <a href="javascript:void(0);" class="btn btn-secondary mt-3">Refund</a>
                    </div> <!-- end col -->
                    <div class="col-sm-auto">
                        <div class="text-sm-end mt-2 mt-sm-0">
                            <a href="javascript:void(0);" class="btn btn-primary mt-3">Recalculate</a>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<!-- Add Billing Address modal -->
<div class="modal fade" id="addBillingAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add billing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="mdi mdi-content-copy me-1"></i> Copy from shipping address </a>
                </div>
                <div class="mb-3">
                    <label for="ba_email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="ba_email">
                </div>

                <div class="mb-3">
                    <label for="ba_phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="ba_phone">
                </div>

                <div class="mb-3">
                    <label for="ba_state" class="form-label">State:</label>
                    <select id="ba_state" class="js-state-select2" style="width: 100%" data-dropdown-parent="#addBillingAddressModal">
                        <option value=""></option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
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
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ba_city" class="form-label">City:</label>
                    <select id="ba_city" class="js-city-select2" style="width: 100%" data-dropdown-parent="#addBillingAddressModal">
                        <option></option>
                        <option value="1">Abbeville</option>
                        <option value="2">Adamsville</option>
                        <option value="3">Addison</option>
                        <option value="4">Akron</option>
                        <option value="5">Alabaster</option>
                        <option value="6">Albertville</option>
                        <option value="7">Alexander City</option>
                        <option value="8">Aliceville</option>
                        <option value="9">SpringField</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ba_street" class="form-label">Street:</label>
                    <input type="text" class="form-control" id="ba_street">
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="mb-3">
                            <label for="ba_zip" class="form-label">Zip:</label>
                            <input type="text" class="form-control" id="ba_zip">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ba_payment_method" class="form-label">Payment method:</label>
                    <select id="ba_payment_method" class="select2-search-disable" style="width: 100%" data-dropdown-parent="#addBillingAddressModal">
                        <option value="0">N/A</option>
                        <option value="1">Payment method 1</option>
                        <option value="2">Payment method 2</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="ba_transaction_id" class="form-label">Transaction ID:</label>
                    <input type="text" class="form-control" id="ba_transaction_id">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add Shipping Address modal -->
<div class="modal fade" id="addShippingAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add shipping address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="mdi mdi-content-copy me-1"></i> Copy from billing address </a>
                </div>
                <div class="mb-3">
                    <label for="sa_email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="sa_email">
                </div>

                <div class="mb-3">
                    <label for="sa_phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="sa_phone">
                </div>

                <div class="mb-3">
                    <label for="sa_state" class="form-label">State:</label>
                    <select id="sa_state" class="js-state-select2" style="width: 100%" data-dropdown-parent="#addShippingAddressModal">
                        <option value=""></option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
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
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sa_city" class="form-label">City:</label>
                    <select id="sa_city" class="js-city-select2" style="width: 100%" data-dropdown-parent="#addShippingAddressModal">
                        <option></option>
                        <option value="1">Abbeville</option>
                        <option value="2">Adamsville</option>
                        <option value="3">Addison</option>
                        <option value="4">Akron</option>
                        <option value="5">Alabaster</option>
                        <option value="6">Albertville</option>
                        <option value="7">Alexander City</option>
                        <option value="8">Aliceville</option>
                        <option value="9">SpringField</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sa_street" class="form-label">Street:</label>
                    <input type="text" class="form-control" id="sa_street">
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="mb-3">
                            <label for="sa_zip" class="form-label">Zip:</label>
                            <input type="text" class="form-control" id="sa_zip">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="sa_notes" class="form-label">Customer provided note:</label>
                    <textarea id="sa_notes" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Apply coupon modal -->
<div class="modal fade" id="applyCouponModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="order_coupon" class="form-label">Coupon code:</label>
                    <input type="text" class="form-control" id="order_coupon">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-light">Save</button>
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add item(s) modal -->
<div class="modal fade" id="addItemsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="addItemsForm">
            <div class="modal-header">
                <h5 class="modal-title">Add item(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="repeater mb-2">
                    <div data-repeater-list="group-add-item">
                        <div data-repeater-item>
                            <div class="mb-3">
                                <select class="js-add-item-select2" style="width: 100%">
                                    <option></option>
                                    <option value="1">Academic Membership</option>
                                    <option value="2">Don’t Conform, Transform!</option>
                                    <option value="3">Individual Membership</option>
                                    <option value="4">LCI Special Edition: This Is Lean</option>
                                    <option value="5">Make a Card</option>
                                    <option value="6">Parade of Trades</option>
                                    <option value="7">Silent Squares</option>
                                    <option value="8">Student Membership</option>
                                    <option value="9">Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button data-repeater-create type="button" class="btn btn-sm btn-success waves-effect waves-light">Add<i class="mdi mdi-plus ms-1"></i></button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add new customer modal -->
<div class="modal fade" id="addNewCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nc_first_name" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="nc_first_name">
                </div>

                <div class="mb-3">
                    <label for="nc_last_name" class="form-label">Last name:</label>
                    <input type="text" class="form-control" id="nc_last_name">
                </div>

                <div class="mb-3">
                    <label for="nc_email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="nc_email">
                </div>

                <div class="mb-3">
                    <label for="nc_phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="nc_phone">
                </div>

                <div class="mb-3">
                    <label for="nc_state" class="form-label">State:</label>
                    <select id="nc_state" class="js-state-select2" style="width: 100%" data-dropdown-parent="#addShippingAddressModal">
                        <option value=""></option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
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
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nc_city" class="form-label">City:</label>
                    <select id="nc_city" class="js-city-select2" style="width: 100%" data-dropdown-parent="#addShippingAddressModal">
                        <option></option>
                        <option value="1">Abbeville</option>
                        <option value="2">Adamsville</option>
                        <option value="3">Addison</option>
                        <option value="4">Akron</option>
                        <option value="5">Alabaster</option>
                        <option value="6">Albertville</option>
                        <option value="7">Alexander City</option>
                        <option value="8">Aliceville</option>
                        <option value="9">SpringField</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="mb-3">
                            <label for="nc_zip" class="form-label">Zip:</label>
                            <input type="text" class="form-control" id="nc_zip">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="nc_membership_type" class="form-label">Membership type:</label>
                    <select id="nc_membership_type" class="select2" style="width: 100%" data-placeholder="" data-minimum-results-for-search="6" data-dropdown-parent="#addShippingAddressModal">
                        <option value=""></option>
                        <option value="1">Membership type 1</option>
                        <option value="2">Membership type 2</option>
                        <option value="3">Membership type 3</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
    <!-- bootstrap-datepicker js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- bootstrap-touchspin -->
    <script src="{{ URL::asset('admin-panel/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <!-- form repeater js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Select customer
            $('.js-customer-select2').select2({
                placeholder: '',
                alowClear: true
            });
            // Warning Message on Delete
            $('.js-delete-order').click(function (e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it",
                    preConfirm: function (result) {
                        // Ajax request
                    },
                }).then(function (result) {
                    console.log('result.value', result.value);
                    if (result.value) {
                        let el = e.target;
                        location.href = $(el).attr('href');
                    } else if ( result.dismiss === Swal.DismissReason.cancel ) {
                        // console.log('canceled');
                    }
                });
            });

            $('.js-delete-product').click(function () {
                Swal.fire({
                    title: "Are you sure?",
                    text: "The product will be removed from the order",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Confirm",
                    preConfirm: function (result) {
                        // Ajax request
                    },
                }).then(function (result) {
                    console.log('result.value', result.value);
                    if (result.value) {
                        Swal.fire("", "The product has been removed from the order", "success");
                    }
                });
            });

            //Bootstrap-TouchSpin
            $('.js-product-count').TouchSpin({
                verticalbuttons: true
            });

            // Select2
            $('.js-state-select2').select2({
                placeholder: ''
            });

            $('.js-city-select2').select2({
                placeholder: '',
                minimumResultsForSearch: 6
            });

            // Add item(s)
            let addItemSelect2Options = {
                placeholder: '',
                dropdownParent: $('#addItemsModal'),
                allowClear: true
            }
            $('.repeater').find('select').select2(addItemSelect2Options);

            $('.repeater').repeater({
                show: function () {
                    $(this).slideDown();
                    $('.repeater').find('select').next('.select2-container').remove();
                    $('.repeater').find('select').select2(addItemSelect2Options);
                },

                ready: function (setIndexes) {

                }
            });

            $('#addItemsForm').on("reset",function(e){
                var targetJQForm = $(e.target);

                setTimeout((function(){
                    this.find('select').trigger('change');
                }).bind(targetJQForm),0);

                $('[data-repeater-item]').slice(1).empty();
            });

        });

    </script>
@endsection
