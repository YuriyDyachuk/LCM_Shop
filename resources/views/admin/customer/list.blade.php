@extends('admin.layouts.master')

@section('title') Customers @endsection

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
                <h4 class="mb-sm-0 font-size-18">Customers list</h4>
                <a href="{{ route('admin.customer.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2"><i class="mdi mdi-plus me-1"></i> Add customer
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card list-wrap-card">
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row align-items-end mb-2">
                        <div class="col-xl col-md-5 col-sm-6">
                            <div class="form-group mt-0 mb-3">
                                <div class="search-box">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search..." id="listSearch">
                                        <i class="bx bx-search-alt search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl col-md-5 col-sm-6">
                            <div class="form-group mt-0 mb-3">
                                <label>Dates added</label>
                                <div class="input-daterange input-group" id="datepickerAdded" data-date-format="yyyy-mm-dd"
                                     data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepickerAdded'>
                                    <input type="text" class="form-control" name="start" placeholder="From" autocomplete="off" id="datepickerAddedFrom" />
                                    <input type="text" class="form-control" name="end" placeholder="To" autocomplete="off" id="datepickerAddedTo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xl col-md-2 col-sm-6">
                            <div class="form-group mt-0 mb-0 mb-md-3 text-md-end">
                                <button type="button" class="btn btn-secondary js-table-bulk" id="bulkDelete" disabled>Delete</button>
                            </div>
                        </div>

                    </div>
                    <!-- end: Filters -->

                    <!-- Table -->
                    <div class="table-responsive-sm">
                        <table class="table align-middle table-check" id="customersTable" style="width: 100%">
                            <thead class="table-light">
                            <tr>
                                <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                <th style="width: 20px;" class="align-middle all">
                                    <div class="form-check font-size-16">
                                        <input {{ empty($items) ? 'disabled' : '' }} class="form-check-input" type="checkbox" autocomplete="off" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="align-middle all">Name</th>
                                <th class="align-middle">Membership type</th>
                                <th class="align-middle text-end">Orders</th>
                                <th class="align-middle text-end">Overall orders price, $</th>
                                <th class="align-middle text-end">Date added</th>
                                <th class="align-middle all"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td class="px-0"></td>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input js-check-item-id" type="checkbox" autocomplete="off" id="customer_id_check_{{ $item['id'] }}" value="{{ $item['id'] }}">
                                        <label class="form-check-label" for="customer_id_check_{{ $item['id'] }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customer.edit', ['customer' => $item['id']]) }}" class="text-body fw-bold">{{ $item['name'] }}</a>
                                </td>

                                <td>{{ $item['membershipTypeName'] }}</td>

                                <td class="text-end">{{ $item['orderCount'] }}</td>

                                <td class="text-end">{{ $item['orderPriceTotal'] }}</td>

                                <td class="text-end">{{ $item['createdAt'] }}</td>

                                <td>
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.customer.edit', ['customer' => $item['id']]) }}" class="text-success"><i
                                                class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" data-action="{{ route('admin.customer.delete', ['customer' => $item['id']]) }}" class="text-danger js-delete"><i
                                                class="mdi mdi-delete font-size-18"></i></a>
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
        window.bulkDeleteAction = "{{ route('admin.customer.bulk-delete') }}";
    </script>
    <script src="{{ URL::asset('admin-panel/customer/list.js' . $makeupVer) }}"></script>

@endsection
