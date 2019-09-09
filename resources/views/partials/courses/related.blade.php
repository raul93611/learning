<div class="row align-items-center ">
  @forelse ($relatedCourses as $key => $relatedCourse)
    <div class="col-md-6 text-light bg-primary my-1">
      <div class="row">
        <div class="col-md-4 m-0 p-0">
          <a href="{{ route('course.detail', $relatedCourse-> slug) }}"><img class="img-fluid" src="{{ $relatedCourse-> pathAttachment() }}" alt="{{ $relatedCourse-> name }}"></a>
        </div>
        <div class="col-md-8 p-3 ">
          <h4>{{ $relatedCourse-> name }}</h4>
          @include('partials.courses.rating', ['rating' => $relatedCourse-> rating])
        </div>
      </div>
    </div>
  @empty
    <div class="alert alert-danger" role="alert">
      {{ __('No hay cursos relacionados para mostrar.') }}
    </div>
  @endforelse
</div>
