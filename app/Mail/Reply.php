<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reply extends Mailable
{
    use Queueable, SerializesModels;

    protected $request; // バリデーション後のフォームリクエスト
    protected $inquiry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $request, $inquiry)
    {
        $this->inquiry = $inquiry;
        $this->text = $request['reply'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->inquiry->staff->email)  // 送信元
            ->subject('お問い合わせありがとうございます')   // 件名
            ->text('emails.reply_plain')   // 平文テキストメール
            ->with(['text' => $this->text]);  // viewに渡す変数
    }
}
