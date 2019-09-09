<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Role;

class SolicitudeController extends Controller
{
  public function teacher(){
    $user = auth()-> user();

    if(!$user-> teacher){
      \DB::beginTransaction();
      try {
        $user-> role_id = Role::TEACHER;
        $user-> save();
        Teacher::create([
          'user_id' => $user-> id
        ]);
        $success = true;
      } catch (\Exception $e) {
        \DB::rollback();
        $success = $e-> getMessage();
      }

      if($success){
        \DB::commit();
        auth()-> logout();
        auth()-> loginUsingId($user-> id);
        return back()-> with('message', ['success', __('Felicidades ya eres un profesor en la plataforma.')]);
      }
    }

    return back()-> with('message', ['danger', 'Algo ha fallado']);
  }
}
