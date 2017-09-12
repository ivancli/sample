<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 12/09/2017
 * Time: 3:55 PM
 */

namespace App\Contracts\Models;


use App\Models\User;

interface UserContract
{
    /**
     * Get all Users
     * @return mixed
     */
    public function all();

    /**
     * Get User By User ID
     * @param $user_id
     * @param bool $fail
     * @return User
     */
    public function get($user_id, $fail = true);

    /**
     * Get User By Email Address
     * @param $email
     * @return mixed
     */
    public function getByEmail($email);

    /**
     * Create new User
     * @param array $data
     * @return \App\Models\User
     */
    public function store(array $data);

    /**
     * Update existing User
     * @param User $user
     * @param array $data
     * @return \App\Models\User
     */
    public function update(User $user, array $data);

    /**
     * Delete existing User
     * @param User $user
     * @return bool
     */
    public function destroy(User $user);
}