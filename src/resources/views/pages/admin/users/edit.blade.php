@extends('layouts.admin')

@section('title', 'Update User' )
@section('breadcrumbs', 'update user')

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
                                <form method="POST" action="{{ route('users.update', $user) }}" id="createUser"
                                      class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">{{ __('User Name') }}*</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="name"
                                                   placeholder="Enter name" value="{{ old('name') ?: $user->name }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">{{ __('Email address') }}
                                            *</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="email"
                                                   placeholder="Enter email" value="{{ old('email') ?: $user->email }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}
                                            *</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" id="password"
                                                   placeholder="Password" value="{{ old('password') ?: '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="account" class="col-sm-2 col-form-label">{{ __('Account') }}*</label>
                                        <div class="col-sm-10">
                                            <select id="account" name="account" class="form-control">
                                                @foreach(\App\Enums\UserAccount::cases() as $account)
                                                    <option value="{{ $account->value }}"
                                                        {{ $account->value != old('account', $user->account->value) ? '' : 'selected' }}>
                                                        {{ $account->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 col-form-label">{{ __('Status') }}*</label>
                                        <div class="col-sm-10">
                                            <select id="status" name="status" class="form-control">
                                                @foreach(\App\Enums\UserStatus::cases() as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ $status->value != old('status', $user->status->value) ? '' : 'selected' }}>
                                                        {{ $status->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">{{ __('Phone') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone" class="form-control" id="phone"
                                                   placeholder="Phone" value="{{ $user->phone ?: old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telegram_username"
                                               class="col-sm-2 col-form-label">{{ __('Telegram Username') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="telegram_username" class="form-control"
                                                   id="telegram_username" placeholder="Telegram Username"
                                                   value="{{ $user->telegram_username ?: old('telegram_username') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-2 col-form-label">{{ __('Roles') }}*</label>
                                        <div class="col-sm-10">
                                            <select id="role" name="role" class="form-control">@foreach($roles as $role)
                                                    <option
                                                        value="{{ $role->id }}" {{ $role->id != old('role', $user->roles[0]->id) ? '' : 'selected' }}>{{ strtolower($role->name) }}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="permissions"
                                               class="col-sm-2 col-form-label">{{ __('Permissions') }}*</label>
                                        <div class="col-sm-10">
                                            <select id="permissions" name="permissions[]" class="form-control"
                                                    multiple="multiple">
                                                @foreach($permissions as $permission)
                                                    <option value="{{ $permission->id }}"
                                                    @foreach($user->permissions as $permissionUser)
                                                        @if( $permission->id == $permissionUser->id )
                                                            {{ 'selected' }}
                                                            @endif
                                                        @endforeach
                                                    > {{ strtolower($permission->name) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                                    </div>
                                </form>
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
    <!-- /.content-wrapper -->

    @include('partials.admin.sidebar.control')

@endsection
