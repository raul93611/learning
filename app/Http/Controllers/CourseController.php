<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Mail\NewStudentInCourse;
use Illuminate\Support\Facades\Mail;

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
}
