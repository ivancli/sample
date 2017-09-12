@extends('layouts.master')

@section('title')
    Reset Password
@stop

@section('sub-header')
    <br>

    <div class="">
        <div class="text-center">
            <img src="{{asset('/images/belrose/logo.png')}}" alt="Belrose SuperCentre">
        </div>
    </div>

    <br>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">

            <div class="row">
                <div class="col-xs-12">
                    <div class="heading u__heading text-left">
                        <a
                                href="{{route('auth.login-form')}}"
                                role="button"
                                class="btn-link btn-back">
                            <i class="fa fa-chevron-circle-left color-primary" aria-hidden="true"></i>
                        </a>
                        <span>Forgot Password</span>
                    </div>
                </div>
            </div>

            <form
                    class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('auth.password.reset.email') }}"
            >
                {{ csrf_field() }}

                <fieldset>
                    <ul class="list-unstyled">
                        <li class="input-group-item">
                            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-envelope color-primary" aria-hidden="true"></i>
                                </span>

                                <div class="col-xs-12 no-left-gutter">
                                    <input
                                            id="email"
                                            type="email"
                                            class="form-control input-xs"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Enter your email address"
                                    >
                                    <label for="email">Your email address</label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </fieldset>


                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button type="submit" id="reset-now" class="btn btn-block text-uppercase btn-secondary">
                            <i class="fa fa-btn fa-envelope"></i> Reset Now
                        </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection