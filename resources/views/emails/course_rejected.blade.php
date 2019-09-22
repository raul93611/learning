@component('mail::message')
#  {{ __('Curso rechazado') }}

{{ __('Tu curso :course ha sido rechazado', ['course' => $course-> name]) }}
<img src="{{ url('storage/courses/' . $course-> picture) }}" class="img-fluid" alt="">

@component('mail::button', ['url' => url('/')])
{{ __('Ir a la plataforma') }}
@endcomponent

{{ __('Gracias') }},
<br>
{{ config('app.name') }}

@endcomponent
