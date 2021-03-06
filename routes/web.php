<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Intervention\Image\Facades\Image;
use App\Role;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/set_lanugage/{lang}', 'Controller@setLanguage')-> name('set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')-> name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['prefix' => 'course'], function(){
  Route::group(['middleware' => ['auth']], function(){
    Route::get('/subscribed', 'CourseController@subscribed')-> name('courses.subscribed');
    Route::post('/add_review', 'CourseController@addReview')-> name('courses.add_review');
    Route::get('/{course}/inscribe', 'CourseController@inscribe')-> name('courses.inscribe');
    Route::get('/create', 'CourseController@create')-> name('courses.create')-> middleware([sprintf('role:%s', Role::TEACHER)]);
    Route::post('/store', 'CourseController@store')-> name('courses.store')-> middleware([sprintf('role:%s', Role::TEACHER)]);
    Route::put('/{course}/update', 'CourseController@update')-> name('courses.update')-> middleware([sprintf('role:%s', Role::TEACHER)]);
    Route::get('/{course}/edit', 'CourseController@edit')-> name('courses.edit')-> middleware([sprintf('role:%s', Role::TEACHER)]);
    Route::delete('/{course}/destroy', 'CourseController@destroy')-> name('courses.destroy')-> middleware([sprintf('role:%s', Role::TEACHER)]);
  });
  Route::get('/{course}', 'CourseController@show')-> name('course.detail');
});

Route::group(['middleware' => ['auth']], function(){
  Route::group(['prefix' => 'subscriptions'], function(){
    Route::get('/plans', 'SubscriptionController@plans')-> name('subscriptions.plans');
    Route::post('/process_subscription', 'SubscriptionController@processSubscription')-> name('subscriptions.process_subscription');
    Route::get('/admin', 'SubscriptionController@admin')-> name('subscriptions.admin');
    Route::post('/resume', 'SubscriptionController@resume')-> name('subscriptions.resume');
    Route::post('/cancel', 'SubscriptionController@cancel')-> name('subscriptions.cancel');
  });

  Route::group(['prefix' => 'invoices'], function(){
    Route::get('/admin', 'InvoiceController@admin')-> name('invoices.admin');
    Route::get('/{invoice}/download', 'InvoiceController@download')-> name('invoices.download');
  });
});


Route::get('/images/{path}/{attachment}', function($path, $attachment){
  $file = sprintf('storage/%s/%s', $path, $attachment);

  if(File::exists($file)){
    return Image::make($file)-> response();
  }
});

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function(){
  Route::get('/', 'ProfileController@index')-> name('profile.index');
  Route::put('/', 'ProfileController@update')-> name('profile.update');
});

Route::group(['prefix' => 'solicitude', 'middleware' => ['auth']], function(){
  Route::post('/teacher', 'SolicitudeController@teacher')-> name('solicitude.teacher');
});

Route::group(['prefix' => 'teacher', 'middleware' => ['auth']], function(){
  Route::get('/courses', 'TeacherController@courses')-> name('teacher.courses');
  Route::get('/students', 'TeacherController@students')-> name('teacher.students');
  Route::post('/send_message_to_student', 'TeacherController@sendMessageToStudent')-> name('teacher.send_message_to_student');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', sprintf('role:%s', \App\Role::ADMIN)]], function(){
  Route::get('/courses', 'AdminController@courses')-> name('admin.courses');
  Route::get('/courses_json', 'AdminController@coursesJson')-> name('admin.courses_json');
  Route::post('/courses/updateStatus', 'AdminController@updateCourseStatus')-> name('admin.update_course_status');
});
