@extends('layouts.profile')

@section('title', 'All Permission')
@section('breadcrumbs', 'permissions')

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
			                <a class="btn btn-dark" href="{{ route('permissions.create') }}">{{ __('Create New Permission') }}</a>
			            </div>
			        </div>
			    </div>
            	@include('partials.profile.session')
                <!-- Main row -->
                @if(0 < $permissions->count())
            	<div class="row">
            		<table class="table table-hover table table-responsive-lg">
					  	<thead>
						    <tr>
		  					    <th scope="col">#</th>
					      		<th scope="col">{{ __('Name') }}</th>
					      		<th scope="col">{{ __('Slug') }}</th>
					      		<th scope="col">{{ __('Roles') }}</th>
					      		<th scope="col">{{ __('Actions') }}</th>
					    	</tr>
					  	</thead>
					  	<tbody>
				  		@foreach ($permissions as $permission)
					    	<tr>
					      		<td class="col-1">{{ ++$i }}</td>
					      		<td class="col-2">{{ $permission->name }}</td>
					      		<td class="col-3">{{ $permission->slug }}</td>
					      		<td class="col-3">
					      			@foreach($permission->roles as $role)
					      				@if($loop->last)
                                            {{ $role->name }}
                                        @else
                                            {{ $role->name }},
                                        @endif
					      			@endforeach
					      		</td>
					      		<td class="col-3">
					      			<form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                						<a class="btn btn-info btn-sm" href="{{ route('permissions.show', $permission->id) }}">Show</a>
                						@role('admin', 'manager')
                						<a class="btn btn-success btn-sm" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                						@csrf
                						@method('DELETE')
                						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
                						@endrole
            						</form>
					      		</td>
					    	</tr>
		    			@endforeach
    			@else
	        		<tr>
	        			<td>{{ __('No Permissions') }}</td>
	        		</tr>
            	@endif
					  	</tbody>
					</table>
            	</div>
            	
            	<div class="row mt-2">
			    	{{ $permissions->links() }}
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
