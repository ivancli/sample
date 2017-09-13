<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthDataProviderTrait
{
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'email';
    }

    /**
     * Get the generic user.
     *
     * @param  mixed $user
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function getUser($user)
    {
        $saveData = [];
        foreach ((array)$user as $attribute => $value) {
            $saveData = array_set($saveData, snake_case($attribute), $value);
        }

        array_set($saveData, 'enduserid', $user->id);

        if ($user !== null) {
            return new User($saveData);
        }
    }
}