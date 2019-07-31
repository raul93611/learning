<div class="container-fluid">
  <div class="row align-items-center text-light bg-primary">
    <div class="col-md-4 m-0 p-0">
      <img class="img-fluid" src="{{ $course-> pathAttachment() }}" alt="{{ $course-> name }}">
    </div>
    <div class="col-md-6 p-3 ">
      <h3>{{ $course-> name }}</h3>
      <h4>{{ __('Profesor') }}: {{ $course-> teacher-> user-> name }}</h4>
      <h4>{{ __('Categoria') }}: {{ $course-> category-> name }}</h4>
      <h4>{{ __('Fecha de publicación') }}: {{ $course-> created_at-> format('d/m/Y') }}</h4>
      <h4>{{ __('Fecha de actualización') }}: {{ $course-> updated_at-> format('d/m/Y') }}</h4>
      <h4>{{ __('Estudiantes inscritos') }}: {{ $course-> students_count }}</h4>
      <h4>{{ __('Numero de valoraciones') }}: {{ $course-> reviews_count }}</h4>
      @include('partials.courses.rating', ['course' => $course])
    </div>
    <div class="col-md-2">
      @include('partials.courses.action_button')
    </div>
  </div>
</div>
