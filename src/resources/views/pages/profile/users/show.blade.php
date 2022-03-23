@extends('layouts.profile')

@section('title', auth()->user()->name )
@section('breadcrumbs', strtolower(auth()->user()->name))

@section('content')

    @include('partials.profile.navbar')

    @include('partials.profile.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.profile.content-header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            
                <!-- Main row -->
                <div class="row">       

                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">{{ __('Username') }}</dt>
                                        <dd class="col-sm-8">{{ $user->name ?? '' }}</dd>
                                    <dt class="col-sm-4">{{ __('Email') }}</dt>
                                        <dd class="col-sm-8">{{ $user->email ?? ''}}</dd>
                                    <dt class="col-sm-4">{{ __('Role') }}</dt>
                                        <dd class="col-sm-8">{{ $user->roles[0]['name'] ?? '' }}</dd>
                                    <dt class="col-sm-4">{{ __('Permissions') }}</dt>
                                        <dd class="col-sm-8">
                                            @foreach($user->permissions as $permission)
                                                @if($loop->last)
                                                    {{ $permission->name ?? ''}}
                                                @else
                                                    {{ $permission->name ?? ''}},
                                                @endif
                                            @endforeach
                                        </dd>
                                    <dt class="col-sm-4">{{ __('Account') }}</dt>
                                        <dd class="col-sm-8">{{ $user->account->value ?? ''}}</dd>
                                    <dt class="col-sm-4">{{ __('Status') }}</dt>
                                        <dd class="col-sm-8">{{ $user->status->value ?? ''}}</dd>
                                    <dt class="col-sm-4">{{ __('Phone Number') }}</dt>
                                        <dd class="col-sm-8">{{ $user->phone ?? '' }}</dd>
                                        <dt class="col-sm-4">{{ __('Telegram Username Link') }}</dt>
                                        <dd class="col-sm-8">{{ $user->telegram_username ?? '' }}</dd>
                                    <dt class="col-sm-4">{{ __('My Products') }}</dt>
                                        <dd class="col-sm-8">{{ count($user->products) ?? '' }}</dd>
                                    <dt class="col-sm-4">{{ __('Notification Service') }}</dt>
                                        <dd class="col-sm-8">{{ 'Telegram, Whatsapp, Email' ?? '' }}</dd>
                                </dl>
                                <div class="card-footer">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-dark">{{ __('Edit') }}</a>
                                </div>
                            </div>
                        </div>

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
