@extends('layouts.master')

@section('title')
    Coupon details
@endsection

@section('sub-header')
    <br>

    <div class="">
        <div class="text-center">
            <img src="{{asset('/images/belrose/logo.png')}}" alt="Belrose SuperCentre">
        </div>
    </div>

    <br>
@endsection

@section('content')
    <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="heading u__heading text-left">
                <button
                        type="button"
                        role="button"
                        class="btn-link btn-back">
                    <i class="fa fa-chevron-circle-left color-primary" aria-hidden="true"></i>
                </button>
                <span>Coupon Details</span>
            </div>
        </div>
    </div>


    {{ dump($coupon) }}
    <div class="row">
        <div class="col-xs-12">
            <div class="list-group-item Offer">
                <div class="item media-item sm-media-item">
                    <div class="media fx fx-cc-items">
                        <img
                                class="img-cover img-tl"
                                src="{{ array_first($coupon->campaign->images, null, '#') }}"
                                alt="{{ $coupon->campaign->name }}"
                        >
                    </div>
                    <div class="details pad-sm fx">
                        <div class="title">
                            {{ $coupon->campaign->name }}
                        </div>
                        <div class="description more">
                            {{ $coupon->campaign->description }}
                            <div class="terms">
                                <div class="heading h5">Terms and Conditions:</div>
                                <div>
                                    This card cannot be used in conjunction with or to discount any other offer.
                                    Additional chargesmay apply for soy, extra shot and flavours.
                                    Offer not redeemable via McDelivery®, mobile ordering,self-ordering kiosks.
                                    Valid until 31/12/17 at McCafé® at McDonald’s®
                                </div>
                            </div>
                        </div>

                        <div class="description less">
                            {{ $coupon->campaign->description }}
                        </div>

                        <a href="#" class="more-less-link color-primary">Show more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row action-button-holder">
        <div class="col-xs-12">
            @if($coupon->status == 'NEW')
                <a
                        id="coupon-redeem"
                        href="{{route('coupons.redeem', ['coupon_id' => $coupon->id])}}"
                        class="btn btn-block btn-primary btn-flat text-uppercase"
                >Redeem</a>
            @elseif(($coupon->status == 'EXPIRED') || ($coupon->status == 'DELETED'))
                <a
                        href="#"
                        disabled="disabled"
                        class="btn btn-block btn-primary btn-flat text-uppercase"
                >Expired</a>
            @elseif($coupon->status == 'REDEEMED')
                <a
                        href="#"
                        disabled="disabled"
                        class="btn btn-block btn-primary btn-flat text-uppercase"
                >Redeemed</a>
            @endif
        </div>
        <div class="col-xs-12">
            <p class="text-center text-muted text-smaller">
                Ends 31 August 2017. Get coupon now & pay in store.
            </p>
        </div>
    </div>
@endsection

@section('scripts')

@stop

