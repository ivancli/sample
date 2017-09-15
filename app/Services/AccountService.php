<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 3:44 PM
 */

namespace App\Services;


use App\Contracts\Repositories\UserContract;

class AccountService
{
    protected $userRepo;

    public function __construct(UserContract $userContract)
    {
        $this->userRepo = $userContract;
    }

    public function get()
    {
        $user = $this->userRepo->getUserDetails();
        return $user;
    }

    public function update(array $data)
    {
        $user = $this->userRepo->updateUserDetails($data);

        return $user;
    }
}