@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Configura tu perfil.')])
@endsection
@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          {{ __('Actualiza tus datos') }}
        </div>
        <div class="card-body">
          <form class="" action="{{ route('profile.update') }}" method="post" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="email">{{ __('Correo electronico:') }}</label>
              <input required type="email" readonly id="email" name="" class="form-control {{ $errors-> has('email') ? 'is-invalid' : '' }}" value="{{ old('email') ?: $user-> email }}">
            </div>
            @if ($errors -> has('email'))
              <span class="is-invalid">
                <strong>{{ $errors-> first('email') }}</strong>
              </span>
            @endif
            <div class="form-group">
              <label for="password">{{ __('Contraseña:') }}</label>
              <input required type="password" id="password" name="password" class="form-control {{ $errors-> has('password') ? 'is-invalid' : '' }}">
              @error('password')
                <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="password_confirmation">{{ __('Confirme contraseña:') }}</label>
              <input required type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="button">{{ __('Actualiza tu informacion') }}</button>
            </div>
          </form>
        </div>
      </div>
      <br>
      @if (!$user-> teacher)
        <div class="card">
          <div class="card-header">
            {{ __('Convertirme en profesor de la plataforma.') }}
          </div>
          <div class="card-body">
            <form class="" action="{{ route('solicitude.teacher') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-primary btn-block" name="button">{{ __('Convertirme en profesor') }}</button>
            </form>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
@push('scripts')
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endpush
