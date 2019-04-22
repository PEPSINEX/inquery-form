<?php

return [

    'models' => [
        'user' => 'スタッフ',
        'inquiry' => '問い合わせ',
        'answer' => '返答',
    ],
    'columns' => [
        'user' => [
            'name' => '名前',
        ],
        'inquiry' => [
            'id' => 'ID',
            'name' => '名前',
            'email' => 'メールアドレス',
            'phone_number' => '電話番号',
            'product_type' => '製品種別',
            'content' => '問い合わせ内容',
            'status' => '対応状況',
            'created_at' => '問い合わせ日時',
            'updated_ad'  => '問い合わせ更新日時'
        ],
    ],
    
];
