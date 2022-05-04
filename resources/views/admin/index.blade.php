@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('admin-panel/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
           </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-3">
            <div class="row">
                <div class="col-sm-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-copy-alt"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">New Orders</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>22 <i class="mdi mdi-arrow-up font-size-14 text-muted"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> + 0.2% </span> <span class="ms-2 text-truncate">from yesterday</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="text-left">
                                <a href="#" class="btn btn-sm btn-primary waves-effect waves-light">View <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                        <i class="bx bx-user-plus"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-14 mb-0">New Customers</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>1 <i class="mdi mdi-arrow-down font-size-14 text-muted"></i></h4></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-warning font-size-12"> - 50% </span> <span class="ms-2 text-truncate">from yesterday</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="text-left">
                                <a href="#" class="btn btn-sm btn-primary waves-effect waves-light">View <i class="mdi mdi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-2">
                            <h5 class="card-title mb-4">The most popular products</h5>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="td-fit">Image</th>
                                <th scope="col">Product name</th>
                                <th scope="col" class="text-right">Price</th>
                                <th scope="col" class="text-right">Sales</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="{{ URL::asset('admin-panel/assets/images/product/Dont_Conform_auto_x80.jpg') }}" alt="" class="product-avatar">
                                    <td>
                                        <h5 class="font-size-13 m-0"><a href="#" class="text-dark">Academic Membership</a></h5>
                                    </td>
                                    <td class="text-right">$48</td>
                                    <td class="text-right">
                                        <div class="js-apex-prod" data-sales-percent="21"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>
                                        <img src="{{ URL::asset('admin-panel/assets/images/product/AcademicMembership_auto_x80.jpg') }}" alt="" class="product-avatar">
                                    <td>
                                        <h5 class="font-size-13 m-0"><a href="#" class="text-dark">Academic Membership</a></h5>
                                    </td>
                                    <td class="text-right">$75</td>
                                    <td class="text-right">
                                        <div class="js-apex-prod" data-sales-percent="19"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>
                                        <img src="{{ URL::asset('admin-panel/assets/images/product/TargetValueDelivery_auto_x80.jpg') }}" alt="" class="product-avatar">
                                    <td>
                                        <h5 class="font-size-13 m-0"><a href="#" class="text-dark">Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016</a></h5>
                                    </td>
                                    <td class="text-right">$48</td>
                                    <td class="text-right">
                                        <div class="js-apex-prod" data-sales-percent="16"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>
                                        <img src="{{ URL::asset('admin-panel/assets/images/product/this-is-lean_auto_x80.jpg') }}" alt="" class="product-avatar">
                                    <td>
                                        <h5 class="font-size-13 m-0"><a href="#" class="text-dark">LCI Special Edition: This Is Lean</a></h5>
                                    </td>
                                    <td class="text-right">$24</td>
                                    <td class="text-right">
                                        <div class="js-apex-prod" data-sales-percent="15"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="border-0 pb-0">5</td>
                                    <td class="border-0 pb-0">
                                        <img src="{{ URL::asset('admin-panel/assets/images/product/make-a-card-simulation_auto_x80.jpg') }}" alt="" class="product-avatar">
                                    <td class="border-0 pb-0">
                                        <h5 class="font-size-13 m-0"><a href="#" class="text-dark">Make a Card</a></h5>
                                    </td>
                                    <td class="text-right border-0 pb-0">$500</td>
                                    <td class="text-right border-0 pb-0">
                                        <div class="js-apex-prod" data-sales-percent="8"></div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <div class="d-flex flex-wrap">
                        <div class="me-2">
                            <h5 class="card-title mt-1 mb-0">Latest Orders</h5>
                        </div>
                        <ul class="nav nav-tabs nav-tabs-custom card-header-tabs ms-auto" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#orders-today" role="tab">
                                Today
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#orders-this-week" role="tab">
                                This week
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#orders-this-month" role="tab">
                                This month
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="orders-today" role="tabpanel">today
                            <!-- Table -->
                            <div class="table-responsive-sm">
                                <table class="table align-middle table-check js-orders-table" style="width: 100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                            <th class="align-middle all">Order ID</th>
                                            <th class="align-middle">Customer</th>
                                            <th class="align-middle">Status</th>
                                            <th class="align-middle">Products</th>
                                            <th class="align-middle">Date added</th>
                                            <th class="align-middle">Dates modified</th>
                                            <th class="align-middle text-end">Overall price</th>
                                            <th class="align-middle all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-0"></td>
                                            <td>
                                                <a href="#" class="text-body fw-bold">#SK2540</a>
                                            </td>
                                            <td>Neal Matthews</td>

                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1" selected>Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>
                                            </td>
                                            <td>
                                                12 seconds ago
                                            </td>
                                            <td>
                                                12 seconds ago
                                            </td>

                                            <td class="text-end">
                                                $48.00
                                            </td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2541</a> </td>
                                            <td>Jamal Burnett</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2" selected>On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04(2)</a>

                                            <td>11.18.2021, 14:00</td>

                                            <td>21 seconds ago</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2542</a> </td>
                                            <td>Juan Mitchell</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1" selected>Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.18.2021, 11:23</td>

                                            <td>11.18.2021, 11:23</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2543</a> </td>
                                            <td>Barry Dick</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>
                                            </td>

                                            <td>11.16.2021, 09:01</td>

                                            <td>1 hour ago</td>

                                            <td class="text-end">$448.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2544</a> </td>
                                            <td>Ronald Taylor</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                            <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>,  <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Don’t Conform, Transform!">#05</a>,  <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.15.2021, 19:32</td>

                                            <td>11.18.2021, 14:12</td>

                                            <td class="text-end">$144.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- end: Table -->
                        </div>
                        <!-- end tab pane -->
                        <div class="tab-pane" id="orders-this-week" role="tabpanel">week
                            <!-- Table -->
                            <div class="table-responsive-sm">
                                <table class="table align-middle table-check js-orders-table" style="width: 100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                            <th class="align-middle all">Order ID</th>
                                            <th class="align-middle">Customer</th>
                                            <th class="align-middle">Status</th>
                                            <th class="align-middle">Products</th>
                                            <th class="align-middle">Date added</th>
                                            <th class="align-middle">Dates modified</th>
                                            <th class="align-middle text-end">Overall price</th>
                                            <th class="align-middle all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-0"></td>
                                            <td>
                                                <a href="#" class="text-body fw-bold">#SK2540</a>
                                            </td>
                                            <td>Neal Matthews</td>

                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1" selected>Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>
                                            </td>
                                            <td>
                                                12 seconds ago
                                            </td>
                                            <td>
                                                12 seconds ago
                                            </td>

                                            <td class="text-end">
                                                $48.00
                                            </td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2541</a> </td>
                                            <td>Jamal Burnett</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2" selected>On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04(2)</a>

                                            <td>11.18.2021, 14:00</td>

                                            <td>21 seconds ago</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2542</a> </td>
                                            <td>Juan Mitchell</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1" selected>Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.18.2021, 11:23</td>

                                            <td>11.18.2021, 11:23</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2543</a> </td>
                                            <td>Barry Dick</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>
                                            </td>

                                            <td>11.16.2021, 09:01</td>

                                            <td>1 hour ago</td>

                                            <td class="text-end">$448.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2544</a> </td>
                                            <td>Ronald Taylor</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                            <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>,  <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Don’t Conform, Transform!">#05</a>,  <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.15.2021, 19:32</td>

                                            <td>11.18.2021, 14:12</td>

                                            <td class="text-end">$144.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2545</a> </td>
                                            <td>Jacob Hunter</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Don’t Conform, Transform!">#05</a>
                                            </td>

                                            <td>11.15.2021, 15:02</td>

                                            <td>11.18.2021, 14:11</td>

                                            <td class="text-end">
                                                $48.00
                                            </td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2546</a> </td>
                                            <td>William Cruz</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.09.2021, 10: 01</td>

                                            <td>11.10.2021, 14:06</td>

                                            <td class="text-end">$48.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2547</a> </td>
                                            <td>Dustin Moser</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>
                                            </td>

                                            <td>11.08.2021, 12:45</td>

                                            <td>11.10.2021, 14:05</td>

                                            <td class="text-end">$400.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2548</a> </td>
                                            <td>Clark Benson</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07(2)</a>
                                            </td>

                                            <td>11.03.2021, 12: 54</td>

                                            <td>11.18.2021, 17:45</td>

                                            <td class="text-end">$496.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2549</a> </td>
                                            <td>Tomas Sample</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="#" class="text-body fw-bold d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.03.2021, 11:59</td>

                                            <td>11.18.2021, 14:01</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- end: Table -->
                        </div>
                        <!-- end tab pane -->
                        <div class="tab-pane" id="orders-this-month" role="tabpanel">month
                            <!-- Table -->
                            <div class="table-responsive-sm">
                                <table class="table align-middle table-check js-orders-table" style="width: 100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                            <th class="align-middle all">Order ID</th>
                                            <th class="align-middle">Customer</th>
                                            <th class="align-middle">Status</th>
                                            <th class="align-middle">Products</th>
                                            <th class="align-middle">Date added</th>
                                            <th class="align-middle">Dates modified</th>
                                            <th class="align-middle text-end">Overall price</th>
                                            <th class="align-middle all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-0"></td>
                                            <td>
                                                <a href="#" class="text-body fw-bold">#SK2540</a>
                                            </td>
                                            <td>Neal Matthews</td>

                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1" selected>Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>
                                            </td>
                                            <td>
                                                12 seconds ago
                                            </td>
                                            <td>
                                                12 seconds ago
                                            </td>

                                            <td class="text-end">
                                                $48.00
                                            </td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2541</a> </td>
                                            <td>Jamal Burnett</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2" selected>On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04(2)</a>

                                            <td>11.18.2021, 14:00</td>

                                            <td>21 seconds ago</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2542</a> </td>
                                            <td>Juan Mitchell</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1" selected>Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3">Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.18.2021, 11:23</td>

                                            <td>11.18.2021, 11:23</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2543</a> </td>
                                            <td>Barry Dick</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>
                                            </td>

                                            <td>11.16.2021, 09:01</td>

                                            <td>1 hour ago</td>

                                            <td class="text-end">$448.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2544</a> </td>
                                            <td>Ronald Taylor</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                            <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>,  <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Don’t Conform, Transform!">#05</a>,  <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.15.2021, 19:32</td>

                                            <td>11.18.2021, 14:12</td>

                                            <td class="text-end">$144.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2545</a> </td>
                                            <td>Jacob Hunter</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Don’t Conform, Transform!">#05</a>
                                            </td>

                                            <td>11.15.2021, 15:02</td>

                                            <td>11.18.2021, 14:11</td>

                                            <td class="text-end">
                                                $48.00
                                            </td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2546</a> </td>
                                            <td>William Cruz</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.09.2021, 10: 01</td>

                                            <td>11.10.2021, 14:06</td>

                                            <td class="text-end">$48.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2547</a> </td>
                                            <td>Dustin Moser</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>
                                            </td>

                                            <td>11.08.2021, 12:45</td>

                                            <td>11.10.2021, 14:05</td>

                                            <td class="text-end">$400.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2548</a> </td>
                                            <td>Clark Benson</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07(2)</a>
                                            </td>

                                            <td>11.03.2021, 12: 54</td>

                                            <td>11.18.2021, 17:45</td>

                                            <td class="text-end">$496.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2549</a> </td>
                                            <td>Tomas Sample</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="#" class="text-body fw-bold d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.03.2021, 11:59</td>

                                            <td>11.18.2021, 14:01</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2550</a> </td>
                                            <td>Clark Benson</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07(2)</a>
                                            </td>

                                            <td>11.03.2021, 12: 54</td>

                                            <td>11.18.2021, 17:45</td>

                                            <td class="text-end">$496.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2551</a> </td>
                                            <td>Tomas Sample</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="#" class="text-body fw-bold d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.03.2021, 11:59</td>

                                            <td>11.18.2021, 14:01</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2552</a> </td>
                                            <td>Clark Benson</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07(2)</a>
                                            </td>

                                            <td>11.03.2021, 12: 54</td>

                                            <td>11.18.2021, 17:45</td>

                                            <td class="text-end">$496.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2553</a> </td>
                                            <td>Tomas Sample</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="#" class="text-body fw-bold d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.03.2021, 11:59</td>

                                            <td>11.18.2021, 14:01</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2554</a> </td>
                                            <td>Clark Benson</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Individual Membership">#01</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07(2)</a>
                                            </td>

                                            <td>11.03.2021, 12: 54</td>

                                            <td>11.18.2021, 17:45</td>

                                            <td class="text-end">$496.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="px-0"></td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2555</a> </td>
                                            <td>Tomas Sample</td>
                                            <td>
                                                <select class="form-control js-status-select2" style="width: 150px;">
                                                    <option value="1">Processing</option>
                                                    <option value="2">On-hold</option>
                                                    <option value="3" selected>Completed</option>
                                                    <option value="4">Cancelled</option>
                                                </select>
                                            </td>

                                            <td>
                                                <a href="#" class="text-body fw-bold d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04</a>, <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Target Value Delivery: Practitioner Guidebook to Implementation – Current State 2016">#07</a>
                                            </td>

                                            <td>11.03.2021, 11:59</td>

                                            <td>11.18.2021, 14:01</td>

                                            <td class="text-end">$96.00</td>

                                            <td>
                                                <div class="d-flex gap-3 justify-content-end">
                                                    <a href="order-details" class="text-success"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" class="text-danger js-delete"><i
                                                            class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- end: Table -->
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->

                </div>
            </div>

        </div>
    </div>
    <!-- end row -->

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('admin-panel/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('admin-panel/assets/libs/datatables/datatables.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('admin-panel/assets/js/pages/dashboard.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Datable
            // Uncomment serverSide and ajax
            var listTable = $('.js-orders-table').DataTable({
                // serverSide: true,
                // ajax: {
                //     url: "#",
                //     data: function (d) {
                //         d.search = $('#listSearch').val();
                //         console.log('d.search', $('#listSearch').val());
                //         d.type = $('#searchUserType').val();
                //     }
                // },
                responsive: true,
                paging: true,
                pageLength: 8,
                pagingType: 'full_numbers',
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 8]
                    }
                ],
                responsive: {
                        details: {
                        renderer: $.fn.dataTable.Responsive.renderer.listHiddenNodes()
                    }
                },
                order: [[2, 'asc']],
                dom: "<'row'<'col-sm-12'tr>>" +
                "<'row mt-md-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 mt-3 mt-md-0'p>>",
                drawCallback: function(dt) {
                    console.log('select2 init');
                    $('.js-status-select2').select2({
                        minimumResultsForSearch: Infinity
                    });
                }
            });

        });
    </script>
@endsection
