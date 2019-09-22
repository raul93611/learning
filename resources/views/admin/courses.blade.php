@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Cursos')])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <courses-list
      :labels="{{json_encode([
        'name' => __('Nombre'),
        'status' => __('Estado'),
        'activate_deactivate' => __('Activar/Desactivar'),
        'approve' => __('Aprobar'),
        'reject' => __('Rechazar')
        ])}}"
        route="{{ route('admin.courses_json') }}"
        >
      </courses-list>
    </div>
  </div>
</div>
@endsection
