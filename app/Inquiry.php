<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /**
     * この問い合わせを所有するStaffを取得
     */
    public function staff()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * ユーザーに関連する返答を取得
     */
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }

    # viewの条件分岐を追加
    public function status()
    {
        switch($this->status)
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
}
