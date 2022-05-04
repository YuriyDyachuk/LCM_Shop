<!-- JAVASCRIPT -->
<script src="{{ URL::asset('admin-panel/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('admin-panel/assets/libs/popperjs/popper.min.js')}}"></script>
<script src="{{ URL::asset('admin-panel/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('admin-panel/assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('admin-panel/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('admin-panel/assets/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('admin-panel/assets/libs/toastr/toastr.min.js')}}"></script>
<!-- select2 -->
<script src="{{ URL::asset('admin-panel/assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('admin-panel/site.js' . $makeupVer)}}"></script>

@yield('script')

<!-- App js -->
<script src="{{ URL::asset('admin-panel/assets/js/app.min.js')}}"></script>

@yield('script-bottom')
