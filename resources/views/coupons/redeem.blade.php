@extends('layouts.master')

@section('title')
    Redeem Coupon
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
                <span>Redeem Coupon</span>
            </div>
        </div>
    </div>
    {{dump($coupon)}}
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
                            Receive a coffee card and have it clipped each time you buy a McCafé® Coffee and your 6th is FREE.
                        </div>

                        <a href="#" class="more-less-link color-primary">Show more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>


    @if($coupon->status == 'NEW')

        <form
                action="{{route('coupons.redemption', ['item' => 1])}}"
                method="post"
        >
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <div class="box box-default">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-group-item">
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock color-secondary pad-right-special" aria-hidden="true"></i>
                                        </span>
                                            <input
                                                    type="text"
                                                    id="redemptioncode"
                                                    class="form-control input-bald"
                                                    name="redemptioncode"
                                                    value=""
                                                    autocapitalize="off"
                                                    placeholder="Enter store redemption code"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <button
                            id="confirm-redemption"
                            type="submit"
                            class="btn btn-block text-uppercase btn-primary"
                    >
                        Confirm Redemption
                    </button>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-xs-12 no-gutter small text-center">
                    @include('partials.alerts', [
                        'alerts' => $errors,
                        'class' => 'fade-alert1'
                    ])
                </div>
            </div>

            <br>

        </form>
    @else
        <div class="row">
            <div class="col-xs-12 text-center lead">
                <p>This Coupon has been redeemed. </p>
            </div>
        </div>
    @endif

@endsection

@section('scripts')

@stop

