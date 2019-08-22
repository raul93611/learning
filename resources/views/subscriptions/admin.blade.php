@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Subscripciones')])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('Nombre') }}</th>
            <th scope="col">{{ __('Plan') }}</th>
            <th scope="col">{{ __('ID Subscripcion') }}</th>
            <th scope="col">{{ __('Cantidad') }}</th>
            <th scope="col">{{ __('Alta') }}</th>
            <th scope="col">{{ __('Finaliza en') }}</th>
            <th scope="col">{{ __('Cancelar / Reanudar') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($subscriptions as $key => $subscription)
            <tr>
              <td>{{ $subscription-> id }}</td>
              <td>{{ $subscription-> name }}</td>
              <td>{{ $subscription-> stripe_plan }}</td>
              <td>{{ $subscription-> stripe_id }}</td>
              <td>{{ $subscription-> quantity }}</td>
              <td>{{ $subscription-> created_at }}</td>
              <td>{{ $subscription-> created_at-> format('d/m/Y') }}</td>
              <td>{{ $subscription-> ends_at ? $subscription-> ends_at-> format('d/m/Y') : __('Subscriptcion activa') }}</td>
              <td>
                @if ($subscription-> ends_at)
                  <form class="" action="{{ route('subscriptions.resume') }}" method="post">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $subscription-> name }}">
                    <button type="button" class="btn btn-success" name="button">{{ __('Reanudar') }}</button>
                  </form>
                @else
                  <form class="" action="{{ route('subscriptions.cancel') }}" method="post">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $subscription-> name }}">
                    <button type="button" class="btn btn-success" name="button">{{ __('Cancelar') }}</button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8">{{ __('No hay ninguna subscripcion disponible.') }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
