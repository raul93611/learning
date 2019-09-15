@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Cursos desarrollados por mi.')])
@endsection

@section('content')
<div class="container">
  <div class="row align-items-center ">
    @forelse ($courses as $key => $course)
      <div class="col-md-6 my-1">
        <div class="row">
          <div class="col-md-4 m-0 p-0">
            <a href="{{ route('course.detail', $course-> slug) }}"><img class="img-fluid" src="{{ $course-> pathAttachment() }}" alt="{{ $course-> name }}"></a>
          </div>
          <div class="col-md-8 p-3 ">
            <h4>{{ $course-> name }}</h4>
            <h5>{{ $course-> category-> name }}</h5>
            <h5>{{ __('Estudiantes') }}: {{ $course-> students_count }}</h5>
            @include('partials.courses.rating', ['rating' => $course-> rating])
            @include('partials.courses.teacher_action_buttons')
          </div>
        </div>
      </div>
    @empty
      <div class="alert alert-danger" role="alert">
        {{ __('No hay cursos para mostrar.') }}
        <a href="{{ route('courses.create') }}" class="btn btn-primary btn-block">{{ __('Crea tu primer curso') }}</a>
      </div>
    @endforelse
  </div>
  <div class="row justify-content-center">
    {{ $courses-> links() }}
  </div>
</div>
@endsection
