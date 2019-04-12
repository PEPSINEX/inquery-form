<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    // リレーション設定
    public function staff()
    {
        return $this->belongsTo('App\User', 'staff_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // 複数代入する属性
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'product_type',
        'content',
        'status',
        'staff_id',
    ];

    // 問い合わせ作成日時取得時のフォーマットを定義
    public function getCreatedAtAttribute($value)
    {
        return date('Y年m月d日 H時i分', strtotime($value));
    }

    // 問い合わせ更新日時取得時のフォーマットを定義
    public function getUpdatedAtAttribute($value)
    {
        return date('Y年m月d日 H時i分', strtotime($value));
    }

    // 対応状況のフォーマットを定義
    public function getStatusAttribute($value)
    {
        switch($value)
        {
            case '00':
                return '未対応';
                break;
            case '10':
                return '対応中';
                break;
            case '20':
                return '対応済';
                break;
        }
    }

    // 問い合わせ内容の先頭から{$number}文字を取得
    public function mbSubstrContent($number)
    {
        $content = $this->content;
        
        if (mb_strlen($content) > 100) {
            return mb_substr($this->content, 0, $number, 'utf-8').'...';
        }else{
            return $this->content;
        }
    }
}
