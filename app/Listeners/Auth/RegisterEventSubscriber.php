<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 4:20 PM
 */

namespace App\Listeners\Auth;


use App\Contracts\Models\UserContract;
use Illuminate\Auth\Events\Registered;

class RegisterEventSubscriber
{
    protected $userRepo;

    public function __construct(UserContract $userContract)
    {
        $this->userRepo = $userContract;
    }

    public function onRegistered($event)
    {
        $user = $event->user;

        session()->put('sprooki_sessid', $user->sessid);
        session()->put('sprooki_deviceid', $user->email);
        session()->put('sprooki_devicetype', 'WEB');
    }

    public function subscribe($events)
    {
        $events->listen(Registered::class, 'App\Listeners\Auth\RegisterEventSubscriber@onRegistered');
    }
}