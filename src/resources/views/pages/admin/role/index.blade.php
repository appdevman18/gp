@extends('layouts.profile')

@section('title', 'All Roles')
@section('breadcrumbs', 'roles')

@section('content')

    @include('partials.profile.navbar')

    @include('partials.profile.sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('partials.profile.content-header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            	<div class="row mb-2">
			        <div class="col-lg-12 margin-tb">
			            <div class="pull-right">
			                <a class="btn btn-dark" href="{{ route('roles.create') }}">{{ __('Create New Role') }}</a>
			            </div>
			        </div>
			    </div>
            	@include('partials.profile.session')
                <!-- Main row -->
                @if(0 < $roles->count())
            	<div class="row">
            		<table class="table table-hover table table-responsive-lg">
					  	<thead>
						    <tr>
		  					    <th scope="col">#</th>
					      		<th scope="col">{{ __('Name') }}</th>
					      		<th scope="col">{{ __('Slug') }}</th>
					      		<th scope="col">{{ __('Permissions') }}</th>
					      		<th scope="col">{{ __('Actions') }}</th>
					    	</tr>
					  	</thead>
					  	<tbody>
					  		@foreach ($roles as $role)
						    	<tr>
						      		<td class="col-1">{{ ++$i }}</td>
						      		<td class="col-2">{{ $role->name }}</td>
						      		<td class="col-3">{{ $role->slug }}</td>
						      		<td class="col-3">
						      			@foreach($role->permissions as $permission)
						      				@if($loop->last)
                                                {{ $permission->name }}
                                            @else
                                                {{ $permission->name }},
                                            @endif
						      			@endforeach
						      		</td>
						      		<td class="col-3">
						      			<form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                    						<a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
                    						@role('admin', 'manager')
                    						<a class="btn btn-success btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    						@csrf
                    						@method('DELETE')
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
        			{{ __('No Roles') }}
        		</div>
            	@endif
            	<div class="row mt-2">
			    	{{ $roles->links() }}
            	</div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script>
	    $(document).ready(function() {
	        $('.alert-block').delay(2000).fadeOut();
	    });
	</script>

@endsection
