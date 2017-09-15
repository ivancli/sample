<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 9:47 AM
 */

namespace App\Repositories\SprookiConnectors;


use App\Contracts\Repositories\CouponContract;

class CouponRepository extends CouponContract
{
    /**
     * load a list of coupons
     * @param array $data
     * @return mixed
     */
    public function getCoupons(array $data = [])
    {
        /*init configuration*/
        $this->config();

        $data = $this->__prepUserInfo($data);
        array_set($data, 'lastSyncTime', array_get($data, 'coupon_last_sync', null));

        /*set up parameters*/
        $this->params('GetCoupons', $data);

        $result = $this->call();

        return $result->data;
    }

    /**
     * create new coupon in Sprooki
     * @param array $data
     * @return mixed
     * @internal param array $credentials
     */
    public function createCoupon(array $data = [])
    {
        $campaignId = array_get($data, 'campaignId', config('aventus.campaign_id'));
        $this->config();

        $data = $this->__prepUserInfo($data);
        array_set($data, 'campaignid', $campaignId);
        $this->params('CreateCoupon', $data);

        $result = $this->call();

        return $result->data;
    }

    /**
     * destroy session in sprooki
     * @param array $data
     * @return mixed
     */
    public function redeemCoupon(array $data = [])
    {
        $this->config();

        $data = $this->__prepUserInfo($data);
        $this->params('RedeemCoupon', $data);

        $result = $this->call();

        return $result->data;
    }

    /**
     * send reset password email
     * @param array $data
     * @return mixed
     */
    public function revokeCouponPurchase(array $data)
    {
        // TODO: Implement revokeCouponPurchase() method.
    }

    /**
     * TODO doesn't seem to be necessary in Aventus Microsite
     * @param array $data
     * @return mixed
     */
    public function makePaypalPayment(array $data)
    {
        // TODO: Implement makePaypalPayment() method.
    }

    /**
     * TODO doesn't seem to be necessary in Aventus Microsite
     * @param array $data
     * @return mixed
     */
    public function confirmPaypalPayment(array $data)
    {
        // TODO: Implement confirmPaypalPayment() method.
    }

    /**
     * Load coupon by coupon id
     * @param $coupon_id
     * @return mixed
     */
    public function getById($coupon_id)
    {
        $couponResult = $this->getCoupons();
        $coupons = collect($couponResult->list);

        $coupon = $coupons->filter(function ($coupon, $key) use ($coupon_id) {
            return $coupon->id == $coupon_id;
        })->first();

        return $coupon;
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