<?php

namespace App\Listeners;

use App\Events\StaffRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordToStaff
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StaffRegistered  $event
     * @return void
     */
    public function handle(StaffRegistered $event)
    {
        # 入力された値が正しい場合、登録前にスタッフにメール送信する
        Mail::to($event->staff['email'])->send(new \App\Mail\SendPasswordToStaff($event->staff));
    }
}
