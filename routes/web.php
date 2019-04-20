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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth/login', 'Auth\LoginController@showLoginForm');
Route::post('/auth/login', 'Auth\LoginController@login');

Route::resource('inquiries', 'InquiryController');

Route::group(['middleware' => ['auth', 'can:auth-only']], function () {
    Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/auth/register', 'Auth\RegisterController@register')->middleware('set.password');
    Route::resource('staffs', 'StaffController')->only([
        'index', 'destroy'
    ]);
});
   
Route::group(['middleware' => ['auth', 'can:all-staff']], function () {
    Route::get('/auth/logout', 'Auth\LoginController@logout');
    Route::view('/home', 'home');
    Route::resource('answers', 'AnswerController', ['except' => ['create']]);
});