@include('partials.navigations.student')
<li class="nav-item"><a class="nav-link" href="{{ route('teacher.courses') }}">{{ __('Cursos desarrollados por mi') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('courses.create') }}">{{ __('Crear curso') }}</a></li>
