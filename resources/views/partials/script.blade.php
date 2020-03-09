<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery -->
{{--<script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>--}}

{{--@jquery--}}
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('node_modules/jqueryui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Sparkline -->
<script src="{{ asset('node_modules/sparklines/source/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('node_modules/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('node_modules/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('node_modules/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('node_modules/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('node_modules/summernote/dist/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('node_modules/overlayscrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script src="{{ asset('node_modules/croppie/croppie.min.js') }}"></script>
@toastr_js
@toastr_render
