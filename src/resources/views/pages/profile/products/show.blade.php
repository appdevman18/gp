@extends('layouts.profile')

@section('title', $product->title )
@section('breadcrumbs', strtolower($product->title))

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Main row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="urlForCheck" class="col-sm-2 col-form-label">{{ __('Link') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="urlForCheck" class="form-control" id="urlForCheck" placeholder="Enter Url For Check" value="{{ $product->url ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $product->title ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="store" class="col-sm-2 col-form-label">{{ __('Store') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="store" class="form-control" id="store" placeholder="Store" value="{{ $product->store ?? '' }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">{{ __('Price') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="
@foreach($product->prices as $price)
@if($loop->last)
{{$price->value ?? ''}}
@endif
@endforeach" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <form method="POST" action="{{ route('followProduct') }}" id="followProduct">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <!-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> -->
                                            <button type="submit" class="btn btn-dark">
                                                @if( $product->isFollow() )
                                                    {{ __('UnFollow') }}
                                                    <input type="hidden" name="follow" value="unFollow">
                                                @else
                                                    {{ __('Follow') }}
                                                    <input type="hidden" name="follow" value="follow">
                                                @endif
                                            </button>
                                        </form>
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
    <!-- /.content-wrapper -->
    <script>
        var dataPrices = <?php echo json_encode($product->prices); ?>;
        var priceValue = [];
        var priceDate = [];

        for(const price of dataPrices) {
            priceValue.push(price.value);
            priceDate.push(price.created_at);
        }

        // console.log(priceValue);
        // console.log(priceDate);

        const labels = priceDate;

        const data = {
            labels: labels,
            datasets: [{
                label: '{{ __('Price') }}',
                backgroundColor: 'rgb(255, 99, 132, 0.4)',
                borderColor: 'rgb(255, 99, 132, 0.6)',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15,
                data: priceValue,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
            }
        };
    </script>

    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    @include('partials.profile.sidebar.control')

@endsection
