@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(!Auth::user()->is_sms_verify)
                        <p class="text-danger">
                            <span class="fa fa-exclamation-triangle"></span>
                            Contact no not Verify 
                            <a href="{{ route('user.contact_form') }}">Click here to verify your Contact No</a>
                        </p>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
