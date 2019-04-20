<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Inquiry;
use Illuminate\Http\Request;
use Validator;  // validationに使用
use Illuminate\Support\Facades\Mail;  // メール送信機能
use Illuminate\Support\Facades\Auth;  // ログインユーザー取得

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'content' => ['required']
        ])->validate();

        $answer = new Answer;
        $answer->content = $request->content;
        $answer->staff_id = Auth::user()->id;
        $answer->inquiry_id = $request->inquiry_id;
        $answer->save();

        Inquiry::where('id', $request->inquiry_id)->update(['status' => '10', 'staff_id' => Auth::user()->id]);

        return redirect()->action('InquiryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
