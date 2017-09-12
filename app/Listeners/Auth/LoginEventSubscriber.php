<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 4:36 PM
 */

namespace App\Listeners\Auth;


use App\Contracts\Models\UserContract;

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
        if (isset($user->email) && !is_null($user->email)) {
            $existingUser = $this->userRepo->getByEmail($user->email);
            $keys = $user->getFillable();
            $userData = array_only($user->toArray(), $keys);
            if (!is_null($existingUser)) {
                $user = $this->userRepo->update($existingUser, $userData);
            }
        }
    }


    public function subscribe($events)
    {
        $events->listen(\App\Events\Sprooki\Authenticated::class, 'App\Listeners\Auth\LoginEventSubscriber@onLogin');
    }
}