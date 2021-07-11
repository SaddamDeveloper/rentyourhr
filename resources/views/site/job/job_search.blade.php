@extends('site.layouts.app')

@section('title', 'Job Search')

@section('mystyle')

@endsection

@section('page-hero')
<div class="page-title text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Job Profiles</h1>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="feature-area section-padding2 pb-5">
    <div class="container">
        <div class="row">
            @forelse ($job_profiles as $item)
                <div class="col-lg-4">
                    <div class="single-feature mb-4 mb-lg-0">
                        <h4 class="mb-4">{{ $item->job_name }}</h4>
                        <p class="pb-1 mb-0 border-bottom">
                            <small>Avarage minimum salary is {{ $item->salary }}</small>
                        </p>
                        @foreach ($item->packages as $p)
                            <p class="pb-0 mb-0 border-bottom">
                                <b>&#8377; {{ $p->amount }}</b>
                                <small class="float-right">{{ $p->replace_day }} days Validity</small>
                            </p>
                        @endforeach
                        <a href="#" class="secondary-btn mt-4">book package<span class="flaticon-next"></span></a>
                    </div>
                </div>
            @empty
                <div class="col-lg-12">
                    No Profile found
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
