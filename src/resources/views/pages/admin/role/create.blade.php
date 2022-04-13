@extends('layouts.admin')

@section('title', 'Create New Role' )
@section('breadcrumbs', 'сreate new role')

@section('content')

    @include('partials.admin.navbar')

    @include('partials.admin.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.admin.content-header')

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            @include('partials.admin.session')

            <!-- Main row -->
                <div class="row">

                    <div class="col-md-12">

                        <div class="card card-info">
                            <form method="POST" action="{{ route('roles.store') }}" id="createRole"
                                  class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="name"
                                                   placeholder="Name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="permissions"
                                               class="col-sm-2 col-form-label">{{ __('Permissions') }}</label>
                                        <div class="col-sm-10">
                                            <select id="permissions" class="form-control" name="permissions[]"
                                                    multiple="multiple">
                                                @foreach ($permissions as $permission)
                                                    <option
                                                        value="{{ $permission->id }}" {{ $permission->id == old('permissions') ? 'selected' : '' }}>
                                                        {{ strtolower($permission->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" name="createRole"
                                                class="btn btn-success">{{ __('Create') }}</button>
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
    <script>
        $(document).ready(function () {
            // $.fn.select2.defaults.set("theme", "classic");
            $('#permissions').select2({
                placeholder: "{{ __('Select') }}",
                width: 'resolve',
                theme: 'classic',
                // allowClear: true,
            });
        });
    </script>
    @include('partials.admin.sidebar.control')

@endsection
