<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Holiday Checking</title>

    <link href="/css/bootstrap.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="/js/jquery.min.js"></script>

</head>
<body>

<div class="container" style="padding-top: 10px;">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-4 col col-sm-8">
            <form id="form" method="POST" class="mb-4"
                  <?php /* action="{{ route('holiday.check') }}" */ ?>
                  data-url="{{ route('holiday.check') }}">
                @csrf
                <div class="form-group">
                    <label for="date" class="mb-0">{{ trans('holiday.Date') }}:</label>
                    <input type="text" id="date" name="date" class="form-control mr-2">
                    <div id="error" class="invalid-feedback" style="padding-bottom: 5px;"
                         data-origin="format: d.m.Y" data-something="{{ trans('holiday.something') }}">
                        format: d.m.Y
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <button type="submit" class="btn btn-primary">{{ trans('holiday.Check') }}</button>
                    <div id="message" class="valid-feedback"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let Holiday = {
        input: '#date',
        form: '#form',
        error: '#error',
        message: '#message',

        init: function() {
            let self = this;
            self.bindEvents();
        },
        bindEvents: function() {
            let self = this;
            $(document)
                .on('submit', self.form, function(e) {
                    e.preventDefault();
                    $(self.input).removeClass('is-invalid');
                    $(self.message).removeClass('d-block');
                    let dateInput = $(self.input).val();
                    $.ajax({
                        url: $(self.form).data('url'),
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'date': dateInput},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data)
                            if (typeof data.error !== 'undefined') {
                                $(self.error).text(data.error);
                                $(self.input).addClass('is-invalid');
                            } else if (typeof data.message !== 'undefined') {
                                $(self.message).text(data.message).addClass('d-block');
                            }
                        },
                        error: function(request) {
                            $(self.error).text($(self.input).data('something'));
                            $(self.input).addClass('is-invalid');
                        }
                    });
                    return false;
                });
        }
    };

    $(document).ready(function(){
        'use strict';
        Holiday.init();
    });
</script>
</body>
</html>
