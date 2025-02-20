@extends('frontend.layouts.master')
@section('title','OTP Verification')
@section('content')
    <div class="full-row" >
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="woocommerce">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-12 mx-auto">
                                <div class="sign-in-form">
                                    <h3>@lang('website.OTP Verification')</h3>
                                    <form action="{{route('otp.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="phone" value="{{$verCode->phone}}">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">@lang('website.Enter your code')</label>
                                            <input type="number" class="form-control" name="code" id="code" aria-describedby="emailHelp">
                                        </div>
                                        <button type="submit" class="btn btn-primary">@lang('website.Send')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
