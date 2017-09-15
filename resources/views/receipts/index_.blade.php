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
                                            capture="camera"
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
                                            class="form-control input-x1s"
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

    <br>

    <div class="row">
        <div class="col-xs-12">
            <div class="item media-item md-media-item">
                <div class="media fx fx-cc-items">
                    <img
                            class="img-cover img-tl"
                            src="{{asset('/images/belrose/receipt-1.jpg')}}"
                            alt="New FREE Reg. Coffee TODAY with ANY purchase"
                    >
                </div>
                <div class="details pad-sm fx">
                    <div class="title">
                        Berqhotel Grosse Scheidegg
                    </div>
                    <div class="description fx-item-top">
                        NEW FREE REG. COFFEE TODAY WITH ANY PURCHASE
                    </div>
                    <div class="status fx">
                        <div class="labels fx fx-wrap fx-cl-items">
                            <span class="label label-success">Approved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12">
            <div class="item media-item md-media-item">
                <div class="media fx fx-cc-items">
                    <img
                            class="img-cover img-tl"
                            src="{{asset('/images/belrose/receipt-3.jpg')}}"
                            alt="New FREE Reg. Coffee TODAY with ANY purchase"
                    >
                </div>
                <div class="details pad-sm fx">
                    <div class="title">
                        Berqhotel Grosse Scheidegg
                    </div>
                    <div class="description fx-item-top">
                        NEW FREE REG. COFFEE TODAY WITH ANY PURCHASE
                    </div>
                    <div class="status fx">
                        <div class="labels fx fx-wrap fx-cl-items">
                            <span class="label label-default">Approve Pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="receipt-upload-modal" tabindex="-1" role="dialog" aria-labelledby="receipt-upload-modal-label">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title modal-title text-center" id="receipt-upload-modal-label">
                        <span></span>
                        Upload receipts tips
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                                <div id="carousel-generic-container" class="carousel slide" data-ride="carousel" data-interval="false">
                                    <!-- Wrapper for slides -->

                                    <ul class="list-group carousel-inner fx fx-cc-items"  role="listbox">
                                        <li class="list-group-item item active">
                                            <h4 class="list-group-item-heading">Line up edges and capture the whole receipt</h4>
                                            <img
                                                src="{{asset('/images/belrose/receipts-upload-tips-1.jpg')}}"
                                                alt="Line up edges and capture the whole receipt​"
                                            >
                                        </li>
                                        <li class="list-group-item item">
                                            <h4 class="list-group-item-heading">Tap your device’s screen to focus​</h4>
                                            <img
                                                src="{{asset('/images/belrose/receipts-upload-tips-2.jpg')}}"
                                                alt="Tap your device’s screen to focus​"
                                            >
                                        </li>
                                        <li class="list-group-item item">
                                            <h4 class="list-group-item-heading">Take the picture from straight above the receipt rather than at an angle</h4>
                                            <img
                                                src="{{asset('/images/belrose/receipts-upload-tips-3.jpg')}}"
                                                alt="Take the picture from straight above the receipt rather than at an angle"
                                            >
                                        </li>
                                    </ul>
                                    <!-- Controls -->
                                    <div class="carousel-controls fx fx-sb-items">
                                        <div class="item-state">
                                            Example 1 of 3
                                        </div>
                                        <div class="item-controls">
                                            <a class="left carousel-control__" href="#carousel-generic-container" role="button" data-slide="prev">
                                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                            </a>
                                            <a class="right carousel-control__" href="#carousel-generic-container" role="button" data-slide="next">
                                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('.carousel').on('slid.bs.carousel', function () {
                const carouselData = $(this).data('bs.carousel');
                const currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
                const total = carouselData.$items.length;
                const text = "Example "+ (currentIndex + 1) + " of " + total;
                $('.carousel .item-state').text(text);
            });
        });
    </script>
@stop

