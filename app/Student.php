<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $fillable = ['user_id', 'title'];
  public function user(){
    return $this-> belongsTo(User::class);
  }

  public function courses(){
    return $this-> belongsToMany(Course::class);
  }
}
