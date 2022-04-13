<div class="col-md-12 text-center">
    <div class="mb-1 py-4">
        <h4 class="font-weight-bold">
            {{ __('Поддерживаемые ресурсы') }}
        </h4>
    </div>
    <div class="row lead font-weight-bold">
        @foreach($stores as $store)
            <div class="col-sm-4">
                <p class="">{{ $store }}</p>
            </div>
        @endforeach
    </div>
</div>
