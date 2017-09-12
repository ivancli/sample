@extends('layouts.master')

@section('title')
    Offer download
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
                <span>Offer download</span>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="item media-item sm-media-item">
                <div class="media fx fx-cc-items">
                    <img
                            class="img-cover img-tl"
                            src="http://devinvigor.sprookimanagerx.com/images//invigor/ext-images/Campaign4525_1.png"
                            alt="New FREE Reg. Coffee TODAY with ANY purchase"
                    >
                </div>
                <div class="details pad-sm fx">
                    <div class="title">
                        BUY 5 COFFEES AND GET THE 6TH ONE FREE
                    </div>
                    <div class="description more">
                        Receive a coffee card and have it clipped each time you buy a McCafé® Coffee and your 6th is FREE.
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

    <br>

    <div class="row">
        <div class="col-xs-12 text-center">
            <div class="box box-primary">
                <div class="media-card c-media-card card-horizontal">
                    <div class="media-icon">
                        <i class="fa fa-check text-success fa-lg" aria-hidden="true"></i>
                    </div>

                    <div class="media-content">
                        <div class="text-uppercase">
                            <span class="heading h4">
                                Coupon Downloaded
                            </span> &nbsp;
                        </div>
                        <div class="text-uppercase">
                            <span class="heading h4">
                                Code: 555-444-22
                            </span>
                        </div>
                    </div>
                </div>
            </div>

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

