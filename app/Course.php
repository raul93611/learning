<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  const PUBLISHED = 1;
  const PENDING = 2;
  const REJECTED = 3;

  public function level(){
    return $this-> belongsTo(Level::class);
  }

  public function category(){
    return $this-> belongsTo(Category::class);
  }

  public function teacher(){
    return $this-> belongsTo(Teacher::class);
  }

  public function reviews(){
    return $this-> hasMany(Review::class);
  }

  public function goals(){
    return $this-> hasMany(Goal::class);
  }

  public function requirements(){
    return $this-> hasMany(Requirement::class);
  }

  public function students(){
    return $this-> belongsToMany(Student::class);
  }
}
