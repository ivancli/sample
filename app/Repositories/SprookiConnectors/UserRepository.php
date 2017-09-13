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
            array_set($data, 'password', aes_128_encrypt($password, $this->getPrivateKey()));
        }

        $this->params('CreateUser', $data);

        $result = $this->call();

        dd($result);
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

        /*set up parameters*/
        $data = array_only($credentials, self::$signInUserParams);
        array_set($data, 'request', 'SignIn');
        $this->params($data);

        $result = $this->call();
        dd($result);
    }

    /**
     * destroy session in sprooki
     * @return mixed
     */
    public function signOut()
    {
        // TODO: Implement signOut() method.
    }

    /**
     * send reset password email
     * @return mixed
     */
    public function forgotPassword()
    {
        // TODO: Implement forgotPassword() method.
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