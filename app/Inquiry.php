<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    const PRODUCT_TYPES = [
        // $this->get_product_types(16);
        'A001', 'A002', 'A003', 'A004', 'A005', 'A006', 'A007', 'A008', 'A009', 'A010', 'A011', 'A012', 'A013', 'A014', 'A015', 'A016'
    ];

    // private function get_product_types(Integer $number)
    // {
    //     for ($i = 1; $i <= $number; $i++)
    //     {
    //         $num = sprintf("%02d", $i);
    //         return 'A0'.$num;   
    //     }
    // }

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
}
