@extends('layouts.profile')

@section('title', 'All Products')
@section('breadcrumbs', 'products')

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
			                <a class="btn btn-dark" href="{{ route('products.create') }}">{{ __('Create New Product') }}</a>
			            </div>
			        </div>
			    </div>
            	@include('partials.profile.session')
                <!-- Main row -->
                @if(0 < $products->count())
            	<div class="row">
            		<table class="table table-hover table table-responsive-lg">
					  	<thead>
						    <tr>
		  					    <th scope="col">#</th>
					      		<th scope="col">{{ __('Title') }}</th>
					      		<th scope="col">{{ __('URL') }}</th>
					      		<th scope="col">{{ __('Store') }}</th>
					      		<th scope="col">{{ __('Current Price') }}</th>
					      		<th scope="col">{{ __('Actions') }}</th>
					    	</tr>
					  	</thead>
					  	<tbody>
					  		@foreach ($products as $product)
						    	<tr>
						      		<td class="col-1">{{ ++$i }}</td>
						      		<td class="col-2">{{ $product->title }}</td>
						      		<td class="col-3">{{ $product->url }}</td>
						      		<td class="col-2">{{ $product->store }}</td>
						      		<td class="col-1">
						      			@foreach($product->prices as $price)
						      				@if($loop->last)
						      					{{ $price->value }}
										    @endif
						      			@endforeach
						      		</td>
						      		<td class="col-2">
						      			<form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    						<a class="btn btn-info btn-sm" href="{{ route('products.show', $product->id) }}">Show</a>
                    						@role('admin', 'manager')
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
        			{{ __('No Products') }}
        		</div>
            	@endif
            	<div class="row mt-2">
			    	{{ $products->links() }}
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
