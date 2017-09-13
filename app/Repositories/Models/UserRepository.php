<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 3:58 PM
 */

namespace App\Repositories\Models;


use App\Contracts\Models\UserContract;
use App\Models\User;

class UserRepository implements UserContract
{
    protected $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    /**
     * Get all Users
     * @return mixed
     */
    public function all()
    {
        $this->userModel->all();
    }

    /**
     * Get User By User ID
     * @param $user_id
     * @param bool $fail
     * @return User
     */
    public function get($user_id, $fail = true)
    {
        if ($fail === true) {
            $user = $this->userModel->findOrFail($user_id);
        } else {
            $user = $this->userModel->find($user_id);
        }
        return $user;
    }

    /**
     * Get User By Email Address
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        $user = $this->userModel->where('email', $email)->first();
        return $user;
    }

    /**
     * Create new User
     * @param array $data
     * @return \App\Models\User
     */
    public function store(array $data)
    {
        $this->userModel->create($data);
    }

    /**
     * Update existing User
     * @param User $user
     * @param array $data
     * @return \App\Models\User
     */
    public function update(User $user, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete existing User
     * @param User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        // TODO: Implement destroy() method.
    }
}