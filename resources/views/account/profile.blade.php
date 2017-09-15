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
        <div class="col-xs-12 no-gutter small text-center">
            @include('partials.alerts', [
                'alerts' => $errors,
                'class' => 'fade-alert1'
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
            <form class="form-horizontal" role="form" method="POST" action="{{route('account.profile.update')}}">
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
                                        id="given_name"
                                        type="text"
                                        name="given_name"
                                        value="{{$user->given_name}}"
                                        placeholder="Enter your first name"
                                >
                                <label for="given_name">Your first name</label>
                                @if ($errors->has('given_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('given_name') }}</strong>
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
                                        id="family_name"
                                        type="text"
                                        name="family_name"
                                        value="{{$user->family_name}}"
                                        placeholder="Your last name"
                                >
                                <label for="family_name">Your last name</label>
                                @if ($errors->has('family_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('family_name') }}</strong>
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
                                        value="{{$user->email}}"
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
                                        name="gender">
                                    <option value="MALE" {{$user->gender == 'MALE' ? 'selected' : ''}}>Male</option>
                                    <option value="FEMALE" {{$user->gender == 'FEMALE' ? 'selected' : ''}}>Female</option>
                                </select>
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
                                <select class="input-group selectpicker show-tick show-menu-arrow form-control"
                                        data-size="5"
                                        title="Choose Age Range"
                                        id="age_range"
                                        name="age_range"
                                >
                                    <option value="under_18" {{$user->age_range == 'under_18' ? 'selected' : ''}}>Under 18</option>
                                    <option value="18-24" {{$user->age_range == '18-24' ? 'selected' : ''}}>18-24</option>
                                    <option value="25-34" {{$user->age_range == '25-34' ? 'selected' : ''}}>25-34</option>
                                    <option value="35-44" {{$user->age_range == '35-44' ? 'selected' : ''}}>35-44</option>
                                    <option value="45-54" {{$user->age_range == '45-54' ? 'selected' : ''}}>45-54</option>
                                    <option value="55-64" {{$user->age_range == '55-64' ? 'selected' : ''}}>55-64</option>
                                    <option value="65+" {{$user->age_range == '65+' ? 'selected': '' }}>65+</option>
                                </select>
                                @if ($errors->has('age_range'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age_range') }}</strong>
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
                                        value="{{ $user->dob }}"
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
                                        name="phone_no"
                                        value="{{ $user->phone_no }}"
                                        placeholder="Your mobile phone number"
                                >
                                <label for="mobile">Mobile phone number</label>
                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </li>
                    </ul>
                </fieldset>
                <div class="form-group">
                    <div class="col-xs-12 text-center">
                        <button id="update-details" type="submit" class="btn btn-block text-uppercase btn-primary">
                            Update details
                        </button>
                        <a href="{{route('auth.login-form')}}" class="btn btn-link color-muted">
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
    <script type="text/javascript" src="{{ asset('/js/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var viewDate = '';

            $(".datetimepicker").datepicker({
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

        $(document).ready(function () {
            $('#dob').mask('00-00-0000');
        });
    </script>
@stop

