@extends('admin.layouts.master')

@section('title') Corporate Discounts @endsection

@section('css')
    <!-- Sweet Alert-->
    <link href="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="{{ URL::asset('admin-panel/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Corporate Discounts</h4>
                <a href="{{ route('admin.discount.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2"><i class="mdi mdi-plus me-1"></i> Add discount</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card list-wrap-card">
                <div class="card-body">
                    <!-- Filters -->
                    <form>
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
                                    <select class="form-control select2-search-disable" style="width: 200px;" id="membershipFilter" data-placeholder="Membership type">
                                        <option></option>
                                        <option value="1">All members</option>
                                        <option value="2">Student Membership</option>
                                        <option value="3">Academic Membership</option>
                                        <option value="4">Individual Membership</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl col-sm-auto">
                                <div class="form-group mt-0 mb-0 mb-sm-3 text-sm-end">
                                    <button type="button" class="btn btn-secondary js-table-bulk" id="bulkDelete" disabled>Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end: Filters -->

                    <!-- Table -->
                    <div class="table-responsive-sm">
                        <table class="table align-middle table-check" id="discountTable" style="width: 100%">
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
                                <th class="align-middle">Discount type</th>
                                <th class="align-middle text-end">Priority</th>
                                <th class="align-middle text-end all">Status</th>
                                <th class="align-middle all"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr {!! $item['is_active'] ? '' : 'class="list-row-disabled"' !!}>
                                <td class="px-0"></td>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input js-check-item-id" type="checkbox" autocomplete="off" id="category_id_check_{{ $item['id'] }}" value="{{ $item['id'] }}">
                                        <label class="form-check-label" for="category_id_check_{{ $item['id'] }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.discount.edit', ['discount' => $item['id']]) }}" class="text-body fw-bold">{{ $item['name'] }}</a>
                                </td>

                                <td>{{ $item['typeName'] }}</td>

                                <td class="text-end">{{ $item['priority'] }}</td>

                                <td class="text-end">
                                    <input data-action="{{ route('admin.discount.is-active-update', ['discount' => $item['id']]) }}" type="checkbox" {{ $item['is_active'] ? 'checked' : ''}} id="category_switch_{{ $item['id'] }}" class="list-item-switch js-category-switch" switch="primary" />
                                    <label for="category_switch_{{ $item['id'] }}" data-on-label="" data-off-label=""></label>
                                    <!--for sorting DataTable-->
                                    <span class="d-none">{{ $item['is_active'] }}</span>
                                </td>

                                <td>
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('admin.discount.edit', ['discount' => $item['id']]) }}" class="text-success"><i
                                                class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" data-action="{{ route('admin.discount.delete', ['discount' => $item['id']]) }}" class="text-danger js-delete"><i
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
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/datatables/datatables.min.js') }}"></script>

    <script type="text/javascript">
        window.bulkDeleteAction = "{{ route('admin.discount.bulk-delete') }}";
    </script>
    <script src="{{ URL::asset('admin-panel/discount/list.js' . $makeupVer) }}"></script>

@endsection
