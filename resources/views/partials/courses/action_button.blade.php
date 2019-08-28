@auth
  @can ('opt_for_course', $course)
    @can ('subscribe', $course)
      <a href="{{ route('subscriptions.plans') }}" class="btn btn-warning btn-block"><i class="fas fa-bolt"></i> {{ __('Subscribirme') }}</a>
    @else
      @can ('inscribe', $course)
        <a href="{{ route('courses.inscribe', ['slug' => $course-> slug]) }}" class="btn btn-warning btn-block"><i class="fas fa-bolt"></i> {{ __('Inscribirme') }}</a>
      @else
        <a href="#" class="btn btn-warning btn-block"><i class="fas fa-bolt"></i> {{ __('Inscrito') }}</a>
      @endcan
    @endcan
  @else
    <a href="#" class="btn btn-warning btn-block"><i class="fas fa-user"></i> {{ __('Soy autor') }}</a>
  @endcan
@else
  <a href="{{ route('login') }}" class="btn btn-warning btn-block"><i class="fas fa-user"></i> {{ __('Acceder') }}</a>
@endauth
