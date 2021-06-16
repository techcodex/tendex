<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Verify your Phone No</div>

                        <div class="card-body">
                            Please Enter the Verification Code that we send to {{ Session::get('user')['contact_no'] }}
                            <form action="{{ route('verify_sms') }}" method="post">
                                @csrf
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-5">
                                        <input type="number" class="form-control @error('code') is-invalid @enderror {{ Session::has('error') ? 'is-invalid' : '' }}" name="code" autofocus placeholder="Enter Code">
                                        @error('code')
                                            <span  class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @if(Session::has('error'))
                                            <span  class="text-danger">{{ Session::get('error') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form>
                            <span>Didn't Receive a Code ?</span>
                            <br>
                            <a href="{{ route('resend') }}">Click Here to Request Another One</a>
                            <br>
                            <a href="{{ route('register') }}">Change Phone No ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function(e) {
    toastr.options.closeButton = true;
    toastr.options.closeMethod = 'fadeOut';
    toastr.options.closeDuration = 300;
    toastr.options.closeEasing = 'swing';
    toastr.options.preventDuplicates = true;
    toastr.options.progressBar = true;
    
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
}); 
</script>
