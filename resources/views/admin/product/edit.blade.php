@extends('admin.layouts.master')

@section('title') {{ $pageTitle }} @endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $pageTitle }}</h4>
            <div>
                <a href="#" data-is-apply="0" class="js-product-edit-form-link btn btn-primary btn-rounded waves-effect waves-light my-2">
                    <i class="mdi mdi-content-save-outline me-1"></i>
                    Save
                </a>
                <a href="#" data-is-apply="1" class="js-product-edit-form-link btn btn-info btn-rounded waves-effect waves-light my-2">
                    <i class="far fa-save"></i>
                    Apply
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Nav -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#product_basic" role="tab">
                            Basic Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#product_discounts" role="tab">
                            Discounts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#product_images" role="tab">
                            Images
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#product_seo" role="tab">
                            SEO
                        </a>
                    </li>
                </ul>
                <!-- end: Nav -->
                <!-- Tabs -->
                <form action="{{ !empty($item->id) ? route('admin.product.update', ['product' => $item->id]) : route('admin.product.store') }}" method="POST" id="js-product-edit-form" enctype="multipart/form-data">
                    @csrf
                    @method(!empty($item->id) ? 'PUT' : 'POST')
                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                    <input type="hidden" value="" name="is_apply" class="js-is-apply">

                <div class="tab-content px-0 pt-4 pb-0">

                    <div class="tab-pane active" id="product_basic" role="tabpanel">
                        <h4 class="card-title">Basic Information</h4>
                        <p class="card-title-desc mb-3">Fill information below</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="product_sku" class="form-label">SKU*:</label>
                                    <input name="sku" type="text" class="form-control" id="product_sku" value="{{ old('sku', $item->sku) }}">
                                    <div><small class="form-text text-muted">Stock keeping unit.</small></div>
                                </div>

                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Name*:</label>
                                    <input name="name" type="text" class="form-control" id="product_name" value="{{ old('name', $item->name) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Active:</label>
                                    <select name="is_active" id="is_active" class="form-control select2-search-disable" style="width:100%">
                                        <option value="0" {{ !old('is_active', $item->is_active) ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('is_active', $item->is_active) ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product_description" class="form-label">Description:</label>
                                    <textarea name="description" id="product_description" rows="9" class="form-control">{{ old('description', $item->description) }}</textarea>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="product_category" class="form-label">Category*:</label>
                                    <select name="category_id" id="product_category" class="form-control select2-search-disable" style="width: 100%">
                                        <option value=""></option>
                                        @foreach($categories as $categoryId=>$categoryName)
                                        <option {{ old('category_id', $item->category_id) == $categoryId ? 'selected' : '' }} value="{{ $categoryId }}">{{ $categoryName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product_price" class="form-label">Price, $*:</label>
                                    <input name="price" type="text" class="form-control" id="product_price" value="{{ old('price', $item->price) }}">
                                </div>

                                <div class="mb-3 js-not-for-virtual-goods">
                                    <label for="product_stock_status" class="form-label">Stock status</label>
                                    <select name="in_stock" id="product_stock_status" class="select2-search-disable" style="width: 100%">
                                        <option value="0" {{ !old('in_stock', $item->in_stock) ? 'selected' : '' }}>Out of stock</option>
                                        <option value="1" {{ old('in_stock', $item->in_stock) ? 'selected' : '' }}>In stock</option>
                                    </select>
                                </div>

                                <div class="mb-3 js-not-for-virtual-goods">
                                    <label for="product_quantity" class="form-label">Quantity:</label>
                                    <input name="quantity" type="text" class="form-control" id="product_quantity" value="{{ old('quantity', $item->quantity) }}">
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input name="is_virtual" class="form-check-input js-product-is-virtual" type="checkbox" value="1" id="product_virtual" {{ old('is_virtual', $item->is_virtual) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="product_virtual">Virtual</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="product_discounts" role="tabpanel">
                        <h4 class="card-title">Discount list</h4>
                        <p class="card-title-desc mb-3">Shows all applicable discounts for this product</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="product_discount" class="form-label">Discount:</label>
                                    <input type="text" disabled class="form-control" id="product_discount" value="coming soon...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="product_images" role="tabpanel">
                        <h4 class="card-title">Image</h4>
                        <p class="card-title-desc mb-3">Fill information below</p>
                        <div class="row">
                            @if (!empty($item->image))
                            <div class="image-preview">
                                <img src="{{ $item->verboseUrl('image') }}" width="100px" alt="" class="img-thumbnail">
                            </div>
                            @endif
                            <div class="fallback">
                                <label for="image">Choose file to upload</label>
                                <input type="file" id="image" name="image">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="product_seo" role="tabpanel">
                        <h4 class="card-title">Meta Data</h4>
                        <p class="card-title-desc mb-3">Fill information below</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="product_meta_title" class="form-label">Title:</label>
                                    <input name="seo[title]" type="text" class="form-control" id="product_meta_title" value="{{ old('seo.title', $item->seo->title) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="product_meta_description" class="form-label">Description:</label>
                                    <textarea name="seo[description]" id="product_meta_description" rows="5" class="form-control">{{ old('seo.description', $item->seo->description) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                </form>

                <!-- end: Tabs -->

            </div>

        </div>
    </div>
</div>
<!-- end row -->

@endsection

@section('script')
    <script src="{{ URL::asset('admin-panel/assets/libs/jquery-validation/jquery-validation.min.js') }}"></script>
    <!--tinymce js-->
    <script src="{{ URL::asset('admin-panel/assets/libs/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ URL::asset('admin-panel/product/edit.js' . $makeupVer) }}"></script>
@endsection
