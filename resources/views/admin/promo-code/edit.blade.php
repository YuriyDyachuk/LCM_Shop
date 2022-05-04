@extends('admin.layouts.master')

@section('title') {{ $pageTitle }} @endsection

@section('css')
    <!-- bootstrap-datepicker css -->
    <link href="{{ URL::asset('admin-panel/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert-->
    <link href="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $pageTitle }}</h4>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ !empty($item->id) ? route('admin.promo-code.update', ['coupon' => $item->id]) : route('admin.promo-code.store') }}" method="POST" id="js-promo-code-edit-form" class="outer-repeater">
                        @csrf
                        @method(!empty($item->id) ? 'PUT' : 'POST')
                        <input type="hidden" value="{{ $item->id }}" name="item_id">
                        <input type="hidden" value="1" name="is_apply">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="promo_code" class="form-label">Coupon code*:</label>
                                    <input value="{{ old('code', $item->code) }}" name="code" type="text" class="form-control" id="promo_code">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="promo_code_description" class="form-label">Description:</label>
                                    <textarea name="description" rows="2" class="form-control" id="promo_code_description">{{ old('description', $item->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-lg-2">
                                <div class="mb-3">
                                    <label for="promo_code_amount" class="form-label">Promo code amount*:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input value="{{ old('amount', $item->amount) }}" name="amount" type="number" min="1" class="form-control" id="promo_code_amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-lg-3 offset-sm-1">
                                <div class="mb-3">
                                    <label class="form-label">Active:</label>
                                    <div>
                                        <input name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} type="checkbox" id="promo_code_active" switch="none" />
                                        <label for="promo_code_active" data-on-label="" data-off-label=""></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="discount_name" class="form-label">Apply to*:</label>
                                    <select name="apply_type" class="js-apply-select2" data-placeholder="Choice" style="width: 100%">
                                        @foreach($applyTypes as $applyType=>$applyTypeName)
                                        <option value="{{ $applyType }}" {{ old('apply_type', $item->apply_type) == $applyType ? 'selected' : '' }}>{{ $applyTypeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="promocode-apply-wrap d-none" data-promocode-apply="{{ $applyTypeCategories }}">
                            <div class="repeater mb-3">
                                <label class="form-label">Category(-ies):</label>
                                <div data-repeater-list="applies[{{ $applyTypeCategories }}]">
                                    @foreach(old('applies.' . $applyTypeCategories, $applies[$applyTypeCategories]) as $applyItems)
                                        @foreach($applyItems as $applyItemId)
                                    <div class="row flex-nowrap align-items-center" data-repeater-item>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <select name="item_id" class="js-add-item-select2" style="width: 100%">
                                                    <option></option>
                                                    @foreach($productCategories as $productCategoryId=>$productCategoryName)
                                                    <option {{ $applyItemId == $productCategoryId ? 'selected' : '' }} value="{{ $productCategoryId }}">{{ $productCategoryName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="d-flex mb-3">
                                                <div class="font-size-22 text-body" role="button" data-repeater-delete>
                                                    <i class="mdi mdi-minus-circle-outline"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                    @endforeach

                                </div>
                                <button data-repeater-create type="button" class="btn btn-sm btn-success waves-effect waves-light">Add<i class="mdi mdi-plus ms-1"></i></button>
                            </div>
                        </div>

                        <div class="promocode-apply-wrap d-none" data-promocode-apply="{{ $applyTypeProducts }}">
                            <div class="repeater mb-3">
                                <label class="form-label">Product(s):</label>
                                <div data-repeater-list="applies[{{ $applyTypeProducts }}]">
                                    @foreach(old('applies.' . $applyTypeProducts, $applies[$applyTypeProducts]) as $applyItems)
                                        @foreach($applyItems as $applyItemId)
                                    <div class="row flex-nowrap align-items-center" data-repeater-item>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <select name="item_id" class="js-add-item-select2" style="width: 100%">
                                                    <option></option>
                                                    @foreach($products as $productId=>$productName)
                                                        <option {{ $applyItemId == $productId ? 'selected' : '' }} value="{{ $productId }}">{{ $productName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="d-flex mb-3">
                                                <div class="font-size-22 text-body" role="button" data-repeater-delete>
                                                    <i class="mdi mdi-minus-circle-outline"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                    @endforeach
                                </div>
                                <button data-repeater-create type="button" class="btn btn-sm btn-success waves-effect waves-light">Add<i class="mdi mdi-plus ms-1"></i></button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="promo_code_expiry_date" class="form-label">Expiry date:</label>
                                    <div class="input-group" id="expiry_datepicker">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        <input value="{{ old('expiry_date_at', $item->expiryDateAtDisplay) }}" name="expiry_date_at" type="text" class="form-control" id="promo_code_expiry_date" placeholder="yyyy-mm-dd"
                                               data-date-format="yyyy-mm-dd" data-date-container='#expiry_datepicker'
                                               data-provide="datepicker" data-date-autoclose="true">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md me-3 mt-2 mb-1">Apply</button>
                            <a href="{{ route('admin.promo-code.list') }}" class="btn btn-secondary w-md mt-2 mb-1">Cancel</a>
                        </div>

                    </form>
                    <!-- end: Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('script')
    <script src="{{ URL::asset('admin-panel/assets/libs/jquery-validation/jquery-validation.min.js') }}"></script>
    <!-- bootstrap-datepicker js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- form repeater js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('admin-panel/promo-code/edit.js' . $makeupVer) }}"></script>

@endsection
