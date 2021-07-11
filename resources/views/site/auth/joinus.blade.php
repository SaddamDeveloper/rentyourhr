@extends('site.layouts.app')

@section('title', 'Join Us')

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
                    <h1>Login</h1>
                    <form action="{{ route('otp') }}" method="post">
                        @csrf
                        <p>
                            <input type="text" name="contact_number" placeholder="Mobile" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile'" class="single-input" required value="{{ old('contact_number') }}">
                        </p>
                        @if ($errors->has('contact_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_number') }}</strong>
                            </span>
                        @endif
                        <button type="submit" class="genric-btn primary radius text-uppercase font-weight-bold">Send OTP<span class="flaticon-login text-white"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('myscript')
@endsection
