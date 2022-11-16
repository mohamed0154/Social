<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\notttif;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ContentController;
use App\Http\Controllers\User\Messages\MessagesController ;
use App\Http\Controllers\User\Friends\FriendController;
use App\Http\Controllers\User\Search\SearchController;
use App\Http\Controllers\Auth\LogoutController;
use Carbon\Carbon;
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


Route::get('/ttt', function () {
    // user_none_active();
      $s= Carbon::create(date('y-m-d h:m:s',time()));
      return $s->minute;
  });

Route::get('/not', function () {
    // user_none_active();
      return view('not');
  });
  Route::POST('/notif',[notttif::class,'notif'])->name('mess_us');

Route::get('/', function () {
  // user_none_active();
    return view('welcome');
});
// Route::get('hh',function(){
//    return view('home');
// });
//////////////////////////////Sign Up////////////////////////////////////
Route::POST('sign_up_user',[RegisterController::class,'sign_up_user'])->name('sign_up_user');
Route::POST('authLogin',[LoginController::class,'authLogin'])->name('authLogin');

                             /////////////////////////
///////////////////////////////////Login Socilaite////////////////////////
Route::get('login/{provider}',[LoginController::class,'login_redirect'])->name('login_redirect');
Route::get('login/{provider}/callback',[LoginController::class,'redirect_callback'])->name('redirect_callback');


Auth::routes();


Route::group(['middleware'=>'auth'],function(){
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

  Route::POST('store_post',[ContentController::class,'store_post'])->name('store_post');
  Route::POST('store_comment',[ContentController::class,'store_comment'])->name('store_comment');
  Route::POST('store_like',[ContentController::class,'store_like'])->name('store_like');

                ////////////////////////////////////
////////////////////////////////Search/////////////////////////////////////
  Route::POST('search',[SearchController::class,'search'])->name('searchable');

               ////////////////////////////////////
////////////////////////////////Hide Counter Notify/////////////////////////////////////
Route::POST('hide_counter_notify',[ContentController::class,'hide_counter_notify'])->name('hide_counter_notify');


               ////////////////////////////////////
////////////////////////////////Search/////////////////////////////////////
Route::get('profile/{user_id}',[ProfileController::class,'profile'])->name('profile');
Route::POST('change_profile',[ProfileController::class,'change_profile'])->name('change_profile');

               ////////////////////////////////////
////////////////////////////////Frends Requests/////////////////////////////////////
Route::POST('add_friend',[FriendController::class,'add_friend'])->name('add_friend');
Route::POST('accept_or_refuse',[FriendController::class,'accept_or_refuse'])->name('accept_or_refuse');


                 ////////////////////////////////////
////////////////////////////////Messages/////////////////////////////////////
Route::POST('message_user',[MessagesController::class,'message_user'])->name('message_user');
Route::POST('send_messages',[MessagesController::class,'send_messages'])->name('send_messages');
});
