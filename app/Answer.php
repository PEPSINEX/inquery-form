<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AnswerToInquiry;

class Answer extends Model
{
    use Notifiable;

    // リレーション設定
    public function staff()
    {
        return $this->belongsTo('App\User', 'staff_id');
    }

    public function inquiry()
    {
        return $this->belongsTo('App\Inquiry');
    }

    // 複数代入する属性の制限
    protected $fillable = [
        'content',
        'inquiry_id',
        'staff_id',
    ];

    // 問い合わせ作成日時取得時のフォーマットを定義
    public function getCreatedAtAttribute($value)
    {
        return date('Y年m月d日 H時i分', strtotime($value));
    }

    // /**
    //  * メールチャンネルに対する通知をルートする
    //  *
    //  * @param  \Illuminate\Notifications\Notification  $notification
    //  * @return string
    //  */
    // public function routeNotificationForMail($notification)
    // {
    //     return $this->inquiry->email;
    // }

    // // お問い合わせ返信メールを送信
    // public static function boot()
    // {
    //     parent::boot();

    //     self::created(function($answer){
    //         $answer->notify(new AnswerToInquiry($answer));
    //     });
    // }
}
