<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Course;
use App\Role;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function opt_for_course(User $user, Course $course){
      return !$user-> teacher || $user-> teacher-> id != $course-> teacher_id;
    }

    public function subscribe(User $user){
      return $user-> role_id != Role::ADMIN && !$user-> subscribed('main');
    }

    public function inscribe(User $user, Course $course){
      return !$course-> students-> contains($user-> student-> id);
    }

    public function review(User $user, Course $course){
      return !$course-> reviews-> contains('user_id', $user-> id);
    }
}
