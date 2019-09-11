<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = ['user_id', 'title'];
  protected $appends = ['courses_formatted'];

  public function user(){
    return $this-> belongsTo(User::class);
  }

  public function courses(){
    return $this-> belongsToMany(Course::class);
  }

  public function getCoursesFormattedAttribute(){
    return $this-> courses-> pluck('name')-> implode('<br>');
  }
}
