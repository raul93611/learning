<div class="row">
  <h3>{{ __('Metas del curso') }}</h3>
  <div class="col-md-12">
    <ul class="list-group">
      @forelse ($goals as $key => $goal)
        <li class="list-group-item">{{ $goal-> goal }}</li>
      @empty
        <div class="alert alert-danger" role="alert">
          {{ __('No hay metas para mostrar.') }}
        </div>
      @endforelse
    </ul>
  </div>
</div>
