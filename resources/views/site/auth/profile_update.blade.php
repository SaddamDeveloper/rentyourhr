@extends('site.layouts.app')

@section('title', 'Profile Update')

@section('mystyle')

@endsection

@section('content')
<section class="user-profile-page section-padding">
    <div class="container">
        <div class="team-single">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-30 title_color">Profile Update From</h3>
                    <form action="{{ route('profile.save') }}" name="profileFrm" id="profileFrm" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Contact Person Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Contact Person Name" id="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="email" id="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Company name</label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Company name" id="company_name" value="{{ $user->company_name }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-10">
                            <button type="submit" class="template-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('myscript')
@include('site.scripts.profile')
@endsection
