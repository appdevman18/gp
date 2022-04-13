<!-- Font Awesome -->
<link href="{{ asset('css/all.css') }}" rel="stylesheet">

<!-- Theme style -->
<link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">

@if(Request::is('admin/roles', 'admin/permissions', 'admin/users'))
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
@endif

@if(Request::is('admin/products', 'admin/products/*' ))
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
@endif

@if(Request::is('admin/roles/*', 'admin/permissions/*', 'admin/users/*'))
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}" defer></script>
@endif

