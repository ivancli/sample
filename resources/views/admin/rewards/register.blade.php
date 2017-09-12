@extends('layouts.master')

@section('styles')
    <link href="{{asset('/css/concierge.css')}}" rel="stylesheet">
@stop

@section('title')
    Concierge Rewards
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
                <span>Concierge Rewards</span>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12">
            <div class="card wizard-card" data-color="orange" id="wizardProfile">


                    <div class="wizard-header">
                        <h3>
                            <strong>CONCIERGE REWARD</strong>
                            <br>
                            <small>This information will let us know more about you.</small>
                        </h3>
                    </div>

                    <div class="wizard-navigation">
                        <ul class="nav nav-pills fx fx-sb-items">
                            <li
                                    class="wizard-step active"
                            >
                                <a href="#profile" data-toggle="tab" aria-expanded="true">Account details</a>
                            </li>
                            <li
                                    class="wizard-step"
                            >
                                <a href="#receipt" data-toggle="tab">Receipt Upload</a>
                            </li>
                            <li
                                    class="wizard-step"
                            >
                                <a href="#coupon" data-toggle="tab">Redeem Coupon</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div
                                class="tab-pane active"
                                id="profile"
                                data-tab="profile"
                        >
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <form
                                            class="form-horizontal"
                                            action=""
                                            method=""
                                            novalidate="novalidate"
                                    >
                                        {{ csrf_field() }}
                                        <h4 class="info-text"> Let's start with the basic information </h4>
                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-user color-primary" aria-hidden="true"></i>
                                                </span>
                                                <input
                                                        id="givenname"
                                                        class="form-control input-xs"
                                                        name="givenname"
                                                        type="text"
                                                        value=""
                                                        placeholder="Enter your first name"
                                                >
                                                <label for="givenname">Enter your first name <small>(required)</small></label>
                                                @if ($errors->has('givenname'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('givenname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-user color-primary" aria-hidden="true"></i>
                                                </span>
                                                <input
                                                        id="familyname"
                                                        class="form-control input-xs"
                                                        name="familyname"
                                                        type="text"
                                                        value=""
                                                        placeholder="Your last name"
                                                >
                                                <label for="familyname">Last Name <small>(required)</small></label>
                                                @if ($errors->has('familyname'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('familyname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fw fa-envelope color-primary" aria-hidden="true"></i>
                                            </span>
                                            <input
                                                    class="form-control input-xs"
                                                    id="email"
                                                    type="email"
                                                    name="email"
                                                    value=""
                                                    placeholder="Your email address"
                                            >
                                            <label for="email">Email address <small>(required)</small></label>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-venus-mars color-primary" aria-hidden="true"></i>
                                                </span>
                                                <select
                                                    class="input-group selectpicker show-tick show-menu-arrow form-control"
                                                    data-size="5"
                                                    title="Choose gender"
                                                    id="gender"
                                                    name="gender"
                                                >
                                                    <option
                                                        value="MALE"
                                                    >Male</option>
                                                    <option
                                                        value="FEMALE"
                                                    >Female</option>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-calendar color-primary" aria-hidden="true"></i>
                                                </span>
                                                <input
                                                        class="form-control input-xs"
                                                        id="dob"
                                                        type="tel"
                                                        name="dob"
                                                        value=""
                                                        placeholder="DD-MM-YYYY"
                                                        maxlength="10"
                                                        pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}"
                                                        data-numeric-input
                                                >
                                                <label for="dob">Your date of birth</label>
                                                @if ($errors->has('dob'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('dob') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-phone-square color-primary" aria-hidden="true"></i>
                                                </span>
                                                <input
                                                        class="form-control input-xs"
                                                        id="mobile"
                                                        type="text"
                                                        name="mobile"
                                                        value=""
                                                        placeholder="Your mobile phone number"
                                                >
                                                <label for="mobile">Mobile phone number</label>
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-envelope color-primary" aria-hidden="true"></i>
                                                </span>
                                                <input
                                                        class="form-control input-xs"
                                                        id="postcode"
                                                        type="text"
                                                        name="postcode"
                                                        value=""
                                                        placeholder="Your postcode"
                                                >
                                                <label for="mobile">Your postcode</label>
                                                @if ($errors->has('postcode'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('postcode') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-lock color-primary" aria-hidden="true"><span class="mandatory-astrix"></span></i>
                                                </span>
                                                <input
                                                        class="form-control input-xs"
                                                        id="password"
                                                        type="password"
                                                        name="password"
                                                        value="{{ old('password') }}"
                                                        placeholder="Your password"
                                                >
                                                <label for="password">Your password</label>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="input-group-item">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-fw fa-lock color-primary" aria-hidden="true"><span class="mandatory-astrix"></span></i>
                                                </span>
                                                <input
                                                        class="form-control input-xs"
                                                        id="password_confirmation"
                                                        type="password"
                                                        name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}"
                                                        placeholder="Confirm your password"
                                                >
                                                <label for="password_confirmation">Confirm your password</label>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group-item bb-none">
                                        <div class="input-group">
                                            <label class="checkbox">
                                                <input
                                                        name="tnc"
                                                        class="form-control input-xs"
                                                        type="checkbox"
                                                        checked="checked"
                                                ><span>Agree with the terms and conditions?</span>
                                            </label>
                                        </div>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div
                                class="tab-pane"
                                id="receipt"
                                data-tab="receipt"
                        >
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <h4 class="info-text"> Upload the receipt </h4>
                                    <form
                                            action="{{route('receipts.store')}}"
                                            method="post"
                                            enctype="multipart/form-data"
                                    >
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-xs-12 text-center">
                                                    <div class="box box-default">
                                                        <ul class="list-unstyled">
                                                            <li class="input-group-item">
                                                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa fa-file-image-o color-primary pad-right-special" aria-hidden="true"></i>
                                    </span>
                                                                    <input
                                                                            type="file"
                                                                            class="form-control input-bald input-short"
                                                                            name="receipt"
                                                                            accept="image/*"
                                                                    >
                                                                    <span class="input-group-addon">
                                        <i
                                                class="fa fa fa fa-question-circle color-primary pad-right-special"
                                                aria-hidden="true"
                                                data-toggle="modal"
                                                data-target="#receipt-upload-modal"
                                        ></i>
                                    </span>
                                                                </div>
                                                            </li>
                                                            <li class="input-group-item">
                                                                <div class="input-group" style="width: 100%;">
                                    <textarea
                                            id="notes"
                                            class="form-control input-xs"
                                            type="text"
                                            name="notes"
                                            placeholder="Notes"
                                            rows="2"
                                            cols="10"
                                    ></textarea>
                                                                    <label for="notes">Your optional notes</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 text-center">
                                                <button
                                                        type="submit"
                                                        class="btn btn-block text-uppercase btn-primary"
                                                >
                                                    Confirm Upload
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div
                                class="tab-pane"
                                id="coupon"
                                data-tab="coupon"
                        >
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <h4 class="info-text"> Redeem the coupon </h4>
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

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-footer height-wizard">
                        <div class="pull-right">
                            <input type="button" class="btn btn-next btn-fill btn-warning btn-wd btn-sm" name="next" value="Next">
                            <input type="button" class="btn btn-finish btn-fill btn-warning btn-wd btn-sm" name="finish" value="Finish" style="display: none;">

                        </div>

                        <div class="pull-left">
                            <input type="button" class="btn btn-previous btn-fill btn-default btn-wd btn-sm disabled" name="previous" value="Previous">
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('/js/concierge.js')}}"></script>
    <script>
        $(function() {
            MS.ConciergeWizard.init({
//                validatorOptions: {
//                    rules: {
//                        givenname: {
//                            required: true,
//                            minlength: 3
//                        },
//                        familyname: {
//                            required: true,
//                            minlength: 3
//                        },
//                        email: {
//                            required: true,
//                            minlength: 3,
//                        }
//                    }
//                }
            });
        });
    </script>
@stop

