@extends('layouts.master')

@section('title')
    My Receipts
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
                <span>My Receipts</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 small">
            <p class="padded-1 text-center">
                You currently have $x in approved receipts.
            </p>
            <p class="padded-1 text-center">
                You can view the submitted receipt via the View link below.
            </p>
            <p class="padded-1 text-center">
                Any receipts showing as Unreadable should be rephotographed and submitted via the <a href="{{route('receipts.create')}}">Upload Receipt</a> screen.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Submitted</th>
                    <th>Status</th>
                    <th>Merchant</th>
                    <th>Amount</th>
                    <th>View</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xs-12 text-center">
        <a href="{{route('receipts.create')}}" class="btn btn-success btn-block text-uppercase">Upload Receipt</a>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.carousel').on('slid.bs.carousel', function () {
                const carouselData = $(this).data('bs.carousel');
                const currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
                const total = carouselData.$items.length;
                const text = "Example " + (currentIndex + 1) + " of " + total;
                $('.carousel .item-state').text(text);
            });
        });
    </script>
@stop

