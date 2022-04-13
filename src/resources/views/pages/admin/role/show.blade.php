@extends('layouts.admin')

@section('title', $role->name )
@section('breadcrumbs', strtolower($role->name) )

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

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                               value="{{ $role->name ?? '' }}" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">{{ __('Slug') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug"
                                               value="{{ $role->slug ?? '' }}" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permissions"
                                           class="col-sm-2 col-form-label">{{ __('Permissions') }}</label>
                                    <div class="col-sm-10">
                                        <select id="permissions" class="form-control" name="permissions[]"
                                                multiple="multiple" disabled>
                                            @foreach ($role->permissions as $permission)
                                                <option value="{{ $permission->id }}"
                                                    {{ $permission->id != old('permission', $permission->id ) ? '' : 'selected' }}>
                                                    {{ strtolower($permission->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('roles.edit', $role) }}" name="editRole"
                                       class="btn btn-dark">{{ __('Edit') }}</a>
                                </div>
                            </div>

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
