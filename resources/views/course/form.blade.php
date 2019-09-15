@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Dar de alta un curso')])
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form enctype="multipart/form-data" novalidate class="" action="{{ $course-> id ? route('courses.update', ['slug' => $course-> slug]) : route('courses.store') }}" method="post">
        @csrf
        @if ($course-> id)
          @method('PUT')
        @endif

        <div class="card">
          <div class="card-header">
            {{ __('Informacion del curso') }}
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="name">{{ __('Name') }}</label>
              <input type="text" name="name" id="name" class="form-control {{ $errors-> has('name') ? 'is-invalid' : '' }}" value="{{ old('name') ?: $course-> name }}" required autofocus>
              @error('name')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="level">{{ __('Nivel del curso') }}</label>
              <select class="form-control" id="level" name="level_id">
                @foreach (\App\Level::pluck('name', 'id') as $id => $level)
                  <option value="{{ $id }}" {{ old('level') == $id || $course-> level_id == $id ? 'selected' : '' }}>{{ $level }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="category_id">{{ __('Categoria') }}</label>
              <select class="form-control" name="category_id" id="category_id">
                @foreach (\App\Category::groupBy('name')-> pluck('name', 'id') as $id => $category)
                  <option value="{{ $id }}" {{ old('category') == $id || $course-> category_id == $id ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
              </select>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input  {{ $errors-> has('picture') ? 'is-invalid' : '' }}" id="picture" name="picture">
              <label class="custom-file-label" for="picture">{{ __('Escoge una imagen para tu curso.') }}</label>
              @error('picture')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">{{ __('Descripcion') }}</label>
              <textarea name="description" rows="8" class="form-control  {{ $errors-> has('description') ? 'is-invalid' : '' }}" required>{{ old('description') ?: $course-> description }}</textarea>
              @error('description')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">
            {{ __('Requisitos para tomar el curso.') }}
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="requirement1">{{ __('Requerimiento 1') }}</label>
              <input type="text" name="requirements[]" class="form-control {{ $errors-> has('requirements.0') ? 'is-invalid' : '' }}" id="requirement1" value="{{ old('requirements.0') ? old('requirements.0') : ($course-> requirements_count > 0 ? $course-> requirements[0]-> requirement : '') }}">
              @error('requirements.0')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              @if ($course-> requirements_count > 0)
                <input type="hidden" name="requirement_id0" value="{{ $course-> requirements[0]-> id }}">
              @endif
            </div>
            <div class="form-group">
              <label for="requirement2">{{ __('Requerimiento 2') }}</label>
              <input type="text" name="requirements[]" class="form-control {{ $errors-> has('requirements.1') ? 'is-invalid' : '' }}" id="requirement2" value="{{ old('requirements.1') ? old('requirements.1') : ($course-> requirements_count > 1 ? $course-> requirements[1]-> requirement : '') }}">
              @error('requirements.1')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              @if ($course-> requirements_count > 1)
                <input type="hidden" name="requirement_id1" value="{{ $course-> requirements[1]-> id }}">
              @endif
            </div>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">
            {{ __('Que se conseguira al tomar el curso?.') }}
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="goal1">{{ __('Meta 1') }}</label>
              <input type="text" name="goals[]" class="form-control {{ $errors-> has('goals.0') ? 'is-invalid' : '' }}" id="goal1" value="{{ old('goals.0') ? old('goals.0') : ($course-> goals_count > 0 ? $course-> goals[0]-> goal : '') }}">
              @error('goals.0')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              @if ($course-> goals_count > 0)
                <input type="hidden" name="goal_id0" value="{{ $course-> goals[0]-> id }}">
              @endif
            </div>
            <div class="form-group">
              <label for="goal2">{{ __('Meta 2') }}</label>
              <input type="text" name="goals[]" class="form-control {{ $errors-> has('goals.1') ? 'is-invalid' : '' }}" id="goal2" value="{{ old('goals.1') ? old('goals.1') : ($course-> goals_count > 1 ? $course-> goals[1]-> goal : '') }}">
              @error('goals.1')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
              @if ($course-> goals_count > 1)
                <input type="hidden" name="goal_id1" value="{{ $course-> goals[1]-> id }}">
              @endif
            </div>
          </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-block" name="revision">{{ __($btnText) }}</button>
      </form>
    </div>
  </div>
</div>
@endsection
