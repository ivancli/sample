@extends('layouts.master')

@section('title')
    Offers
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
                <span>Offers</span>
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
                        7-ELEVEN
                    </div>
                    <div class="description">
                        NEW FREE REG. COFFEE TODAY WITH ANY PURCHASE
                    </div>
                </div>
                <div class="actions pad-sm fx fx-cr-items">
                    <span class="arrow">
                        <i class="fa fa-chevron-circle-right color-primary fa-2x" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@stop

