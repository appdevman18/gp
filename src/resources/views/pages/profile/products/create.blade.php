@extends('layouts.profile')

@section('title', 'Create New Product' )
@section('breadcrumbs', 'сreate new product')

@section('content')

    @include('partials.profile.navbar')

    @include('partials.profile.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.profile.content-header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            @include('partials.profile.session')

                <!-- Main row -->
                <div class="row">

                    <div class="col-md-12">

                        <div class="card card-info">
                            <form method="POST" action="{{ route('checkUrl') }}" id="checkUrl"  class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="url" class="col-sm-2 col-form-label">{{ __('Link') }}*</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="url" class="form-control" id="url" placeholder="Enter Url For Check" value="{{ $data['url'] ?? old('url') }}" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="checkUrl" class="btn btn-dark">{{ __('Check') }}</button>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('profile.products.store') }}" id="createProduct"  class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="url" id="url" value="{{ $data['url'] ?? old('url') }}" required>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $data['title'] ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="store" class="col-sm-2 col-form-label">{{ __('Store') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="store" class="form-control" id="store" placeholder="Store" value="{{ $data['store'] ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">{{ __('Price') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="{{ $data['price'] ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" name="createProduct" class="btn btn-success">{{ __('Create') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-12 -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <script>

    </script>
    <!-- /.content-wrapper -->

    @include('partials.profile.sidebar.control')

@endsection
