@extends('admin.layouts.master')

@section('title') Categories @endsection

@section('css')
    <!-- Sweet Alert-->
    <link href="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex flex-wrap align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Categories</h4>
            <a href="#" class="btn btn-success btn-rounded waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="mdi mdi-plus me-1"></i> Add category</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card list-wrap-card">
            <div class="card-body">

                <!-- Table -->
                <div class="table-responsive-sm">
                    <table class="table align-middle table-check" id="categoriesTable" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle all">Category name</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle text-end">Products count</th>
                                <th class="align-middle text-end">Date added</th>
                                <th class="align-middle all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr {!! !$item['isActive'] ? 'class="list-row-disabled"' : '' !!}>
                                    <td>
                                        <a href="#" class="text-body fw-bold">{{ $item['name'] }}</a>
                                    </td>

                                    <td>{{ $item['isActiveName'] }}</td>

                                    <td class="text-end">{{ $item['productCount'] }}</td>

                                    <td class="text-end">{{ $item['createdAt'] }}</td>

                                    <td>
                                        <div class="d-flex gap-3 justify-content-end">
                                            <a href="javascript:void(0);" class="text-success" data-item-id="{{ $item['id'] }}" data-action-edit="{{ route('admin.product.category.edit', ['category' => $item['id']]) }}" data-action-update="{{ route('admin.product.category.update', ['category' => $item['id']]) }}" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i
                                                    class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="javascript:void(0);" data-action="{{ route('admin.product.category.destroy', ['category' => $item['id']]) }}" class="text-danger js-delete"><i
                                                    class="mdi mdi-delete font-size-18"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if(empty($item))
                                <tr><td>Nothing found</td></tr>
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

<!-- Add category modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content js-product-category-validate-form" action="{{ route('admin.product.category.store') }}" id="js-product-category-add-form">
            <div class="modal-header">
                <h5 class="modal-title">Add category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="new_category_name" class="form-label">Name*:</label>
                    <input type="text" class="form-control" id="new_category_name" name="name">
                </div>
                <div class="mb-2">
                    <label class="form-label">Status:</label>
                    <div>
                        <select name="is_active" class="form-control select2-search-disable" style="width:100%">
                            <option value="0">Disabled</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit category modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content js-product-category-validate-form" action="" id="js-product-category-edit-form">
            @method('PUT')
            <input type="hidden" value="" name="item_id">
            <div class="modal-header">
                <h5 class="modal-title">Edit category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_category_name" class="form-label">Name*:</label>
                    <input name="name" type="text" class="form-control" id="edit_category_name" value="">
                </div>
                <div class="mb-2">
                    <label class="form-label">Status:</label>
                    <div>
                        <select name="is_active" class="form-control select2-search-disable" style="width:100%">
                            <option value="0">Disabled</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('script')
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('admin-panel/assets/libs/jquery-validation/jquery-validation.min.js') }}"></script>

    <script src="{{ URL::asset('admin-panel/product-category/list.js' . $makeupVer) }}"></script>
@endsection
