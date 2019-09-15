<form class="" action="{{ route('courses.destroy', ['slug' => $course-> slug]) }}" method="post">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-danger" name="button">{{ __('Eliminar curso') }}</button>
</form>
