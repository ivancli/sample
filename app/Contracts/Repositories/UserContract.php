<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 13/09/2017
 * Time: 2:52 PM
 */

namespace App\Contracts\Repositories;


use Ixudra\Curl\Facades\Curl;
use App\Exceptions\SprookiRequestException as RequestException;

abstract class UserContract extends StandardSprookiConnector
{
    const DEVICE_TYPE = 'WEB';

    public function params($request, $params)
    {
        if (array_has($params, 'deviceid')) {
            $this->deviceid = array_get($params, 'deviceid');
            array_forget($params, 'deviceid');
        }


        $time = date('Y-m-d H:i:s');
        $headers = array('x-sprooki-time: ' . $time, 'x-sprooki-key: ' . $this->publicKey);

        $auth = md5($this->publicKey
            . $this->privateKey
            . json_encode($params, JSON_FORCE_OBJECT)
            . $time
        );

        $curlParams = array(
            'auth' => $auth,
            'request' => $request,
            'params' => $params,
            'devicetype' => self::DEVICE_TYPE,
            'compressed' => false,
            'version' => $this->version,
            'locale' => 'en_AU'
        );
        if (!is_null($this->deviceid)) {
            array_set($curlParams, 'deviceid', $this->deviceid);
        }
        if ($this->sessid != null) {
            array_set($curlParams, 'sessid', $this->sessid);
        }

        // Define sessid if exists
        if ($this->sessid != null) {
            $curlParams['sessid'] = $this->sessid;
        }

        $this->params = json_encode($curlParams, JSON_FORCE_OBJECT);
        $this->headers = $headers;
    }

    public function call()
    {
        $response = Curl::to($this->endpoint)
            ->withHeaders($this->headers)
            ->withData($this->params)
            ->returnResponseObject()
            ->asJsonResponse()
            ->post();

        if ($response->status === 200) {
            $content = $response->content;
            if (isset($content->result) && $content->result == 'NOK') {
                throw new RequestException($content->error->message, $content->error->code);
            }
            return $content;
        }

        return $response;
    }

    /**
     * create new user account in sprooki
     * @param array $data
     * @return mixed
     */
    abstract public function createUser(array $data);

    /**
     * login user account in sprooki
     * @param array $credentials
     * @return mixed
     */
    abstract public function signIn(array $credentials);

    /**
     * destroy session in sprooki
     * @return mixed
     */
    abstract public function signOut();

    /**
     * send reset password email
     * @param array $data
     * @return mixed
     */
    abstract public function forgotPassword(array $data);

    /**
     * update password
     * @param array $data
     * @return mixed
     */
    abstract public function resetPassword(array $data);

    /**
     * load user details
     * @param array $data
     * @return mixed
     */
    abstract public function getUserDetails(array $data = []);

    /**
     * update user details
     * @param array $data
     * @return mixed
     */
    abstract public function updateUserDetails(array $data = []);
}