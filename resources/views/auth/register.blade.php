@extends('layouts.master')

@section('title')
    Registration
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
                <span>Registration </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 no-gutter small text-center">
            @include('partials.alerts', [
                'alerts' => $errors,
                'class' => 'fade-alert1'
            ])
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
                        <li class="input-group-item @if ($errors->has('given_name')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-user color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="given_name"
                                        type="text"
                                        name="given_name"
                                        value="{{ old('given_name') }}"
                                        placeholder="Enter your first name"
                                >
                                <label for="given_name">Your first name</label>
                                @if ($errors->has('given_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('given_name') }}</strong>
                                </span>
                                @endif
                                {{--@if ($errors->has('givenname'))--}}
                                {{--<span class="help-block has-error">--}}
                                {{--<span>{{ $errors->first('givenname') }}</span>--}}
                                {{--</span>--}}
                                {{--@endif--}}

                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('family_name')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-user color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="family_name"
                                        type="text"
                                        name="family_name"
                                        value="{{ old('family_name') }}"
                                        placeholder="Your last name"
                                >
                                <label for="family_name">Your last name</label>
                                @if ($errors->has('family_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('family_name') }}</strong>
                                </span>
                                @endif
                                {{--@if ($errors->has('familyname'))--}}
                                {{--<span class="help-block has-error">--}}
                                {{--<span>{{ $errors->first('familyname') }}</span>--}}
                                {{--</span>--}}
                                {{--@endif--}}

                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('email')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-envelope color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-xs"
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Your email address"
                                >
                                <label for="email">Your email address</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                {{--@if ($errors->has('email'))--}}
                                {{--<span class="help-block has-error">--}}
                                {{--<span>{{ $errors->first('email') }}</span>--}}
                                {{--</span>--}}
                                {{--@endif--}}

                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('gender')) has-error @endif">
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
                                    @if(old('gender'))
                                        @if (old('gender') == 'male')
                                            <option value="male" selected>Male</option>
                                        @elseif(old('gender') == 'female')
                                            <option value="female" selected>Female</option>
                                        @endif
                                    @else
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    @endif
                                </select>
                                {{--<label for="gender">Your gender</label>--}}
                                {{--@if ($errors->has('gender'))--}}
                                {{--<span class="help-block has-error">--}}
                                {{--<span>{{ $errors->first('gender') }}</span>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('age_range')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-calendar color-primary" aria-hidden="true"></i>
                                </span>
                                <select
                                        class="input-group selectpicker show-tick show-menu-arrow form-control"
                                        data-size="5"
                                        title="Choose Age Range"
                                        id="age_range"
                                        name="age_range"
                                >
                                    <option value="under_18" {{old('age_range') == 'under_18' ? 'selected' : ''}}>Under 18</option>
                                    <option value="18-24" {{old('age_range') == '18-24' ? 'selected' : ''}}>18-24</option>
                                    <option value="25-34" {{old('age_range') == '25-34' ? 'selected' : ''}}>25-34</option>
                                    <option value="35-44" {{old('age_range') == '35-44' ? 'selected' : ''}}>35-44</option>
                                    <option value="45-54" {{old('age_range') == '45-54' ? 'selected' : ''}}>45-54</option>
                                    <option value="55-64" {{old('age_range') == '55-64' ? 'selected' : ''}}>55-64</option>
                                    <option value="65+" {{old('age_range') == '65+' ? 'selected': '' }}>65+</option>
                                </select>
                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('dob')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-calendar color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="dob"
                                        type="tel"
                                        name="dob"
                                        value="{{ old('dob') }}"
                                        placeholder="DD-MM-YYYY"
                                        maxlength="10"
                                        pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}"
                                        data-numeric-input
                                >
                                <label for="dob">Your date of birth</label>
                                {{--@if ($errors->has('dob'))--}}
                                {{--<span class="help-block has-error">--}}
                                {{--<span>{{ $errors->first('dob') }}</span>--}}
                                {{--</span>--}}
                                {{--@endif--}}

                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('phone_no')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-phone-square color-primary" aria-hidden="true"></i>
                                </span>
                                <input
                                        class="form-control input-x1s"
                                        id="phone_no"
                                        type="text"
                                        name="phone_no"
                                        value="{{ old('phone_no') }}"
                                        placeholder="Your phone_no phone number"
                                >
                                <label for="phone_no">Mobile phone number</label>
                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('password')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-lock color-primary" aria-hidden="true"><span class="mandatory-astrix"></span></i>
                                </span>
                                <input class="form-control input-x1s" id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Your password">
                                <label for="password">Your password</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </li>
                        <li class="input-group-item @if ($errors->has('password_confirmation')) has-error @endif">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-fw fa-lock color-primary" aria-hidden="true"><span class="mandatory-astrix"></span></i>
                                </span>
                                <input class="form-control input-x1s" id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm your password">
                                <label for="password_confirmation">Confirm your password</label>
                            </div>
                        </li>
                        <li class="input-group-item bb-none">
                            <div class="input-group">
                                <label class="checkbox">
                                    <input name="tnc" class="form-control input-x1s" type="checkbox" value="1">
                                    <span>Please keep my update to date with news, information and offers from Belrose Super Centre</span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </fieldset>
                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button id="update-details" type="submit" class="btn btn-block text-uppercase btn-secondary">
                            Register
                        </button>

                        <p class="text-center small text-muted">
                            By submitting your details you agree to the <a href="#">Terms & Conditions</a> of this Aventus Rewards Program and associated <a href="#">Privacy Policy</a>.
                        </p>

                        <a href="{{route('auth.login-form')}}" class="btn btn-link color-muted">
                            Back
                        </a>
                    </div>
                </div>
            </form>

            <br>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var viewDate = '';

//            $( ".datetimepicker" ).datepicker({
//                changeMonth: true,
//                changeYear: true,
//                minDate: '-90Y',
//                maxDate: '+0D',
//                defaultDate: viewDate,
//                yearRange: "-90:+0"
//            });

            // mobile friendly drop-down
            // select for mobile view
            $('.selectpicker').selectpicker({
                mobile: true
            });
        });

        $(document).ready(function () {
            $('#dob').mask('00-00-0000');
        });
    </script>
@stop

