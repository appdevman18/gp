@extends('layouts.profile')

@section('title', $user->name )
@section('breadcrumbs', strtolower($user->name))

@section('content')

    @include('partials.profile.navbar')

    @include('partials.profile.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.profile.content-header')
    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
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
                                    <form action="{{ route('account.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('account.edit', $user) }}" class="btn btn-success">{{ __('Edit') }}</a>
                                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.col-md-12 -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @include('partials.profile.sidebar.control')


@endsection
