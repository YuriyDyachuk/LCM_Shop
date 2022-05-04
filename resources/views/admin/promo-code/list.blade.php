@extends('admin.layouts.master')

@section('title') Promo Codes @endsection

@section('css')
    <!-- bootstrap-datepicker css -->
    <link href="{{ URL::asset('admin-panel/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert-->
    <link href="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ URL::asset('admin-panel/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Promo Codes</h4>
                <a href="{{ route('admin.promo-code.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2"><i class="mdi mdi-plus me-1"></i> Add promo code</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card list-wrap-card">
                <div class="card-body">
                    <!-- Filters -->

                    <div class="row align-items-end mb-2">
                        <div class="col-xl col-sm-auto">
                            <div class="form-group mt-0 mb-3">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search..." id="listSearch">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl col-sm-auto me-sm-auto">
                            <div class="form-group mt-0 mb-3">
                                <select class="form-control select2-search-disable" style="width: 150px;" id="js-filter-select-status">
                                    <option value="">All Statuses</option>
                                    <option value="active">Active</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl col-sm-auto">
                            <div class="form-group mt-0 mb-0 mb-sm-3 text-sm-end">
                                <button type="button" class="btn btn-secondary js-table-bulk" id="bulkDelete" disabled>Delete</button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Filters -->

                    <!-- Table -->
                    <div class="table-responsive-sm">
                        <table class="table align-middle table-check" id="promoCodesTable" style="width: 100%">
                            <thead class="table-light">
                            <tr>
                                <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                <th style="width: 20px;" class="align-middle all">
                                    <div class="form-check font-size-16">
                                        <input {{ empty($items) ? 'disabled' : '' }} class="form-check-input" type="checkbox" autocomplete="off" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="align-middle all">Promo code</th>
                                <th id="js-filter-status" class="align-middle">Status</th>
                                <th class="align-middle text-end">Amount, $</th>
                                <th class="align-middle text-end">Expiry date</th>
                                <th class="align-middle all"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr {!! $item['is_active'] ? '' : 'class="list-row-disabled"' !!}>
                                <td class="px-0"></td>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input js-check-item-id" type="checkbox" autocomplete="off" id="promo_code_id_check_{{ $item['id'] }}" value="{{ $item['id'] }}">
                                        <label class="form-check-label" for="promo_code_id_check_{{ $item['id'] }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.promo-code.edit', ['coupon' => $item['id']]) }}" class="text-body fw-bold">{{ $item['code'] }}</a>
                                    <p class="text-muted mb-0">{{ $item['description'] }}</p>
                                </td>

                                <td>
                                    {{ $item['is_active'] ? 'active' : 'disabled' }}
                                </td>

                                <td class="text-end">{{ $item['amount'] }}</td>

                                <td class="text-end">{{ $item['expiryDateAt'] }}</td>

                                <td>
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.promo-code.edit', ['coupon' => $item['id']]) }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="javascript:void(0);" data-action="{{ route('admin.promo-code.delete', ['coupon' => $item['id']]) }}" class="text-danger js-delete">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if(empty($items))
                                <tr><td colspan="2">Nothing found</td></tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- end: Table -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('script')
    <!-- bootstrap-datepicker js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/datatables/datatables.min.js') }}"></script>

    <script type="text/javascript">
        window.bulkDeleteAction = "{{ route('admin.promo-code.bulk-delete') }}";
    </script>
    <script src="{{ URL::asset('admin-panel/promo-code/list.js' . $makeupVer) }}"></script>

@endsection
