<!-- Font Awesome -->
<link href="{{ asset('css/all.css') }}" rel="stylesheet">

<!-- Theme style -->
<link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">

@if(Request::is('profile/products/*', 'profile/products'))
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
@endif

@if(Request::is('profile/account/*' ))
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
@endif
