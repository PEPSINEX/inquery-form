<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /**
     * 問い合わせインスタンスを所有するStaffを取得
     */
    public function staff()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * 問い合わせインスタンスに関連する返答を取得
     */
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }

    /**
     * 問い合わせ日時取得時のフォーマットを定義
     */
    public function getCreatedAtAttribute($value)
    {
        return date('Y年m月d日 H時i分', strtotime($value));
    }

    /**
     * 対応状況のフォーマットを定義
     */
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

    /**
     * 問い合わせ内容の先頭100文字を取得
     */
    public function mbSubstr($column, $number)
    {
        return mb_substr($this->$column, 0, $number, 'utf-8').'.....';
    }

    /**
     * 問い合わせ日時で並べ替え
     */
    public function scopeSortCreatedAt($query, $asc_or_desc)
    {
        return $query->orderBy('created_at', $asc_or_desc);
    }

    /**
     * 指定したカラムと値でデータを取得
     */
    public function scopeFindByColumnValue($query, $column, $value)
    {
        return $query->where($column, $value);
    }

}
