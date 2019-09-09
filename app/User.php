<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    public static function navigation(){
      return auth()-> check() ? auth()-> user()-> role-> name : 'guest';
    }

    protected static function boot(){
      parent::boot();
      static::creating(function(User $user){
        if(!\App::runningInConsole()){
          $user-> slug = str_slug($user-> name . ' ' . $user-> last_name, '-');
        }
      });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pathAttachment(){
      return '/images/users/' . $this-> picture;
    }

    public function role(){
      return $this-> belongsTo(Role::class);
    }

    public function teacher(){
      return $this-> hasOne(Teacher::class);
    }

    public function reviews(){
      return $this-> hasMany(Review::class);
    }

    public function student(){
      return $this-> hasOne(Student::class);
    }

    public function userSocialAccount(){
      return $this-> hasOne(UserSocialAccount::class);
    }
}
