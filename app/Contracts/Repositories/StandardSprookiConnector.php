<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 13/09/2017
 * Time: 2:55 PM
 */

namespace App\Contracts\Repositories;


use App\Contracts\SprookiConnectorContract;
use App\Models\Client;

abstract class StandardSprookiConnector implements SprookiConnectorContract
{
    protected $endpoint = null;
    protected $publicKey = null;
    protected $privateKey = null;
    protected $sessid;
    protected $deviceid;
    const DEVICE_TYPE = 'WEB';
    protected $version;

    protected $headers = [];
    protected $params;

    protected $curl;

    /**
     * set up standard configuration
     */
    public function config()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $this->sessid = $user->sessid;
            $this->deviceid = $user->email;
        }
    }

    /**
     * prepare authentication keys and end point
     * @param Client $client
     */
    public function prepAuth(Client $client)
    {
        $this->publicKey = $client->sprooki_publickey;
        $this->privateKey = $client->sprooki_privatekey;
        $this->endpoint = $client->sprooki_endpoint;
        $this->version = $client->sprooki_api_version;
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }
}