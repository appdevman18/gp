@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-4">
            <div class="container">
                <h1 class="px-3 text-center">{{ __('Prices') }}</h1>
                <p class="lead text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium animi asperiores, aspernatur beatae blanditiis consectetur consequuntur delectus dolores eos fugit id in libero magni minus  officiis optio perferendis porro provident quibusdam ratione rem reprehenderit sed sequi temporibus ut.</p>
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Free</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>10 users included</li>
                                <li>2 GB of storage</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free
                            </button>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Pro</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>20 users included</li>
                                <li>10 GB of storage</li>
                                <li>Priority email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Enterprise</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>30 users included</li>
                                <li>15 GB of storage</li>
                                <li>Phone and email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
