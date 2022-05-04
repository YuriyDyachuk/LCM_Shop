@extends('admin.layouts.master')

@section('title') {{ $pageTitle }} @endsection

@section('css')

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
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#customer_basic" role="tab">
                                Basic Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#customer_address" role="tab">
                                Address
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#customer_password" role="tab">
                                Password
                            </a>
                        </li>
                    </ul>
                    <!-- Form -->
                    <form action="{{ !empty($item->id) ? route('admin.customer.update', ['customer' => $item->id]) : route('admin.customer.store') }}" method="POST" id="js-customer-edit-form">
                        @csrf
                        @method(!empty($item->id) ? 'PUT' : 'POST')
                        <input type="hidden" value="{{ $item->id }}" name="item_id">
                        <input type="hidden" value="1" name="is_apply">

                        <div class="tab-content px-0 pt-4 pb-0">
                            <div class="tab-pane active" id="customer_basic" role="tabpanel">
                                <h4 class="card-title">Basic Information</h4>
                                <p class="card-title-desc mb-3">Fill information below</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_first_name" class="form-label">First name*:</label>
                                            <input value="{{ old('first_name', $item->first_name) }}" name="first_name" type="text" class="form-control" id="nc_first_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_last_name" class="form-label">Last name*:</label>
                                            <input value="{{ old('last_name', $item->last_name) }}" name="last_name" type="text" class="form-control" id="nc_last_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_email" class="form-label">Email*:</label>
                                            <input value="{{ old('email', $item->email) }}" name="email" type="text" class="form-control" id="nc_email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_phone" class="form-label">Phone*:</label>
                                            <input value="{{ old('phone', $item->phone) }}" name="phone" type="text" class="form-control" id="nc_phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_membership_type" class="form-label">Membership type:</label>
                                            <select disabled id="nc_membership_type" class="select2" style="width: 100%" data-placeholder="Coming soon..." data-minimum-results-for-search="6">
                                                <option value=""></option>
                                                <option value="1">Membership type 1</option>
                                                <option value="2">Membership type 2</option>
                                                <option value="3">Membership type 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="customer_address" role="tabpanel">
                                <h4 class="card-title">Address Information</h4>
                                <p class="card-title-desc mb-3">Fill information below</p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_state" class="form-label">State:</label>
                                            <select name="address[state_name]" id="nc_state" class="js-state-select2" style="width: 100%">
                                                <option value=""></option>
                                                @foreach($states as $stateName)
                                                    <option value="{{ $stateName }}" {{ old('address.state_name', $item->address->state_name) == $stateName ? 'selected' : '' }}>{{ $stateName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_city" class="form-label">City:</label>
                                            <input value="{{ old('address.city_name', $item->address->city_name) }}" name="address[city_name]" type="text" class="form-control" id="nc_city">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <div class="mb-3">
                                            <label for="nc_zip" class="form-label">Zip:</label>
                                            <input value="{{ old('address.zip_code', $item->address->zip_code) }}" name="address[zip_code]" type="text" class="form-control" id="nc_zip">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_address" class="form-label">Address:</label>
                                            <textarea name="address[address]" id="nc_address" rows="2" class="form-control">{{ old('address.address', $item->address->address) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="tab-pane" id="customer_password" role="tabpanel">
                                <h4 class="card-title">Password Information</h4>
                                <p class="card-title-desc mb-3">Fill information below</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_password" class="form-label">Password{{ empty($item->id) ? '*' : '' }}:</label>
                                            <input name="password" type="password" class="form-control" id="nc_password">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nc_confirm_password" class="form-label">Confirm Password{{ empty($item->id) ? '*' : '' }}:</label>
                                            <input name="password_confirmation" type="password" class="form-control" id="nc_confirm_password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md me-3 mt-2 mb-1">Apply</button>
                            <a href="{{ route('admin.customer.list') }}" class="btn btn-secondary w-md mt-2 mb-1">Cancel</a>
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
    <script src="{{ URL::asset('admin-panel/assets/libs/inputmask/inputmask.min.js') }}"></script>

    <script src="{{ URL::asset('admin-panel/customer/edit.js' . $makeupVer) }}"></script>

@endsection
