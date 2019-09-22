@component('mail::message')
#  {{ __('Curso aprobado') }}

{{ __('Tu curso :course ha sido aprobado correctamente', ['course' => $course-> name]) }}
<img src="{{ url('storage/courses/' . $course-> picture) }}" class="img-fluid" alt="">

@component('mail::button', ['url' => url('/courses/' . $course-> slug)])
{{ __('Ir al curso') }}
@endcomponent

{{ __('Gracias') }},
<br>
{{ config('app.name') }}

@endcomponent
