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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="job_profile_id">Job Position</label>
                                    <select class="form-control job_profile_id" name="job_profile_id" id="job_profile_id">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="package_id">Package</label>
                                    <select class="form-control package_id" name="package_id" id="package_id">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="quantity">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label" for="experience">Experience</label>
                                    <input type="text" name="experience" class="form-control" placeholder="Experience" id="experience">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="address">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Address" id="address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="state">State</label>
                                    <select name="state" class="form-control state" id="state">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="city">City</label>
                                    <select name="city" class="form-control city" id="city">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="zip">Zip</label>
                                    <input type="text" name="zip" class="form-control zip" placeholder="Zip Code" id="zip">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="gst_number">GST Number</label>
                                    <input type="text" name="gst_number" class="form-control gst_number" placeholder="GST Number" id="gst_number">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" for="min_salary">Minimum Salary</label>
                                    <input type="text" name="min_salary" class="form-control min_salary" placeholder="Minimum Salary" id="min_salary">
                                  </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label" for="max_salary">Maximum Salary</label>
                                    <input type="text" name="max_salary" class="form-control max_salary" placeholder="Maximum Salary" id="max_salary">
                                  </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <input type="text" name="description" class="form-control description" placeholder="Enter Description" id="description">
                                  </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="total">Total</label>
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

@include('site.scripts.product_script')
@endsection
