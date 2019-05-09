<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Inquiry;
use Illuminate\Support\Facades\Mail;  // メール送信機能
use Illuminate\Support\Facades\Auth;  // ログインユーザー取得
use App\Http\Requests\StoreAnswer; // バリデーション後のフォームリクエスト

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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswer $request)
    {
        $validated = $request->validated()['answers'];
        $validated['staff_id'] = Auth::user()->id;

        $answer = Answer::create($validated);
        Inquiry::where('id', $answer->inquiry_id)->update(['status' => '10', 'staff_id' => $answer->staff_id]);

        return redirect()->route('inquiries.show', ['id' => $answer->inquiry_id]);
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
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAnswer $request, Answer $answer)
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
