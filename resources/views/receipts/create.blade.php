@extends('layouts.master')

@section('title')
    Upload Receipt
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
                <a type="button"
                   role="button"
                   class="btn-link btn-back">
                    <i class="fa fa-chevron-circle-left color-primary" aria-hidden="true" href="#"></i>
                </a>
                <span>Upload Receipt</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 small text-center">
            <p>Please click the button below to upload your receipt.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('receipts.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group m-b-20">
                    <div class="col-xs-12">
                        <label for="receipt-image" id="receipt-image-label" class="btn btn-primary btn-block" style="min-height: 35px; right: 0; position: relative;">
                            <span id="receipt-image-text">Select File</span>
                            <input type="file" id="receipt-image" name="receipt" style="position: fixed; top: -1000px; left: -1000px; width: 1px; height: 1px;">
                        </label>
                    </div>
                </div>

                <div class="form-group m-b-20" style="display: none;" id="preview-container">
                    <div class="col-sm-12 text-center">
                        <img src="" alt="" style="max-width: 100%; border: 2px lightgrey dashed;" id="preview-receipt">
                    </div>
                </div>

                <div class="form-group m-b-20" style="display: none;" id="submit-container">
                    <div class="col-sm-12 text-center">
                        <button type="submit" id="btn-upload-receipt" class="btn btn-success btn-block">Upload Receipt</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#receipt-image").on("change", function () {
                var fullPath = $(this).val();
                if (fullPath) {
                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                    var filename = fullPath.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                        $("#receipt-image-text").text(filename);
                        readURL(this);
                    }
                }
            });
        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#receipt-image-label').removeClass("btn-primary").addClass("btn-default");
                    $('#preview-receipt').attr('src', e.target.result);
                    $('#preview-container,#submit-container').fadeIn(function () {
                        $("html, body").animate({scrollTop: $(document).height()}, "slow");
                    });
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@stop

