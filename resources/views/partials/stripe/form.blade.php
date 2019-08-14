<form class="" action="{{ route('subscriptions.process_subscription') }}" method="post">
  @csrf
  <input type="text" name="coupon" value="" class="form-control mb-2" placeholder="Tienes un cupon?">
  <input type="hidden" name="type" value="{{ $product['type'] }}">
  <stripe-form stripe_key="{{ env('STRIPE_KEY') }}" name="{{ $product['name'] }}" amount="{{ $product['amount'] }}" description="{{ $product['description'] }}">

  </stripe-form>
</form>
