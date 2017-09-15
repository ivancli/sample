<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 13/09/2017
 * Time: 2:51 PM
 */

namespace App\Repositories\SprookiConnectors;


use App\Contracts\Repositories\UserContract;
use App\Services\Auth\AuthDataProviderTrait;
use Illuminate\Encryption\Encrypter;
use Ixudra\Curl\Facades\Curl;

class UserRepository extends UserContract
{
    use AuthDataProviderTrait;

    public static $createUserParams = [
        'useremail', 'password', 'accounttype', 'givenname', 'familyname', 'dob', 'gender', 'phoneno', 'preferences', 'token', 'latitude', 'longitude', 'createsession'
    ];

    public static $signInUserParams = [
        'useremail', 'password', 'accounttype'
    ];

    public static $fieldMatching = [
        'email' => 'useremail',
        'given_name' => 'givenname',
        'family_name' => 'familyname',
        'phone_no' => 'phoneno',
    ];

    /**
     * create new user account in sprooki
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data)
    {
        $data = $this->__matchFields($data);
        /*init configuration*/
        $this->config();

        /*set up parameters*/
        $data = array_only($data, self::$createUserParams);
        array_set($data, 'deviceid', array_get($data, 'useremail'));
        array_set($data, 'accounttype', 'EMAIL');

        if (array_has($data, 'password')) {
            $password = array_get($data, 'password');
            /*TODO enable the following line of code before pushing to live*/
//            array_set($data, 'password', aes_128_encrypt($password, $this->getPrivateKey()));
            array_set($data, 'password', "ZeMo4kY4gfOb2V+8S3bBkPtBAImxtLR6KvE6yOBN\/K0=");
        }

        $this->params('CreateUser', $data);

        $result = $this->call();

        $userData = $result->data;
        $user = $this->getUser($userData);

        return $user;
    }

    /**
     * login user account in sprooki
     * @param array $credentials
     * @return mixed
     */
    public function signIn(array $credentials)
    {
        $credentials = $this->__matchFields($credentials);
        /*init configuration*/
        $this->config();
        $credentials = array_only($credentials, self::$signInUserParams);

        array_set($credentials, 'deviceid', array_get($credentials, 'useremail'));
        array_set($credentials, 'accounttype', 'EMAIL');

        if (array_has($credentials, 'password')) {
            $password = array_get($credentials, 'password');
            /*TODO enable the following line of code before pushing to live*/
//            array_set($data, 'password', aes_128_encrypt($password, $this->getPrivateKey()));
            array_set($credentials, 'password', "ZeMo4kY4gfOb2V+8S3bBkPtBAImxtLR6KvE6yOBN\/K0=");
        }
        /*set up parameters*/
        $data = $credentials;
        $this->params('SignIn', $data);

        $result = $this->call();

        $userData = $result->data;
        if (isset($result->sessid)) {
            $userData->sessid = $result->sessid;
        }
        $user = $this->getUser($userData);
        return $user;
    }

    /**
     * destroy session in sprooki
     * @return mixed
     */
    public function signOut()
    {
        if (!is_null(auth()->user()) && !is_null(auth()->user()->sessid)) {
            $sessid = auth()->user()->sessid;
            $params = [
                'deviceid' => auth()->user()->email,
                'sessid' => $sessid
            ];
            $this->config();
            $this->params('SignOut', $params);
            $result = $this->call();
        }
        return true;
    }

    /**
     * send reset password email
     * @param array $data
     * @return mixed
     */
    public function forgotPassword(array $data)
    {
        $params = [
            'useremail' => array_get($data, 'email'),
            'deviceid' => array_get($data, 'email'),
            'accounttype' => 'EMAIL',
        ];
        $this->config();
        $params = array_merge($params, $data);
        $this->params('ForgotPassword', $params);
        $result = $this->call();
        return $result->data;
    }

    /**
     * update password
     * @param array $data
     * @return mixed
     */
    public function resetPassword(array $data)
    {
        $params = [
            'deviceid' => array_get($data, 'email'),
            'accounttype' => 'EMAIL',
        ];
        $this->config();
        $params = array_merge($params, $data);

//        array_set($params, 'password', aes_128_encrypt(array_get($params, 'password'), $this->getPrivateKey()));
        array_set($params, 'password', "ZeMo4kY4gfOb2V+8S3bBkPtBAImxtLR6KvE6yOBN\/K0=");

        $this->params('ResetPassword', $params);
        $result = $this->call();
        return true;
    }

    private function __matchFields($data)
    {
        foreach (self::$fieldMatching as $originalField => $newField) {
            if (array_has($data, $originalField)) {
                array_set($data, $newField, array_get($data, $originalField));
                array_forget($data, $originalField);
            }
        }
        return $data;
    }

    /**
     * load user details
     * @param array $data
     * @return mixed
     */
    public function getUserDetails(array $data = [])
    {
        $this->config();

        $data = $this->__prepUserInfo($data);
        $this->params('GetUserDetails', $data);

        $result = $this->call();

        $user = $this->getUser($result->data);
        return $user;
    }

    /**
     * update user details
     * @param array $data
     * @return mixed
     */
    public function updateUserDetails(array $data = [])
    {
        $data = $this->__matchFields($data);
        $params = [
            'useremail' => array_get($data, 'email'),
            'deviceid' => !is_null(auth()->user()) ? auth()->user()->email : array_get($data, 'email'),
            'accounttype' => 'EMAIL',
        ];
        $this->config();
        $params = array_merge($params, $data);
        $this->params('UpdateUserDetails', $params);
        $result = $this->call();

        $user = $this->getUser($result->data);

        return $user;
    }

    private function __prepUserInfo(array $data)
    {
        $user = null;
        if (!is_null(auth()->user())) {
            $user = auth()->user();
        }

        array_set($data, 'deviceid', !is_null($user) ? $user->email : array_get($data, 'useremail'));
        array_set($data, 'accounttype', 'EMAIL');
        return $data;
    }
}