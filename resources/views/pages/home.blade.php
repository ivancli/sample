@extends('layouts.master')

@section('sub-header')
    <br>
    <div class="">
        <div class="text-center">
            <img src="{{asset('/images/belrose/logo.png')}}" alt="Belrose SuperCentre">
        </div>
    </div>

    <div class="">
        <div class="text-center text-uppercase jumbotron-heading">
            <h1>Welcome!</h1>
        </div>
    </div>
@stop

@section('content')

    <br>

    <div class="row">
        <div class="col-xs-12 small">
            <p class="padded-1 text-center">
                Welcome to the Belrose Super Centre rewards program!
            </p>
            <p class="padded-1 text-center">
                Please complete your details below to join the rewards program and accrue the spend in the receipt your
                emailed previously.
            </p>

            <h4 class="text-center">How it works</h4>
            <ul class="list-unstyled" style="padding-right: 10%;padding-left: 10%;">
                <li class="padded-1">
                    - Simply scan or photograph your Belrose Super Centre receipts and email them to
                    rewards@belrosesupercentre.com.au or upload them via this site.
                </li>
                <li class="padded-1">
                    - With each valid receipt we will send you an email confirming the value and updating your total
                    accrued spend.
                </li>
                <li class="padded-1">
                    - After you have accrued $60 or more in receipts you will automatically be sent a link to your
                    reward coupon by email.
                </li>
                <li class="padded-1">
                    - Click the link to display the coupon on your phone and show to the merchants below or at the
                    centre management office to claim your reward!
                    <ul>
                        <li>Harvey Norman</li>
                        <li>Carpet Call</li>
                        <li>JB Hi-Fi</li>
                    </ul>
                </li>
            </ul>
            <p class="padded-1 text-center">Click <a href="#">here</a> for the full terms and conditions for the rewards
                program.</p>
        </div>
    </div>

    <hr class="border-solid-yellow">

    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="padded-1">Not registered yet?</p>
            <a
                    href="{{route('auth.registration-form')}}"
                    class="btn btn-default btn-block text-uppercase"
            > Register </a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="padded-1">Already registered?</p>
            <a
                    href="{{route('auth.login-form')}}"
                    class="btn btn-success btn-block text-uppercase"
            > Log In here</a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-12 text-center">
            <p class="padded-1">
                <a href="{{ route('auth.password.forgot.email') }}">Forgot password</a>
            </p>
        </div>
    </div>


@stop