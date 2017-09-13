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

    @foreach($campaigns as $campaign)
        <div class="row">
            <div class="col-xs-12">
                <div class="item media-item sm-media-item">
                    <div class="media fx fx-cc-items">
                        @if(!is_null(array_first($campaign->images)))
                            <img class="img-cover img-tl" src="{!! array_first($campaign->images) !!}" alt="{{$campaign->description}}">
                        @else
                        @endif
                    </div>
                    <div class="details pad-sm fx">
                        <div class="title">
                            {{ $campaign->name }}
                        </div>
                        <div class="description">
                            {{ $campaign->description }}
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
    @endforeach
@endsection

@section('scripts')

@stop

