<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VueTables\EloquentVueTables;
use App\Course;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseApproved;
use App\Mail\CourseRejected;

class AdminController extends Controller
{
  public function courses(){
    return view('admin.courses');
  }

  public function coursesJson(){
    if(request()-> ajax()){
      $vuetables = new EloquentVueTables;
      $data = $vuetables-> get(new Course, ['id', 'name', 'status'], ['reviews']);
      return response()-> json($data);
    }

    return abort(401);
  }

  public function updateCourseStatus(){
    if(request()-> ajax()){
      $course = Course::find(request('courseId'));

      if((int)$course-> status !== Course::PUBLISHED && !$course-> previous_approved && request('status') == Course::PUBLISHED){
        $course-> previous_approved = true;
        Mail::to($course-> teacher-> user)-> send(new CourseApproved($course));
      }

      if((int)$course-> status !== Course::REJECTED && !$course-> previous_rejected && request('status') == Course::REJECTED){
        $course-> previous_rejected = true;
        Mail::to($course-> teacher-> user)-> send(new CourseRejected($course));
      }

      $course-> status = request('status');
      $course-> save();
      return response()-> json(['msg' => 'ok']);
    }

    return abort(401);
  }
}
