@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Subscribete a uno de nuestros planes.')])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card bg-warning">
        <div class="card-body">
          <h5 class="card-title">{{ __('Mensual') }}</h5>
          <p class="card-text">{{ __(':price / Mes', ['price' => '$9.99']) }}</p>
          <p><i class="fas fa-check"></i> {{ __('Acceso a todos los cursos') }}</p>
          <p><i class="fas fa-check"></i> {{ __('Acceso a todos los archivos') }}</p>
          @include('partials.stripe.form', [
            'product' => [
              'name' => __('Subscripcion'),
              'description' => __('Mensual'),
              'type' => 'monthly',
              'amount' => 999,99
            ]
          ])
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-success">
        <div class="card-body">
          <h5 class="card-title">{{ __('Trimestral') }}</h5>
          <p class="card-text">{{ __(':price / 3 meses', ['price' => '$19.99']) }}</p>
          <p><i class="fas fa-check"></i> {{ __('Acceso a todos los cursos') }}</p>
          <p><i class="fas fa-check"></i> {{ __('Acceso a todos los archivos') }}</p>
          @include('partials.stripe.form', [
            'product' => [
              'name' => __('Subscripcion'),
              'description' => __('Trimestral'),
              'type' => 'quarterly',
              'amount' => 1999,99
            ]
          ])
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-danger">
        <div class="card-body">
          <h5 class="card-title">{{ __('Anual') }}</h5>
          <p class="card-text">{{ __(':price / Año', ['price' => '$89.99']) }}</p>
          <p><i class="fas fa-check"></i> {{ __('Acceso a todos los cursos') }}</p>
          <p><i class="fas fa-check"></i> {{ __('Acceso a todos los archivos') }}</p>
          @include('partials.stripe.form', [
            'product' => [
              'name' => __('Subscripcion'),
              'description' => __('Anual'),
              'type' => 'yearly',
              'amount' => 8999,99
            ]
          ])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
