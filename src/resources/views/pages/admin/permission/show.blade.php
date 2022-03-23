@extends('layouts.profile')

@section('title', $permission->name )
@section('breadcrumbs', strtolower($permission->name) )

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
                            
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $permission->name ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="slug" class="col-sm-2 col-form-label">{{ __('Slug') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ $permission->slug ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="roles" class="col-sm-2 col-form-label">{{ __('Roles') }}</label>
                                        <div class="col-sm-10">
                                            <select  id="roles" class="form-control" name="roles[]" multiple="multiple" disabled>
                                                @foreach ($permission->roles as $role)
                                                    <option value="{{ $permission->id }}" 
                                                        {{ $role->id != old('role', $role->id ) ? '' : 'selected' }}>
                                                            {{ strtolower($role->name) }} 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('permissions.edit', $permission) }}" name="editPermission" class="btn btn-success">{{ __('Edit') }}</a>
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
        $(document).ready(function() {
            // $.fn.select2.defaults.set("theme", "classic");
            $('#roles').select2({
                placeholder: "{{ __('Select') }}",
                width: 'resolve',
                theme: 'classic',
                // allowClear: true,
            });
        });
    </script>
    @include('partials.profile.sidebar.control')

@endsection
