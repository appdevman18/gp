<!-- Google Font: Source Sans Pro -->
{{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
<!-- Font Awesome -->
{{--<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">--}}
<!-- Ionicons -->
{{--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
<!-- Tempusdominus Bootstrap 4 -->
{{--<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">--}}
<!-- iCheck -->
{{--<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
<!-- JQVMap -->
{{--<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">--}}
<!-- Theme style -->
{{--<link rel="stylesheet" href="dist/css/adminlte.min.css">--}}
<!-- overlayScrollbars -->
{{--<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">--}}
<!-- Daterange picker -->
{{--<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">--}}
<!-- summernote -->
{{--<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">--}}

<!-- Font Awesome -->
<link href="{{ asset('css/all.css') }}" rel="stylesheet">

<!-- Theme style -->
<link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">


@if(Request::is('users'))
<!-- DataTables -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> -->
<link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">

<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script> -->
@endif

@if(Request::is('products', 'roles', 'permissions', 'users.create'))
<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
@endif

@if(Request::is('products/*'))
<!--https://cdnjs.com/libraries/Chart.js  -->
<script src="{{ asset('js/chart.min.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script> -->
@endif

@if(Request::is('roles/*', 'permissions/*', 'users/*'))
	<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}" defer></script>
	<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
@endif
<!-- <script src="{{ asset('js/jquery.dataTables.js') }}"></script> -->
