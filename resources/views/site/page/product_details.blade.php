@extends('site.layouts.app')

@section('title', 'Seclet Your Position')

@section('mystyle')
<style>
    .frm-feedback {
        color: #FF0000;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-30 title_color">Job Card</h3>
            <div class="job-card">
                <form action="{{ route('job.cart.store') }}" name="jobCartAddFrm" id="jobCartAddFrm" method="POST">
                    @csrf
                    <div class="job-card-group productGroup">
                        <div class="row product">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control job_profile_id" name="job_profile_id" id="job_profile_id">
                                        @if (isset($job_profile) && !empty($job_profile))
                                            @foreach ($job_profile as $profile)                                                
                                                <option value="{{$profile->id}}" {{$profile->id == $job_profile_id ? "selected" : ""}}>{{$profile->job_name}}</option>
                                            @endforeach                                        
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control package_id" name="package_id" id="package_id">
                                        @if (isset($packages) && !empty($packages))
                                            @foreach ($packages as $package)                                                
                                                <option value="{{$package->id}}" {{$package->id == $package_id ? "selected" : ""}}>{{$package->amount}}</option>
                                            @endforeach                                        
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control" placeholder="Address" id="address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="state" class="form-control state" id="state">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="city" class="form-control city" id="city">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="zip" class="form-control zip" placeholder="Zip Code" id="zip">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="gst_number" class="form-control gst_number" placeholder="GST Number" id="gst_number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="salary" class="form-control salary" placeholder="Salary Offerd" id="salary">
                                  </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="total" class="form-control total" placeholder="Total" readonly id="total">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-10">
                        <button type="button" class="template-btn" id="adToCart">Add To Cart</button>
                        <button type="button" class="template-btn" id="buyNow">Buy Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('myscript')

{{-- @include('site.scripts.product_script') --}}
@endsection
