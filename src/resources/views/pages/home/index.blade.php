@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('partials.intro')
            @include('partials.stores')
        </div>
    </div>
@endsection
