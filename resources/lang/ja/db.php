<?php

return [

    'models' => [
        'user'      => 'スタッフ',
        'inquiry'   => '問い合わせ',
        'answer'    => 'メール',
        'comment'   => 'コメント',
    ],

    'user' => [
        'id'                => 'ID',
        'name'              => '名前',
        'email'             => 'メールアドレス',
        'email_verified_at' => 'メール認証日時',
        'password'          => 'パスワード',
    ],

    'inquiry' => [
        'id'            => 'ID',
        'name'          => '名前',
        'email'         => 'メールアドレス',
        'phone_number'  => '電話番号',
        'product_type'  => '製品種別',
        'content'       => '問い合わせ内容',
        'status'        => '対応状況',
        'created_at'    => '問い合わせ日時',
        'updated_at'    => '対応日時',
        'staff'         => '問い合わせ担当者'
    ],

    'answer' => [
        'id'        => 'ID',
        'content'   => 'メール本文',
        'created_at'    => '作成日時',
        'updated_at'    => '更新日時',
    ],

    'comment' => [
        'id'            => 'ID',
        'content'       => '内容',
        'created_at'    => '作成日時',
        'updated_at'    => '更新日時',
    ],
    
];
