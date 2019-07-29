@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Accede a uno de estos cursos.')])
@endsection

@section('content')
<div class="container">
  <div class="row">
    @forelse ($courses as $key => $course)
      <div class="col-md-3">
        @include('partials.courses.course_card')
      </div>
    @empty
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          {{ __('No hay cursos disponibles!') }}
        </div>
      </div>
    @endforelse
  </div>
  <div class="row justify-content-center">
    {{ $courses-> links() }}
  </div>
</div>
@endsection
