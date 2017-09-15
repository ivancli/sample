<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CampaignContract;
use App\Contracts\Repositories\CouponContract;
use App\Services\SprookiConnectors\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $request;

    protected $couponService;

    public function __construct(Request $request, CouponService $couponService)
    {
        $this->request = $request;

        $this->couponService = $couponService;
    }

    public function index()
    {
        $coupons = $this->couponService->fetch();

        return view('coupons.index')->with(compact(['coupons']));
    }

    public function show($coupon_id)
    {
        $coupon = $this->couponService->get($coupon_id);

        return view('coupons.details')->with(compact(['coupon']));
    }

    public function redeem($coupon_id)
    {
        $coupon = $this->couponService->get($coupon_id);
        if (is_null($coupon)) {
            abort(404, "Coupon Not Found");
        }
        return view('coupons.redeem')->with(compact(['coupon']));
    }

    /**
     * action redeem post route
     */
    public function store($coupon_id)
    {
        $couponid = $coupon_id;
        $this->request->merge(compact(['couponid']));

        $this->couponService->redeem($this->request->all());
//        $this->couponService->create($this->request->all());

        $message = "You have successfully redeemed this coupon.";
        return redirect()->back()->with(message_bag($message));
    }
}
