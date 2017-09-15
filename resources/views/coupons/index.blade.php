@extends('layouts.master')

@section('title')
    My Coupons
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
                <span>My Coupons</span>
            </div>
        </div>
    </div>


    @if($coupons->count() > 0)

        @foreach($coupons as $coupon)
            {{dump($coupon)}}
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ route('coupons.details', $coupon->id) }}" class="list-group-item Offer">
                        <div class="item media-item sm-media-item">
                            <div class="media fx fx-cc-items">
                                <img class="img-cover img-tl"
                                     src="{{ array_first($coupon->campaign->images, null, '#') }}"
                                     alt="{{ $coupon->campaign->name }}"
                                >
                            </div>
                            <div class="details pad-sm fx">
                                <div class="title">
                                    {{ $coupon->campaign->name }}
                                </div>
                                <div class="description">
                                    {{ $coupon->campaign->description }}
                                </div>
                                <div class="status fx">

                                    <div class="labels fx fx-wrap fx-cl-items">
                                        @if($coupon->status == 'REDEEMED')
                                            <span class="label label-default">Redeemed</span>
                                        @elseif(($coupon->status == 'EXPIRED') || ($coupon->status == 'DELETED'))
                                            <span class="label label-default">Expired</span>
                                        @elseif($coupon->status == 'NEW')
                                            <span class="label label-default">Not Redeemed</span>
                                        @endif

                                    </div>
                                    <div class="types fx fa-lg fx-cc-items">
                                        <i class="fa fa-ticket color-primary fa-sm" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="actions pad-sm fx fx-cr-items">
                                <span class="arrow">
                                    <i class="fa fa-chevron-circle-right color-primary fa-2x" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    @else

        <div class="row">
            <div class="col-xs-12 text-center">
                <p>No coupon available at the moment.</p>
            </div>
        </div>

    @endif
@endsection

@section('scripts')

@stop

