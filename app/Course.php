<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
  use SoftDeletes;

  const PUBLISHED = 1;
  const PENDING = 2;
  const REJECTED = 3;

  protected $withCount = ['reviews', 'students'];
  protected $fillable = ['teacher_id', 'level_id', 'category_id', 'name', 'description', 'picture', 'status'];

  public static function boot(){
    parent::boot();

    static::saving(function(Course $course){
      if(!\App::runningInConsole()){
        $course-> slug = str_slug($course-> name, '-');
      }
    });


    static::saved(function(Course $course){
      if(!\App::runningInConsole()){
        if(request('requirements')){
          foreach (request('requirements') as $key => $requirement_input) {
            if($requirement_input){
              Requirement::updateOrCreate([
                'id' => request('requirement_id' . $key)
              ], [
                'course_id' => $course-> id,
                'requirement' => $requirement_input
              ]);
            }
          }
        }

        if(request('goals')){
          foreach (request('goals') as $key => $goal_input) {
            if($goal_input){
              Goal::updateOrCreate([
                'id' => request('goal_id' . $key)
              ], [
                'course_id' => $course-> id,
                'goal' => $goal_input
              ]);
            }
          }
        }
      }
    });
  }

  public function getRouteKeyName(){
    return 'slug';
  }

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

  public function pathAttachment(){
    return '/images/courses/' . $this-> picture;
  }

  public function getRatingAttribute(){
    return $this-> reviews-> avg('rating');
  }

  public function relatedCourses(){
    return Course::with('reviews')-> whereCategoryId($this-> category_id)-> where('id', '!=', $this-> id)-> latest()-> limit(6)-> get();
  }
}
