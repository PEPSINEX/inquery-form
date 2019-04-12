<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\StaffRegisterd;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inquiries()
    {
        return $this->hasMany('App\Inquiry');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    # スタッフ新規登録後、通知メールを送信
    public static function boot()
    {
        parent::boot();

        self::created(function($staff){
            $staff->notify(new StaffRegisterd($staff));
        });
    }

    # 非管理者のスタッフを取得
    public static function getStaff(){
        $not_admin_staffs = self::where('is_admin', false)->get();
        return $not_admin_staffs;
    }
}
