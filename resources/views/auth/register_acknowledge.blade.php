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
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 text-center small">
            <p>Thanks for registering for the Belrose Super Centre rewards program!</p>
            <p>You can always return to this site to upload more receipts or check your receipt balance using the email
                address and password you provided earlier.</p>
            <p>If you would like to upload another receipt, please use the menu at the top right</p>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12 text-center">
            <a href="{{route('receipts.create')}}" class="btn btn-success btn-block text-uppercase">Upload Receipt</a>
        </div>
    </div>

    <br>


    <div class="row">
        <div class="col-xs-12 text-center">
            <a
                    href="{{route('auth.logout')}}"
                    class="btn btn-default btn-block text-uppercase"
            >Logout</a>
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

