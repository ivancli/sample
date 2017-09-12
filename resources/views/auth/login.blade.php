@extends('layouts.master')

@section('title')
    Login
@stop

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
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <br>
                <div class="row header-welcome text-center">
                    <div class="col-xs-12 color-secondary">
                        Welcome to the Belrose Super Centre rewards program!
                    </div>
                    <div class="col-xs-12 color-secondary">
                        Please sign in to upload a new receipt or check your receipt status.
                    </div>
                </div>
            <br>

            @if (session('status'))
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-xs-12">
                    <div class="heading u__heading text-left">Account Login</div>
                </div>
            </div>

            <form
                    class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{ route('auth.post-login') }}"
            >
                {{ csrf_field() }}

                <fieldset>
                    <ul class="list-unstyled">
                        <li class="input-group-item{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-envelope color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Enter your email address"
                                >
                                <label for="email">Your email address</label>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </li>
                        <li class="input-group-item{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-group">

                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-lock color-primary pad-right-special" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-xs1"
                                        id="password"
                                        type="password"
                                        name="password"
                                        placeholder="Enter your password"
                                >
                                <label for="password">Your password</label>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </li>
                    </ul>
                </fieldset>

                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button type="submit" id="log-in" class="btn btn-block text-uppercase btn-primary">
                            <i class="fa fa-fw fa-btn fa-sign-in"></i> Log In
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 text-right small">
                        <a
                                id="forgot-password"
                                class="text-muted"
                                href="{{ route('auth.password.forgot') }}"
                        >Forgot Your Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection