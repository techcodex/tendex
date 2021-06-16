@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $page_heading }}</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('user.sendVerficationSms') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="contact_no" class="col-md-2 col-form-label text-md-right">{{ __('en.Contact No') }} :</label>
                            <div class="col-md-3">
                                <select class="form-control @error('country_code') is-invalid @enderror" name="country_code">
                                    <option value="">+00</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->phone_code }}"> {{ $country->iso }} +{{ $country->phone_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" placeholder="15730000000" name="contact_no" value="{{ old('contact_no') }}">

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="submit" value="Verify" class="btn btn-primary offset-md-5">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
