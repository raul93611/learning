<div class="card m-2">
  <img src="{{ $course-> pathAttachment() }}" class="card-img-top" alt="{{ $course-> name }}">
  <div class="card-body">
    <h1 class="text-center text-primary"><i class="fas fa-check-circle"></i></h1>
    @include('partials.courses.rating')
    <h5 class="card-title">{{ $course-> name }}</h5>
    <h6><span class="badge badge-info">{{ $course-> category-> name }}</span></h6>
    <p class="card-text">{{ str_limit($course-> description, 100) }}</p>
    <a href="#" class="btn btn-primary btn-block">{{ __('Mas informacion') }}</a>
  </div>
</div>
