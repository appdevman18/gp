@extends('layouts.profile')

@section('title', 'Update '. $user->name  )
@section('breadcrumbs', 'update '. strtolower($user->name))

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
                                <form method="POST" action="{{ route('account.update', $user->id) }}" id="updateAccount"
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
            $('.alert-block').delay(2000).fadeOut();
        });
    </script>
    <!-- /.content-wrapper -->

    @include('partials.profile.sidebar.control')

@endsection
