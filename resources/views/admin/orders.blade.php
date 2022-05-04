@extends('admin.layouts.master')

@section('title') @lang('translation.Orders') @endsection

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
            <h4 class="mb-sm-0 font-size-18">Orders</h4>
            <a href="order-add" class="btn btn-success btn-rounded waves-effect waves-light my-2"><i class="mdi mdi-plus me-1"></i> Place new order</a>
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
                        <div class="col-xl col-sm-6">
                            <div class="form-group mt-0 mb-3">
                                <label>Bulk actions</label>
                                <div class="d-flex">
                                    <select class="form-control js-bulk-actions-select2">
                                        <option>Select action</option>
                                        <option value="1">Change status to processing</option>
                                        <option value="2">Change status to on-hold</option>
                                        <option value="3">Change status to completed</option>
                                        <option value="4">Change status to cancelled</option>
                                        <option value="trash" class="bulk-delete">Move to Trash</option>
                                    </select>

                                    <button type="button" class="btn btn-primary ms-2 js-table-bulk" id="applyBulkActions" disabled>Apply</button>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl col-sm-6">
                            <div class="form-group mt-0 mb-3">
                                <label>Dates added</label>
                                <div class="input-daterange input-group" id="datepickerAdded" data-date-format="dd M, yyyy"
                                data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepickerAdded'>
                                    <input type="text" class="form-control" name="start" placeholder="From" autocomplete="off" id="datepickerAddedFrom" />
                                    <input type="text" class="form-control" name="end" placeholder="To" autocomplete="off" id="datepickerAddedTo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xl col-sm-6">
                            <div class="form-group mt-0 mb-3">
                                <label>Dates modified</label>
                                <div class="input-daterange input-group" id="datepickerModified" data-date-format="dd M, yyyy"
                                data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepickerModified'>
                                    <input type="text" class="form-control" name="start" placeholder="From" autocomplete="off" id="datepickerModifiedFrom" />
                                    <input type="text" class="form-control" name="end" placeholder="To" autocomplete="off" id="datepickerModifiedTo" />
                                </div>
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
                </form>
                <!-- end: Filters -->

                <!-- Table -->
                <div class="table-responsive-sm">
                    <table class="table align-middle table-check" id="ordersTable" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="td-fit px-0 dtr-control-th all"></th>
                                <th style="width: 20px;" class="align-middle all">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" autocomplete="off" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
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

                        @foreach($orders as $order)
                            <tr>
                                <td class="px-0"></td>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" autocomplete="off" id="order_id_check_02">
                                        <label class="form-check-label" for="order_id_check_02"></label>
                                    </div>
                                </td>
                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{ $order->sku }}</a> </td>
                                <td>{{ $order->user->fullName }}</td>
                                <td>
                                    <select class="form-control js-status-select2" style="width: 150px;">
                                        <option value="1"
                                                @if($order->status == '1') selected @endif>
                                            {{App\Enums\TransactionStatusEnum::completed()->label}}
                                        </option>
                                        <option value="2"
                                                @if($order->status == '2') selected @endif>
                                            {{App\Enums\TransactionStatusEnum::pending()->label}}
                                        </option>
                                        <option value="3"
                                                @if($order->status == '3') selected @endif>
                                            {{App\Enums\TransactionStatusEnum::cansel()->label}}
                                        </option>
                                        <option value="4"
                                                @if($order->status == '4') selected @endif>
                                            {{App\Enums\TransactionStatusEnum::onHold()->label}}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <a href="product" class="text-body fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Transforming Design and Construction: A Framework for Change">#04(2)</a>

                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>

                                <td>{{ $order->updated_at->format('d.m.Y H:i') }}</td>

                                <td class="text-end">1000</td>

                                <td>
                                    <div class="d-flex gap-3 justify-content-end">

                                        <a href="{{ route('admin.order.show', $order->id) }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="text-danger js-delete">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
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

    <script>
        $(document).ready(function() {
            // Warning Message on Delete
            $('.js-delete').click(function () {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it",
                    preConfirm: function (result) {
                        // Ajax request
                    },
                }).then(function (result) {
                    console.log('result.value', result.value);
                    if (result.value) {
                        Swal.fire("Deleted!", "The order has been deleted.", "success");
                    }
                });
            });

            // Datable
            // Uncomment serverSide and ajax
            var listTable = $('#ordersTable').DataTable({
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
                pageLength: 10,
                pagingType: 'full_numbers',
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 1, 9]
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

            $('#listSearch').keyup(function() {
                listTable.draw();
                console.log('Modified', $('#listSearch').val());
            });

            $('#datepickerModifiedFrom, #datepickerModifiedTo, #datepickerAddedFrom, #datepickerAddedTo').change(function(){
                listTable.draw();
            });

            $('#applyBulkActions').click(function(){
                listTable.draw();
            });

            // Bulk actions
            $('.js-bulk-actions-select2').select2({
                minimumResultsForSearch: Infinity,
                templateResult: function (data, container) {
                    console.log('templateResult');
                    if (data.element) {
                        $(container).addClass($(data.element).attr("class"));
                        console.log('container', container);
                        console.log('data.element', data.element);

                        if( $(data.element).hasClass('bulk-delete') ) {
                            console.log('has class');
                            // $(container).prepend('<i class="mdi mdi-delete font-size-18"></i>');

                            $data = $('<span class="d-inline-flex"><i class="mdi mdi-delete font-size-14 me-1"></i> <span>' + data.text + '</span></span>');
                            return $data;
                        }
                    }
                    return data.text;
                }
            });


        });

    </script>
@endsection
