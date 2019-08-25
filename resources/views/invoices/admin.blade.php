@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', ['icon' => 'th', 'title' => __('Manejar mis facturas')])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">{{ __('Fecha de subscripcion') }}</th>
            <th scope="col">{{ __('Costo de la subscripcion') }}</th>
            <th scope="col">{{ __('Cupon') }}</th>
            <th scope="col">{{ __('Descargar factura') }}</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($invoices as $key => $invoice)
            <tr>
              <td>{{ $invoice-> date()-> format('d/m/Y') }}</td>
              <td>{{ $invoice-> total() }}</td>
              @if ($invoice-> hasDiscount())
                <td>{{ __('Cupon') }}: {{ $invoice-> coupon() }}/{{ $invoice-> discount() }}</td>
              @else
                <td>{{ __('Nose ha utilizado ningun cupon.') }}</td>
              @endif
              <td>
                <a href="{{ route('invoices.download', ['id' => $invoice-> id]) }}" class="btn btn-primary">{{ __('Descargar') }}</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8">{{ __('No hay ninguna factura disponible.') }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
