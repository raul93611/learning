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
      @else
        <div class="card">
          <div class="card-header">
            {{ __('Administrar mis cursos') }}
          </div>
          <div class="card-body">
            <a href="{{ route('teacher.courses') }}" class="btn btn-primary btn-block">{{ __('Administrar ahora') }}</a>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">
            {{ __('Mis estudiantes') }}
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered" id="students_table">
              <thead>
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Nombre') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Cursos') }}</th>
                  <th>{{ __('Acciones') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>

                </tr>
              </tbody>
            </table>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@include('partials.modal')
@endsection
@push('scripts')
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
  <script>
    $(document).ready(function(){
      var dt;
      var modal = $('#app_modal');
      var dt = $('#students_table').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 75, 100],
        processing: true,
        serverSide: true,
        ajax: '{{ route('teacher.students') }}',
        language: {
          url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
        },
        columns: [
          {data: 'user.id'},
          {data: 'user.name'},
          {data: 'user.email'},
          {data: 'courses_formatted'},
          {data: 'actions'}
        ]
      });

      $('#students_table').on('click', '.btnEmail', function(){
        var id = $(this).data('id');
        modal.find('.modal-title').text('{{ __('Enviar mensaje') }}');
        modal.find('#modalAction').text('{{ __('Enviar mensaje') }}').show();
        var form = $('<form id="studentMessage"></form>');
        form.append('<input type="hidden" name="user_id" value"' + id + '">');
        form.append('<textarea class="form-control" name="message"></textarea>');
        modal.find('.modal-body').html(form);
        modal.modal();
      });
    });
  </script>
@endpush
