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
            array_set($data, 'password', "wGlnv9/s/aEFSbNXTIaANA==");
        }

        $this->params('CreateUser', $data);

        $result = $this->call();

        $userData = $result->content->data;
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
            array_set($credentials, 'password', "wGlnv9/s/aEFSbNXTIaANA==");
        }
        /*set up parameters*/
        $data = $credentials;
        $this->params('SignIn', $data);

        $result = $this->call();

        $userData = $result->content->data;
        if (isset($result->content->sessid)) {
            $userData->sessid = $result->content->sessid;
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
        $this->params('ForgotPassword', $params);
        $result = $this->call();
        dd($result);
    }

    /**
     * update password
     * @return mixed
     */
    public function resetPassword()
    {
        // TODO: Implement resetPassword() method.
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
}