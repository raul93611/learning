<div class="col-md-4">
  <div class="card">
    <div class="card-header">{{ __('Socialite') }}</div>
    <div class="card-body">
      <a href="{{ route('social_auth', ['driver' => 'github']) }}" class="btn btn-dark btn-block btn-lg"><i class="fab fa-github"></i> {{ __('GitHub') }}</a>
      <a href="{{ route('social_auth', ['driver' => 'facebook']) }}" class="btn btn-primary btn-block btn-lg"><i class="fab fa-facebook-f"></i> {{ __('Facebook') }}</a>
    </div>
  </div>
</div>
