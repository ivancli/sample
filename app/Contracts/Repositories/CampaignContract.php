<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 13/09/2017
 * Time: 2:28 PM
 */

namespace App\Contracts\Repositories;


use App\Contracts\SprookiConnectorContract;
use App\Models\Client;
use Ixudra\Curl\Facades\Curl;

abstract class CampaignContract extends StandardSprookiConnector
{
    const DEVICE_TYPE = 'WEB';
    const REQUEST = 'GetCampaigns';

    public function params($params)
    {
        $time = date('Y-m-d H:i:s');
        $this->headers = [
            'x-sprooki-time: ' . $time,
            'x-sprooki-key: ' . $this->publicKey
        ];

        $auth = md5($this->publicKey . $this->privateKey . json_encode($params, JSON_FORCE_OBJECT) . $time);

        $curlParams = array(
            'auth' => $auth,
            'request' => self::REQUEST,
            'params' => $params,
            'deviceid' => $this->deviceid,
            'devicetype' => self::DEVICE_TYPE,
            'compressed' => false,
            'version' => $this->version,
            'locale' => 'en_AU'
        );

        if ($this->sessid != null) {
            array_set($curlParams, 'sessid', $this->sessid);
        }
        $this->params = $curlParams;

    }

    abstract public function call();
}