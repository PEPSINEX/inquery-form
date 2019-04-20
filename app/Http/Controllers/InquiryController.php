<?php

namespace App\Http\Controllers;

use App\Inquiry;
use Illuminate\Http\Request;
use Validator;  // validationに使用
use Illuminate\Validation\Rule; // validationに使用
use Illuminate\Http\Response;
use App\Mail\Inquired;  // メール送信機能
use Illuminate\Support\Facades\Mail;  // メール送信機能

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = Inquiry::all();
        return view('inquiries.index', ['inquiries' => $inquiries]);

    }
    public function create()
    {
        return view('inquiries.create', ['PRODUCT_TYPES' => Inquiry::PRODUCT_TYPES]);
    }

    public function store(Request $request): Response
    {
        Validator::make($request->all(), [
            'name'          => ['required', 'max:16'],
            'email'         => ['required', 'max:200', 'email'],
            'phone_number'  => ['required', 'max:12'],
            'product_type'  => ['required', 'max:4', Rule::in(Inquiry::PRODUCT_TYPES)],
            'content'       => ['required', 'max:2000']
        ])->validate();

        $inquiry = new Inquiry;
        // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->phone_number = $request->phone_number;
        $inquiry->product_type = $request->product_type;
        $inquiry->content = $request->content;
        // DBに保存
        $inquiry->save();
        // 登録データ確認用。実際にはこの後メール送信
        $response = response(
            "お問い合わせを承りました。<br>
            確認メールをお送りしましたのでお確かめ下さい。担当者から折り返し返答いたします。<br>
            メールが届かない場合はメールアドレスが間違っています。メールアドレスを確認の上、再度お問い合わせフォームから送信お願いいたします。");
        Mail::to($inquiry->email)->send(new Inquired($inquiry));
        return $response;
        
    }

    public function show(Inquiry $inquiry)
    {
        return view('inquiries.show', ['inquiry' => $inquiry]);
    }
}
