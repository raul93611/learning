@extends('layouts.app')

@section('jumbotron')
  @include('partials.courses.jumbotron')
@endsection

@section('content')
<div class="container">
  @include('partials.courses.goals', ['goals' => $course-> goals])
  <br>
  @include('partials.courses.requirements', ['requirements' => $course-> requirements])
  <br>
  @include('partials.courses.description')
  <br>
  @include('partials.courses.related')
</div>
@endsection
