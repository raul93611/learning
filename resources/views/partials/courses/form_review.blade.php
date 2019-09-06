@cannot ('inscribe', $course)
  @can ('review', $course)
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="text-muted">{{ __('Escribe una valoracion.') }}</h2>
        <hr>
        <form class="form-inline" id="rating_form" action="{{ route('courses.add_review') }}" method="post">
          @csrf
          <h5 id="list_rating" class="text-center mr-3">
            <i class="fas fa-star" data-number="1"></i>
            <i class="far fa-star" data-number="2"></i>
            <i class="far fa-star" data-number="3"></i>
            <i class="far fa-star" data-number="4"></i>
            <i class="far fa-star" data-number="5"></i>
          </h5>
          <input type="hidden" name="rating_input" value="1">
          <input type="hidden" name="course_id" value="{{ $course-> id }}">
          <div class="form-group">
            <textarea name="message" rows="8" cols="80" class="form-control"></textarea>
          </div>
          <button type="submit" class="ml-3 btn btn-warning" name="button">{{ __('Valorar el curso') }}</button>
        </form>
      </div>
    </div>
  @endcan
@endcannot
@push('scripts')
  <script>
    $(document).ready(function(){
      var ratingSelector = $('#list_rating');
      ratingSelector.find('i').click(function(){
        var number = $(this).data('number');
        $('#rating_form').find('input[name="rating_input"]').val(number);
        ratingSelector.find('i').removeClass('fas').each(function(index){
          if(index+1 <= number){
            $(this).addClass('fas');
          }
        });
      });
    });
  </script>
@endpush
