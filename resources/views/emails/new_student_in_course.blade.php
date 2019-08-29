@component('mail::message')
#  {{ __('Nuevo estudiante en tu curso') }}

{{ __('El estudiante :student se ha inscrito a tu curso :course, FELICIDADES!!', ['student' => $student, 'course' => $course-> name]) }}
<img src="{{ url('storage/courses/' . $course-> picture) }}" class="img-fluid" alt="">

@component('mail::button', ['url' => url('/courses/' . $course-> slug)])
{{ __('Ir al curso') }}
@endcomponent

{{ __('Gracias') }},
<br>
{{ config('app.name') }}

@endcomponent
