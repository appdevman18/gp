@extends('layouts.admin')

@section('title', 'All Users')
@section('breadcrumbs', 'all users')

@section('content')

    @include('partials.admin.navbar')

    @include('partials.admin.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.admin.content-header')

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-dark" href="{{ route('users.create') }}">{{ __('Create') }}</a>
                        </div>
                    </div>
                </div>
            @include('partials.admin.session')
            <!-- Main row -->
                 @if(0 < $users->count())
                    <div class="row">
                        <table class="table table-hover table table-responsive-lg">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Account') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="col-1">{{ ++$i }}</td>
                                    <td class="col-2">{{ $user->name }}</td>
                                    <td class="col-2">{{ $user->email }}</td>
                                    <td class="col-2">{{ $user->account->value }}</td>
                                    <td class="col-2">{{ $user->status->value }}</td>
                                    <td class="col-3">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('users.show', $user->id) }}">Show</a>
                                            @role('admin', 'manager')
                                            <a class="btn btn-success btn-sm" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            @endrole
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="row">
                        {{ __('No Users') }}
                    </div>
                @endif
                <div class="row mt-2">
                    {{ $users->links() }}
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

   <script>
        $(document).ready(function () {
            $('.alert-block').delay(2000).fadeOut();
        });
    </script>

    @include('partials.admin.sidebar.control')

@endsection
