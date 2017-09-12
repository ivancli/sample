<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 4:20 PM
 */

namespace App\Listeners\Auth;


use App\Contracts\Models\UserContract;

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

        if (isset($user->email) && !is_null($user->email)) {
            $existingUser = $this->userRepo->getByEmail($user->email);
            if (is_null($user)) {
                $user = $this->userRepo->store((array)$user);
            }
        }
    }

    public function subscribe($events)
    {
        $events->listen(\App\Events\Sprooki\Registered::class, 'App\Listeners\Auth\RegisterEventSubscriber@onRegistered');
    }
}