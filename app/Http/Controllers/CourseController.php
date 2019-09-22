<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Mail\NewStudentInCourse;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Mail;
use App\Review;
use App\Helpers\Helper;

class CourseController extends Controller
{
  public function show(Course $course){
    $course-> load([
      'category',
      'goals',
      'level',
      'requirements',
      'reviews.user',
      'teacher'
    ])-> withCount(['students', 'reviews'])-> get();

    $relatedCourses = $course-> relatedCourses();

    return view('course.detail', compact('course', 'relatedCourses'));
  }

  public function inscribe(Course $course){
    $course-> students()-> attach(auth()-> user()-> student-> id);
    Mail::to($course-> teacher-> user)-> send(new NewStudentInCourse($course, auth()-> user()-> name));
    return back()-> with('message', ['success', __('Inscrito correctamente.')]);
  }

  public function subscribed(){
    $courses = Course::whereHas('students', function($query){
      $query-> where('user_id', auth()-> id());
    })-> get();

    return view('course.subscribed', compact('courses'));
  }

  public function addReview(){
    Review::create([
      'user_id' => auth()-> id(),
      'course_id' => request('course_id'),
      'rating' => (int) request('rating_input'),
      'comment' => request('message')
    ]);

    return back()-> with('message', ['success', __('Muchas gracias por valorar el curso.')]);
  }

  public function create(){
    $course = new Course;
    $btnText = __('Enviar curso para revision');

    return view('course.form', compact('course', 'btnText'));
  }

  public function store(CourseRequest $course_request){
    $picture = Helper::uploadFile('picture', 'courses');
    $course_request-> merge(['picture' => $picture]);
    $course_request-> merge(['teacher_id' => auth()-> user()-> teacher-> id]);
    $course_request-> merge(['status' => Course::PENDING]);
    Course::create($course_request-> input());

    return back()-> with('message', ['success', __('Curso enviado correctamente.')]);
  }

  public function edit($slug){
    $course = Course::with(['requirements', 'goals'])-> withCount(['requirements', 'goals'])-> whereSlug($slug)-> first();
    $btnText = __('Actualizar curso');
    return view('course.form', compact('course', 'btnText'));
  }

  public function update(CourseRequest $course_request, Course $course){
    if($course_request-> hasFile('picture')){
      \Storage::delete('courses/' . $course-> picture);
      $picture = Helper::uploadFile('picture', 'courses');
      $course_request-> merge(['picture' => $picture]);
    }

    $course-> fill($course_request-> input())-> save();
    return back()-> with('message', ['success', __('Curso actualizado')]);
  }

  public function destroy(Course $course){
    try {
      $course-> delete();
      return back()-> with('message', ['success', __('Curso eliminado correctamente')]);
    } catch (\Exception $e) {
      return back()-> with('message', ['success', __('Error eliminando el curso')]);
    }
  }
}
