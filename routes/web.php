<?php

Auth::routes();

Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/login', 'Auth\LoginController@login');

// 問い合わせ返信アクションをInquiryに追加
Route::patch('inquiries/{inquiry}/reply', 'InquiryController@reply')
    ->name('inquiries.reply')->middleware(['can:reply,inquiry']);
// 問い合わせに対するコメントアクションをInquiryに追加
Route::patch('inquiries/{inquiry}/comment', 'InquiryController@comment')
    ->name('inquiries.comment')->middleware(['can:comment,inquiry']);
Route::resource('inquiries', 'InquiryController')->except(['edit', 'destroy']);

Route::resource('staffs', 'StaffController')->only([
    'index', 'destroy', 'show'
]);

Route::group(['middleware' => ['auth', 'can:auth-only']], function () {
    Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('auth/register', 'Auth\RegisterController@register')->middleware('set.password');
});
   
Route::group(['middleware' => ['auth', 'can:all-staff']], function () {
    Route::view('home', 'home');
    Route::get('auth/logout', 'Auth\LoginController@logout');
});

// 本当に最低限の機能のみを実装するなら、AnswerやCommentへのroutingいらない?
// Route::resource('answers', 'AnswerController@store');
// Route::resource('comments', 'CommentController')->only(['store']);
