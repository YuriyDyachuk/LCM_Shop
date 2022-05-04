@extends('admin.layouts.master')

@section('title') {{ $pageTitle }} @endsection

@section('css')
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
                    <form action="{{ !empty($item->id) ? route('admin.discount.update', ['discount' => $item->id]) : route('admin.discount.store') }}" method="POST" id="js-discount-edit-form" class="outer-repeater">
                        @csrf
                        @method(!empty($item->id) ? 'PUT' : 'POST')
                        <input type="hidden" value="{{ $item->id }}" name="item_id">
                        <input type="hidden" value="1" name="is_apply">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="discount_name" class="form-label">Rule name*:</label>
                                    <input name="name" value="{{ old('name', $item->name) }}" type="text" class="form-control" id="discount_name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-lg-2">
                                <div class="mb-3">
                                    <label for="discount_priority" class="form-label">Priority*:</label>
                                    <input name="priority" value="{{ old('priority', $item->priority) }}" type="number" class="form-control" id="discount_priority">
                                </div>
                            </div>
                            <div class="col-sm-5 col-lg-3 offset-sm-1">
                                <div class="mb-3">
                                    <label class="form-label">Active:</label>
                                    <div>
                                        <input name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }} type="checkbox" id="discount_active" switch="none" />
                                        <label for="discount_active" data-on-label="" data-off-label=""></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Membership type*:</label>
                                    <select name="membership_type_id" class="js-membership-type-select2" style="width: 100%" data-minimum-results-for-search="6">
                                        <option></option>
                                        <option value="1">All members</option>
                                        <option value="2">Student Membership</option>
                                        <option value="3">Academic Membership</option>
                                        <option value="4">Individual Membership</option>
                                    </select>
                                    <div><small class="form-text text-muted">Coming soon...</small></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="product_apply_type" class="form-label">Apply to*:</label>
                                    <select id="product_apply_type" name="product_apply_type" class="js-product-apply-select2" style="width: 100%">
                                        <option></option>
                                        @foreach($productApplyTypes as $productApplyType=>$productApplyTypeName)
                                            <option value="{{ $productApplyType }}" {{ old('product_apply_type', $item->product_apply_type) == $productApplyType ? 'selected' : '' }}>{{ $productApplyTypeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="js-products-box" class="repeater mb-3 d-none">
                            <label class="form-label">Product(s):</label>
                            <div data-repeater-list="applyProducts">
                                <p class="card-title-desc mb-3"></p>
                                @foreach(old('applyProducts', $applyProducts) as $discountProduct)
                                    @foreach($discountProduct as $discountProductId)
                                <div class="row flex-nowrap align-items-center" data-repeater-item>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <select name="item_id" class="js-add-item-select2" style="width: 100%">
                                                <option></option>
                                                @foreach($products as $productId=>$productName)
                                                <option {{ $discountProductId == $productId ? 'selected' : '' }} value="{{ $productId }}">{{ $productName }}</option>
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

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="discount_type" class="form-label">Discount Type*:</label>
                                    <select name="type" id="discount_type" class="js-discount-type-select2" style="width: 100%">
                                        <option></option>
                                        @foreach($types as $typeCode=>$typeName)
                                        <option value="{{ $typeCode }}" {{ old('type', $item->type) == $typeCode ? 'selected' : '' }}>{{ $typeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="discount-type-wrap d-none" data-discount-type="{{ $typeCodeProductPricePercentage }}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="discount_type_percentage" class="form-label">Percentage of product price:</label>
                                        <div class="input-group">
                                            <input name="rule[{{ $typeCodeProductPricePercentage }}]" value="{{ old('rule.' . $typeCodeProductPricePercentage, $rule[$typeCodeProductPricePercentage]) }}" type="number" min="1" max="90" class="form-control" id="discount_type_percentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="discount-type-wrap d-none" data-discount-type="{{ $typeCodeProductPriceFixed }}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="discount_type_fixed_price" class="form-label">Product price with discount:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input name="rule[{{ $typeCodeProductPriceFixed }}]" value="{{ old('rule.' . $typeCodeProductPriceFixed, $rule[$typeCodeProductPriceFixed]) }}" type="number" min="1" class="form-control" id="discount_type_fixed_price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="discount-type-wrap d-none" data-discount-type="{{ $typeCodeProductQuantityBased }}">
                            <div class="row mb-4 repeater">
                                <div class="col-12">
                                    <div class="table-responsive mb-2">
                                        <table class="table table-fit align-middle mb-2 mb-md-0">
                                            <thead class="table-light">
                                            <tr class="align-middle">
                                                <th>Minimum Quantity*:</th>
                                                <th>Maximum Quantity*:</th>
                                                <th>
                                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                                        <div>Percentage*, %:</div>
                                                        <div class="font-size-22 text-body ms-3" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Refers to the percentage, not the price of the product.">
                                                            <i class="mdi mdi-information"></i>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th style="width:46px"></th>
                                            </tr>
                                            </thead>
                                            <tbody data-repeater-list="rule[{{ $typeCodeProductQuantityBased }}]">
                                            @foreach(old('rule.' . $typeCodeProductQuantityBased, $rule[$typeCodeProductQuantityBased]) as $ruleItem)
                                            <tr data-repeater-item>
                                                <td class="border-0">
                                                    <div style="max-width: 130px;">
                                                        <input name="quantity_min" value="{{ $ruleItem['quantity_min'] }}" type="number" min="1" class="form-control">
                                                    </div>
                                                </td>
                                                <td class="border-0">
                                                    <div style="max-width: 130px;">
                                                        <input name="quantity_max" value="{{ $ruleItem['quantity_max'] }}" type="number" min="1" class="form-control">
                                                    </div>
                                                </td>
                                                <td class="border-0">
                                                    <div style="max-width: 130px;">
                                                        <input name="percentage" value="{{ $ruleItem['percentage'] }}" type="number" min="1" class="form-control">
                                                    </div>
                                                </td>
                                                <td class="border-0">
                                                    <div class="font-size-22 text-body" role="button" data-repeater-delete>
                                                        <i class="mdi mdi-minus-circle-outline"></i>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <button data-repeater-create type="button" class="btn btn-sm btn-success waves-effect waves-light">Add<i class="mdi mdi-plus ms-1"></i></button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md me-3 mt-2 mb-1">Apply</button>
                            <a href="{{ route('admin.discount.list') }}" class="btn btn-secondary w-md mt-2 mb-1">Cancel</a>
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
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- form repeater js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script type="text/javascript">
        window.typeCodeProductPriceFixed = "{{ $typeCodeProductPriceFixed }}";
        window.productApplyTypeProductSeveral = "{{ $productApplyTypeProductSeveral }}";
        window.productApplyTypeAllProduct = "{{ $productApplyTypeAllProduct }}";
    </script>
    <script src="{{ URL::asset('admin-panel/discount/edit.js' . $makeupVer) }}"></script>

@endsection
