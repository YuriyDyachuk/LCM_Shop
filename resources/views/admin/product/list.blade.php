@extends('admin.layouts.master')

@section('title') Products @endsection

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
            <h4 class="mb-sm-0 font-size-18">Products list</h4>
            <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2"><i class="mdi mdi-plus me-1"></i> Add product</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card list-wrap-card">
            <div class="card-body">

                <div class="row align-items-end mb-2">
                    <div class="col-xl col-sm-6">
                        <div class="form-group mt-0 mb-3">
                            <label>Bulk actions</label>
                            <div class="d-flex">
                                <select id="js-bulk-actions-list" class="form-control js-bulk-actions-select2">
                                    <option>Select action</option>
                                    <option data-action="bulk-in-stock-update" value="1">Change status to in stock</option>
                                    <option data-action="bulk-in-stock-update" value="0">Change status to out of stock</option>
                                    <option data-action="bulk-delete" value="trash" class="bulk-delete">Move to Trash</option>
                                </select>

                                <button type="button" class="btn btn-primary ms-2 js-table-bulk" id="applyBulkActions" disabled>Apply</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl col-sm-6">
                        <div class="form-group mt-0 mb-3">
                            <label>Category</label>
                            <select class="form-control select2-search-disable" id="categoryFilter">
                                <option value="">All categories</option>
                                @foreach($categories as $categoryId=>$categoryName)
                                <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xl col-sm-6">
                        <div class="form-group mt-0 mb-3">
                            <label>Stock status</label>
                            <select class="form-control select2-search-disable" id="stockStatusFilter">
                                <option value="">All stock statuses</option>
                                <option value="1">In stock</option>
                                <option value="0">Out of stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xl col-sm-6">
                        <div class="form-group mt-0 mb-3">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search..." id="listSearch">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="dataTables_wrapper">
                    <div class="table-responsive-sm">
                        <table class="table align-middle table-check" id="productsTable" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                    <th style="width: 20px;" class="align-middle all">
                                        <div class="form-check font-size-16">
                                            <input {{ empty($items) ? 'disabled' : '' }} class="form-check-input" type="checkbox" autocomplete="off" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th class="align-middle">Product ID</th>
                                    <th class="align-middle all td-fit">Image</th>
                                    <th class="align-middle all">Product name</th>
                                    <th id="js-filter-category" class="align-middle">Category</th>
                                    <th class="align-middle text-end">Price,$</th>
                                    <th class="align-middle text-end">Quantity</th>
                                    <th id="js-filter-in-stock" class="align-middle">Status</th>
                                    <th class="align-middle all"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td class="px-0"></td>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input js-check-item-id" type="checkbox" autocomplete="off" id="product_id_check_{{ $item['id'] }}" value="{{ $item['id'] }}">
                                            <label class="form-check-label" for="product_id_check_{{ $item['id'] }}"></label>
                                        </div>
                                    </td>

                                    <td>{{ $item['sku'] }}</td>

                                    <td>
                                        <img src="{{ URL::asset('admin-panel/stub/product_empty_x80.png') }}" alt="" class="product-avatar">
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.product.edit', ['product' => $item['id']]) }}" class="text-body fw-bold">{{ $item['name'] }}</a>
                                    </td>

                                    <td>{{ $item['categoryName'] }}</td>

                                    <td class="text-end">{{ $item['price'] }}</td>

                                    <td class="text-end">{{ $item['quantity'] }}</td>

                                    <td>
                                        <select data-action="{{ route('admin.product.in-stock-update', ['product' => $item['id']]) }}" class="form-control js-status-select2 js-in-stock-select" style="width: 150px;">
                                            <option value="0" {{ !$item['isInStock'] ? 'selected' : ''}}>Out of stock</option>
                                            <option value="1" {{ $item['isInStock'] ? 'selected' : ''}}>In stock</option>
                                        </select>
                                        <!--for sorting DataTable-->
                                        <span class="d-none">{{ $item['isInStock'] }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3 justify-content-end">
                                            <a href="{{ route('admin.product.edit', ['product' => $item['id']]) }}" class="text-success"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" data-action="{{ route('admin.product.delete', ['product' => $item['id']]) }}" class="text-danger js-delete"><i
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
        window.bulkInStockUpdateAction = "{{ route('admin.product.bulk-in-stock-update') }}";
        window.bulkDeleteAction = "{{ route('admin.product.bulk-delete') }}";
    </script>
    <script src="{{ URL::asset('admin-panel/product/list.js' . $makeupVer) }}"></script>
@endsection
