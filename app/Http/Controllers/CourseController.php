<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

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
}
