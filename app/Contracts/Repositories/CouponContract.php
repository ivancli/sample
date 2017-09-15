<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 9:47 AM
 */

namespace App\Contracts\Repositories;

use App\Exceptions\SprookiRequestException as RequestException;
use Ixudra\Curl\Facades\Curl;

abstract class CouponContract extends StandardSprookiConnector
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
     * load a list of coupons
     * @param array $data
     * @return mixed
     */
    abstract public function getCoupons(array $data = []);

    /**
     * create new coupon in Sprooki
     * @param array $data
     * @return mixed
     * @internal param array $credentials
     */
    abstract public function createCoupon(array $data = []);

    /**
     * destroy session in sprooki
     * @param array $data
     * @return mixed
     */
    abstract public function redeemCoupon(array $data = []);

    /**
     * send reset password email
     * @param array $data
     * @return mixed
     */
    abstract public function revokeCouponPurchase(array $data);

    /**
     * TODO doesn't seem to be necessary in Aventus Microsite
     * @param array $data
     * @return mixed
     */
    abstract public function makePaypalPayment(array $data);

    /**
     * TODO doesn't seem to be necessary in Aventus Microsite
     * @param array $data
     * @return mixed
     */
    abstract public function confirmPaypalPayment(array $data);

    /**
     * Load coupon by coupon id
     * @param $coupon_id
     * @return mixed
     */
    abstract public function getById($coupon_id);
}