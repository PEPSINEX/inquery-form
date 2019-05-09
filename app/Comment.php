<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // リレーション設定
    public function staff()
    {
        return $this->belongsTo('App\User', 'staff_id');
    }

    public function inquiry()
    {
        return $this->belongsTo('App\Inquiry', 'inquiry_id');
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
}
