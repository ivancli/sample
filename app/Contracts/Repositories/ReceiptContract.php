<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 1:31 PM
 */

namespace App\Contracts\Repositories;


use Ixudra\Curl\Facades\Curl;

use App\Exceptions\SprookiRequestException as RequestException;

abstract class ReceiptContract extends StandardSprookiConnector
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
            'compressed' => false,
            'version' => "2.4", //fixed version requested by Marc
            'locale' => 'en_AU'
        );
        $device = [
            "type" => self::DEVICE_TYPE,
            "token" => null,
            "model" => null,
            "version" => null,
            "appversion" => null,
        ];

        if (!is_null($this->deviceid)) {
            array_set($device, 'id', $this->deviceid);
        }
        array_set($curlParams, 'device', $device);

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

    abstract public function uploadImage(array $data = []);

    abstract public function getReceipts(array $data = []);
}