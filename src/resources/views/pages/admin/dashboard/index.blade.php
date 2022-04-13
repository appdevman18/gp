@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumbs', 'Dashboard')

@section('content')

    @include('partials.admin.navbar')

    @include('partials.admin.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.admin.content-header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            @include('partials.admin.smallbox')
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->

                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->

                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @include('partials.admin.sidebar.control')


@endsection
