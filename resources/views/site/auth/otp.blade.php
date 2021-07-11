@extends('site.layouts.app')

@section('title', 'Please Enter Your OTP')

@section('mystyle')

@endsection

@section('page-hero')
@endsection

@section('content')
<section class="banner-area login-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 px-0">
                <div class="banner-bg"></div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="banner-text">
                    <h1>OTP</h1>
                    <form action="{{ route('verifylogin') }}" method="post"  name="validateLogin" id="validateLogin">
                        @csrf
                        <input type="hidden" name="contact_number" value="{{ $otp->contact_number }}">
                        <p>
                            Use this code for login: {{ $otp->code }}
                        </p>
                        <p>
                            <input type="text" placeholder="OTP" name="code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'OTP'" class="single-input" required>
                            <small class="d-block text-right w-100">
                                <a id="resendOtp">Resend OTP</a>
                            </small>
                            <div id="errorBox"></div>
                        </p>
                        <button type="submit" class="genric-btn primary radius text-uppercase font-weight-bold">Validate & login<span class="flaticon-login text-white"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('myscript')
@include('site.scripts.auth')
@endsection
