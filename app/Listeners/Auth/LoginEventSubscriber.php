<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 4:36 PM
 */

namespace App\Listeners\Auth;


use App\Contracts\Models\UserContract;
use Illuminate\Auth\Events\Authenticated;

class LoginEventSubscriber
{
    protected $userRepo;

    public function __construct(UserContract $userContract)
    {
        $this->userRepo = $userContract;
    }

    public function onLogin($event)
    {
        $user = $event->user;

        session()->put('sprooki_sessid', $user->sessid);
        session()->put('sprooki_deviceid', $user->email);
        session()->put('sprooki_devicetype', 'WEB');
    }


    public function subscribe($events)
    {
        $events->listen(Authenticated::class, 'App\Listeners\Auth\LoginEventSubscriber@onLogin');
    }
}