<?php

namespace App\Adapters;

use App\Exceptions\SprookiRequestException as RequestException;

class Sprooki implements RequestAdapterInterface
{
    protected static $properties = [
        'endpoint',
        'publicKey',
        'privateKey',
        'version'
    ];

    protected static $userProperties = [
        'sessid',
        'deviceid',
        'devicetype',
    ];

    protected $endpoint = null;
    protected $publicKey = null;
    protected $privateKey = null;
    protected $deviceid = null;
    protected $devicetype = null;
    protected $sessid = null;
    protected $version = null;

    public function call($request, $params)
    {
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
            'deviceid' => $this->deviceid,
            'devicetype' => $this->devicetype,
            'compressed' => false,
            'version' => $this->version,
            'locale' => 'en_AU'
        );

        // Define sessid if exists
        if ($this->sessid != null) {
            $curlParams['sessid'] = $this->sessid;
        }

        // Open connection
        $ch = curl_init();

        // Set the url
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Set the POST data
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlParams, JSON_FORCE_OBJECT));

        // Execute post
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }

    /**
     * @param array $params
     * @param array $configs
     * @return mixed
     * @throws RequestException
     */
    public function signIn(array $params, array $configs)
    {
        $response = $this
            ->initialize($configs)
            ->call('SignIn', $params);

        if(isset($response->result) && $response->result == 'NOK') {
            throw new RequestException($response->error->message, $response->error->code);
        }

        $this->checkValidUserData($response);

        return $this->getUserData($response);
    }

    /**
     * @param array $params
     * @param array $configs
     * @return mixed
     * @throws RequestException
     */
    public function createUser(array $params, array $configs)
    {
        $response = $this
            ->initialize($configs)
            ->call('CreateUser', $params);

        if(isset($response->result) && $response->result == 'NOK') {
            throw new RequestException($response->error->message, $response->error->code);
        }

        if(!isset($response->data)){
            throw new RequestException('Sprooki user data missing', 500);
        }

        return $this->getUserData($response);
    }

    /**
     * @param array $properties
     * @return $this
     * @throws RequestException
     */
    protected function initialize(array $properties)
    {
        foreach (self::$properties as $property) {
            if (!array_key_exists($property, $properties)) {
                throw new RequestException(sprintf('Missing argument [%s] for Sprooki API request.', $property));
            }
            $this->{$property} = $properties[$property];
        }

        // when session id present, set session id
        foreach (self::$userProperties as $property) {
            if(array_key_exists($property, $properties)) {
                $this->{$property} =  $properties[$property];
            }
        }
        return $this;
    }

    /**
     * @param $response
     * @throws RequestException
     */
    protected function checkValidUserData($response)
    {
        if(!isset($response->data)){
            throw new RequestException('Sprooki user data missing', 500);
        }

        if(!isset($response->sessid)){
            throw new RequestException('Sprooki user session id missing', 500);
        }
    }

    /**
     * @param $response
     * @return mixed
     */
    protected function getUserData($response)
    {
        $data = $response->data;
        $data->sessid = isset($response->sessid) ? $response->sessid : '';

        return $data;
    }
}