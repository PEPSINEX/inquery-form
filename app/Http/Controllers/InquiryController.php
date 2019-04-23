<?php

namespace App\Http\Controllers;

use App\Inquiry;
use Illuminate\Http\Request;
use Validator;  // validationに使用
use Illuminate\Validation\Rule; // validationに使用
use Illuminate\Http\Response;
use App\Mail\Inquired;  // メール送信機能
use Illuminate\Support\Facades\Mail;  // メール送信機能
use App\Product; // Product情報の取得

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $inquiries = Inquiry::sortCreatedAt('asc');
        
        if ($request->query()) {
            $query = $request->query();
            $inquiries = $inquiries->findByColumnValue(key($query), $query[key($query)]);
        }
        
        return view('inquiries.index', ['inquiries' => $inquiries->get()]);

    }
    
    public function create()
    {
        return view('inquiries.create', ['PRODUCT_TYPES' => Product::getTypes()]);
    }

    public function store(Request $request): Response
    {
        $phone_regexp = '/\A(((0(\d{1}[-(]?\d{4}|\d{2}[-(]?\d{3}|\d{3}[-(]?\d{2}|\d{4}[-(]?\d{1}|[5789]0[-(]?\d{4})[-)]?)|\d{1,4}\-?)\d{4}|0120[-(]?\d{3}[-)]?\d{3})\z/';

        Validator::make($request->all(), [
            'name'          => ['required', 'max:16'],
            'email'         => ['required', 'max:200', 'email'],
            'phone_number'  => ['required', 'max:13', "regex:$phone_regexp"],
            'product_type'  => ['required', 'max:4', Rule::in(Product::getTypes())],
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
