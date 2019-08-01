<div class="row">
  <h3>{{ __('Requisitos del curso') }}</h3>
  <div class="col-md-12">
    <ul class="list-group">
      @forelse ($requirements as $key => $requirement)
        <li class="list-group-item">{{ $requirement-> requirement }}</li>
      @empty
        <div class="alert alert-danger" role="alert">
          {{ __('No hay requisitos para mostrar.') }}
        </div>
      @endforelse
    </ul>
  </div>
</div>
