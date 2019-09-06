<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Mail\NewStudentInCourse;
use Illuminate\Support\Facades\Mail;
use App\Review;

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
}
