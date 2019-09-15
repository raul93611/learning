<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Student;
use App\Mail\MessageToStudent;
use App\User;
use App\Course;

class TeacherController extends Controller
{
  public function students(){
    $students = Student::with('user', 'courses.reviews')-> whereHas('courses', function($q){
      $q-> where('teacher_id', auth()-> user()-> teacher-> id)-> select('id', 'teacher_id', 'name')-> withTrashed();
    })-> get();

    $actions = 'students.datatables.actions';

    return \DataTables::of($students)-> addColumn('actions', $actions)-> rawColumns(['actions'])-> make(true);
  }

  public function courses(){
    $courses = Course::withCount(['students'])-> with('category', 'reviews')-> whereTeacherId(auth()-> user()-> teacher-> id)-> paginate(12);
    return view('teachers.courses', compact('courses'));
  }

  public function sendMessageToStudent(){
    $info = request('info');
    $data = [];
    parse_str($info, $data);
    $user = User::find($data['user_id']);
    //dd($user);
    try {
      Mail::to($user)-> send(new MessageToStudent(auth()-> user()-> name, $data['message']));
      $success = true;
    } catch (\Exception $e) {
      $success = $e-> getMessage();
    }

    return response()-> json(['res' => $success]);
  }
}
