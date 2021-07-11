@extends('site.layouts.app')

@section('title', 'Job Single')

<header class="header-area single-page">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                            <a href="{{ route('welcome') }}"><img src="{{ asset('site/assets/images/logo-light.png') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="main-menu main-menu-light">
                        <ul>
                            <li class="active"><a href="{{ route('welcome') }}">home</a></li>
                            <li><a href="{{ route('about_us') }}">about us</a></li>
                            <li><a href="{{ route('job_category') }}">category</a></li>
                            <li><a href="#">blog</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('blog') }}">Blog Home</a></li>
                                    <li><a href="{{ route('bolg_details') }}">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('contact') }}">contact</a></li>
                            <li><a href="#">pages</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('job_search') }}">Job Search</a></li>
                                    <li><a href="{{ route('single_job') }}">Job Single</a></li>
                                    <li><a href="{{ route('pricing_plan') }}">Pricing Plan</a></li>
                                    <li><a href="{{ route('element') }}">Elements</a></li>
                                </ul>
                            </li>
                            <li class="menu-btn">
                                @if (Auth::check())
                                    <li class="menu-btn">
                                        <a href="#" class="login">{{ Auth::user()->name }}</a>
                                        <a href="{{ route('logout') }}" class="template-btn"onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">Logout</a>
                                        <form id="logout-form-header" action="{{ route('logout') }}" method="POST"  style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li class="menu-btn">
                                        <a href="{{ route('login') }}" class="login">log in</a>
                                        <a href="{{ route('signup') }}" class="template-btn">sign up</a>
                                    </li>
                                @endif

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-title text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h1>Job Card</h1>
                </div>
            </div>
        </div>
    </div>
</header>

@section('content')
    <!-- Job Single Content Starts -->
    <section class="job-single-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main-content">
                        <div class="single-content1">
                            <div class="single-job mb-4">
                                <h4>Please fill out the details</h4>
                            <div class="row product">
                                <div class="col-6">
                                        <select class="job_profile_id" name="job_profile_id" id="job_profile_id">
                                            <option value="1">Job Profile</option>
                                <option value="2">Part Time</option>
                                <option value="3">Full Time</option>
                                <option value="4">Remote</option>
                                <option value="5">Office Job</option>
                                        </select>
                                </div>
                                <div class="col-6">
                                    <select class="package_id" name="package_id" id="package_id" tabindex="-1" aria-hidden="true">
                                        <option value="1">Select Package</option>
                                        <option value="2">Part Time</option>
                                        <option value="3">Full Time</option>
                                        <option value="4">Remote</option>
                                        <option value="5">Office Job</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Quantity"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Quantity'"
                                    class="single-input" required>
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Experience"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Experience'"
                                    class="single-input" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="Address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'"
                                    class="single-input" required>
                                </div>
                                <div class="col-4">
                                    <select class="package_id" name="package_id" id="package_id" tabindex="-1" aria-hidden="true">
                                        <option value="1">Select State</option>
                                        <option value="2">Part Time</option>
                                        <option value="3">Full Time</option>
                                        <option value="4">Remote</option>
                                        <option value="5">Office Job</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="package_id" name="package_id" id="package_id" tabindex="-1" aria-hidden="true">
                                        <option value="1">Select City</option>
                                        <option value="2">Part Time</option>
                                        <option value="3">Full Time</option>
                                        <option value="4">Remote</option>
                                        <option value="5">Office Job</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="text" placeholder="Zip"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zip'"
                                    class="single-input" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" placeholder="GST Number"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'GST Number'"
                                    class="single-input" required>
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Min. Salary"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Min. Salary'"
                                    class="single-input" required>
                                </div>
                                <div class="col-6">
                                    <input type="text" placeholder="Min. Salary"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Min. Salary'"
                                    class="single-input" required>
                                </div>
                                <div class="col-12">
                                    <textarea class="single-textarea" placeholder="Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Message'" required=""></textarea>
                                </div>
                                <div class="col-12">
                                    <input type="text" readonly placeholder="Total"
                                    class="single-input form-control text-center font-weight-bold">
                                    <div class="more-job-btn mt-4 float-left w-50">
                                        <a href="#" class="genric-btn primary radius text-uppercase font-weight-bold">Add to Cart</a>
                                        <a href="#" class="ml-2 genric-btn primary radius text-uppercase font-weight-bold">buy now</a>
                                    </div>
                                    <div class="more-job-btn text-right mt-4 float-right w-50">
                                        <a href="#" class="genric-btn primary radius text-uppercase font-weight-bold">add more</a>
                                        <a href="#" class="ml-2 genric-btn danger radius text-uppercase font-weight-bold">remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sticky-top">

                    <div class="sidebar">
                        <div class="single-item mb-4">
                            <h4 class="mb-4">Photoshop Designer</h4>
                            <a href="#" class="sidebar-btn d-flex justify-content-between mb-3">
                                <span>&#8377; 6000</span>
                                <span class="text-right">7 days</span>
                            </a>
                            <a href="#" class="sidebar-btn d-flex justify-content-between mb-3">
                                <span>&#8377; 8000</span>
                                <span class="text-right">15 days</span>
                            </a>
                            <a href="#" class="sidebar-btn d-flex justify-content-between">
                                <span>&#8377; 10000</span>
                                <span class="text-right">30 days</span>
                            </a>
                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Job Single Content End -->


    <!-- Newsletter Area Starts -->
    <section class="newsletter-area job-single section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top text-center">
                        <h2>Get job information daily</h2>
                        <p>Subscribe to our newsletter and get a coupon code!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="#">
                        <input type="email" placeholder="Your email here" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email here'" required>
                        <button type="submit" class="template-btn">subscribe now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Area End -->

@endsection
