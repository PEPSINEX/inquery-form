<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AnswerToInquiry;

class Answer extends Model
{
    use Notifiable;

    /**
     * この問い合わせを所有するStaffを取得
     */
    public function staff()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * この問い合わせを所有するStaffを取得
     */
    public function inquiry()
    {
        return $this->belongsTo('App\Inquiry');
    }

    /**
     * メールチャンネルに対する通知をルートする
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->inquiry->email;
    }

    # お問い合わせ返信メールを送信
    public static function boot()
    {
        parent::boot();

        self::created(function($answer){
            $answer->notify(new AnswerToInquiry($answer));
        });
    }
}
