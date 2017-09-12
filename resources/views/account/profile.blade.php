@extends('layouts.master')

@section('title')
    My Profile
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
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="heading u__heading text-left">
                <button
                        type="button"
                        role="button"
                        class="btn-link btn-back">
                    <i class="fa fa-chevron-circle-left color-primary" aria-hidden="true"></i>
                </button>
                <span>My Profile</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">

            <form
                    class="form-horizontal"
                    role="form"
                    method="POST"
                    action="{{route('auth.post-registration')}}"
            >
                {{ csrf_field() }}
                <fieldset>
                    <ul class="list-unstyled">
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-user color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="givenname"
                                        type="text"
                                        name="givenname"
                                        value=""
                                        placeholder="Enter your first name"
                                >
                                <label for="givenname">Your first name</label>
                                @if ($errors->has('givenname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('givenname') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-user color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="familyname"
                                        type="text"
                                        name="familyname"
                                        value=""
                                        placeholder="Your last name"
                                >
                                <label for="familyname">Your last name</label>
                                @if ($errors->has('familyname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('familyname') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </li>
                        <li class="input-group-item">
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
                                        disabled="disabled"
                                >
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-venus-mars color-primary" aria-hidden="true"></i>
                                </span>
                                <select
                                        class="input-group selectpicker show-tick show-menu-arrow form-control"
                                        data-size="5"
                                        title="Choose Gender"
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
                                <label for="gender">Your gender</label>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-calendar color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
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
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-phone-square color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
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
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-envelope color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
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
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-lock color-primary" aria-hidden="true"><span class="mandatory-astrix"></span></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
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
                        </li>
                        <li class="input-group-item">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-lock color-primary" aria-hidden="true"><span class="mandatory-astrix"></span></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
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
                        </li>
                    </ul>
                </fieldset>
                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button
                                id="update-details"
                                type="submit"
                                class="btn btn-block text-uppercase btn-primary"
                        >
                            Update details
                        </button>
                        <a
                                href="{{route('auth.login-form')}}"
                                class="btn btn-link color-muted"
                        >
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

            <br>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var viewDate = '';

            $( ".datetimepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                minDate: '-90Y',
                maxDate: '+0D',
                defaultDate: viewDate,
                yearRange: "-90:+0"
            });

            // mobile friendly drop-down
            // select for mobile view
            $('.selectpicker').selectpicker({
                mobile: true
            });
        });

        $(document).ready(function(){
            $('#dob').mask('00-00-0000');
        });
    </script>
@stop

