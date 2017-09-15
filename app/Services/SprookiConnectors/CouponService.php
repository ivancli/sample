<?php
/**
 * Created by PhpStorm.
 * User: ivan.li
 * Date: 14/09/2017
 * Time: 10:48 AM
 */

namespace App\Services\SprookiConnectors;


use App\Contracts\Repositories\CampaignContract;
use App\Contracts\Repositories\CouponContract;

class CouponService
{
    protected $couponRepo, $campaignRepo;

    public function __construct(CouponContract $couponContract, CampaignContract $campaignContract)
    {
        $this->campaignRepo = $campaignContract;
        $this->couponRepo = $couponContract;
    }

    /**
     * load a single coupon by id
     * @param $coupon_id
     * @return mixed
     */
    public function get($coupon_id)
    {
        $coupons = $this->fetch();

        $coupon = $coupons->filter(function ($coupon, $key) use ($coupon_id) {
            return $coupon->id == $coupon_id;
        })->first();

        return $coupon;
    }

    /**
     * load all active coupons
     * @param array $data
     * @return $this|\Illuminate\Support\Collection
     */
    public function fetch(array $data = [])
    {
        $campaignResult = $this->campaignRepo->getActiveCampaigns($data);
        $campaigns = collect($campaignResult->list);
        $expiredCampaignIds = $campaignResult->expiredIds;
        $couponResults = $this->couponRepo->getCoupons($data);

        $coupons = collect($couponResults->list);

        $coupons = $coupons->reject(function ($coupon, $key) use ($campaigns, $expiredCampaignIds) {
            return in_array($coupon->campaignId, $expiredCampaignIds);
        })->filter(function ($coupon, $key) use ($campaigns) {
            return in_array($coupon->campaignId, $campaigns->pluck('id')->toArray());
        })->transform(function ($coupon, $key) use ($campaigns) {
            $campaignId = $coupon->campaignId;
            $campaign = $campaigns->filter(function ($campaign) use ($campaignId) {
                return $campaign->id == $campaignId;
            })->first();

            $coupon->campaign = $campaign;
            return $coupon;
        });

        return $coupons;
    }

    /**
     * redeem a single coupon
     * @param array $data
     * @return bool
     */
    public function redeem(array $data)
    {
        $result = $this->couponRepo->redeemCoupon($data);
        return true;
    }

    /**
     * create a new coupon
     * @param array $data
     * @return bool
     */
    public function create(array $data = [])
    {
        $result = $this->couponRepo->createCoupon($data);
        return true;
    }
}