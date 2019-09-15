<div class="btn-group">
  @if ($course-> status == \App\Course::PUBLISHED)
    <a href="{{ route('course.detail', ['slug' => $course-> slug]) }}" class="btn btn-primary">{{ __('Detalle') }}</a>
    <a href="{{ route('courses.edit', ['slug' => $course-> slug]) }}" class="btn btn-primary">{{ __('Editar') }}</a>
    @include('partials.courses.delete')
  @elseif ($course-> status == \App\Course::PENDING)
    <a href="#" class="btn btn-info">{{ __('Curso pendiente  de revision') }}</a>
    <a href="{{ route('course.detail', ['slug' => $course-> slug]) }}" class="btn btn-primary">{{ __('Detalle') }}</a>
    <a href="{{ route('courses.edit', ['slug' => $course-> slug]) }}" class="btn btn-primary">{{ __('Editar') }}</a>
    @include('partials.courses.delete')
  @else
    <a href="#" class="btn btn-danger">{{ __('Curso rechazado') }}</a>
    @include('partials.courses.delete')
  @endif
</div>
