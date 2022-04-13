@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-4">
            @include('partials.home.intro')
        </div>
        <div class="row justify-content-center py-4">
            @include('partials.home.stores')
        </div>
    </div>
@endsection
