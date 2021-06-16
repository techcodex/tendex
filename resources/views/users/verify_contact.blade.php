@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $page_heading }}</div>
                <div class="card-body">
                    Please Enter the Verification Code that we send to +{{Session::get('user')['country_code'] . Session::get('user')['contact_no'] }}
                    <form action="{{ route('user.verify') }}" method="post">
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
                    <a href="{{ route('user.contact_form') }}">Change Phone No ?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
