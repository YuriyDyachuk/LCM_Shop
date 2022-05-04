<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-calendar">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-cart-alt"></i>
                        <span>Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.order.list') }}">Orders</a></li>
                        <!-- <li><a href="returns">Returns</a></li> -->
                        <li><a href="{{ route('admin.promo-code.list') }}">Promo Codes</a></li>
                        <li><a href="{{ route('admin.discount.list') }}">Corporate Discounts</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-grid-alt"></i>
                        <span>Catalog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.product.list') }}">Products</a></li>
                        <li><a href="{{ route('admin.product.category.list') }}">Categories</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.customer.list') }}" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span>Customers</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
