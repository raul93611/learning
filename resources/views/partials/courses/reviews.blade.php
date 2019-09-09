<div class="row align-items-center ">
  <div class="col-md-12">
    <h2 class="text-muted">{{ __('Valoraciones') }}</h2>
    @forelse ($course-> reviews as $key => $review)
      <div class="col-md-6 text-light bg-primary my-1">
        <div class="row">
          <div class="col-md-4 m-0 p-0">
            <img class="img-fluid rounded" src="{{ $review-> user-> pathAttachment() }}" alt="">
          </div>
          <div class="col-md-8 p-3 ">
            @if ($review-> comment)
              <h4>{{ $review-> comment }}</h4>
            @endif
            <h6>{{ $review-> created_at-> format('d/m/Y') }}</h6>
            @include('partials.courses.rating', ['rating' => $review-> rating])
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-danger" role="alert">
        {{ __('No hay valoraciones.') }}
      </div>
    @endforelse
  </div>
</div>
