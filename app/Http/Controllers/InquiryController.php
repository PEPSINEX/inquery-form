<?php

namespace App\Http\Controllers;

use App\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\Inquired;  // メール送信機能
use App\Mail\Reply;  // メール送信機能
use Illuminate\Support\Facades\Mail;  // メール送信機能
use Illuminate\Support\Facades\Auth;  // ログインユーザーの取得
use App\Http\Requests\StoreInquiry; // バリデーション後のフォームリクエスト
use App\Http\Requests\ReplyMailText; // バリデーション後のフォームリクエスト
use App\Http\Requests\CommentContent; // バリデーション後のフォームリクエスト

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Inquiry::class, 'inquiry');
    }

    public function index(Request $request)
    {
        $query = $request->input('status');

        if ($query) {
            $inquiries = Inquiry::orderBy('created_at', 'asc')->where('status', $query)->paginate(10);
        }else{
            $inquiries = Inquiry::orderBy('created_at', 'asc')->paginate(10);
        }
        
        return view('inquiries.index', ['inquiries' => $inquiries]);
    }
    
    public function create()
    {
        return view('inquiries.create', ['PRODUCT_TYPES' => config('const.PRODUCT_A')]);
    }

    public function store(StoreInquiry $request)
    {
        $inquiry = Inquiry::create($request->validated()['inquiries']);
        $response = response(
            "お問い合わせを承りました。<br>
            確認メールをお送りしましたのでお確かめ下さい。担当者から折り返し返答いたします。<br>
            メールが届かない場合はメールアドレスが間違っています。メールアドレスを確認の上、再度お問い合わせフォームから送信お願いいたします。");
        Mail::to($inquiry->email)->send(new Inquired($inquiry));
        return $response;
    }

    public function show(Inquiry $inquiry)
    {
        return view('inquiries.show', [
            'inquiry'   => $inquiry,
            'answers'   => $inquiry->answers,
            'comments'   => $inquiry->comments,
        ]);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $staff_id = $request->input('status') === '00' ? null : Auth::id();

        if ( $request->input('status') ) {
            Inquiry::where('id', $inquiry->id)->update([
                'status' => $request->input('status'),
                'staff_id' => $staff_id,
            ]);
        }
        
        return redirect()->action('InquiryController@show', ['id' => $inquiry->id]);
    }

    public function reply(ReplyMailText $request, Inquiry $inquiry)
    {
        // validation後のRequestデータ呼び出し
        $request = $request->validated()['inquiries'];

        // Requestデータにより、連絡を送信
        Mail::to($inquiry->email)->send(new Reply($request, $inquiry));

        // DB保存用データ作成
        $request = [
            'content'       => $request['reply'],
            'inquiry_id'    => $inquiry->id,
            'staff_id'      => Auth::user()->id,
        ];
        
        // DBへの保存処理
        $answer = \App\Answer::create($request);

        // コントローラへのリダイレクト
        return redirect()->action('InquiryController@show', ['id' => $inquiry->id]);
    }

    public function comment(CommentContent $request, Inquiry $inquiry)
    {
        // validation後のRequestデータ呼び出し
        $request = $request->validated()['inquiries'];

        // DB保存用データ作成
        $request = [
            'content'       => $request['comment'],
            'inquiry_id'    => $inquiry->id,
            'staff_id'      => Auth::user()->id,
        ];
        
        // DBへの保存処理
        $answer = \App\Comment::create($request);

        // コントローラへのリダイレクト
        return redirect()->action('InquiryController@show', ['id' => $inquiry->id]);
    }
}
