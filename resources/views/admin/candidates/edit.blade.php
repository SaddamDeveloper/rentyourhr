@extends('admin.layout.app')

@section('title', "Candidates Edit")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.candidates') }}">Candidates</a></li>
        <li class="active">Candidates Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Candidate Create From</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.candidates') }}" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>  Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.candidate.update', $e->id) }}" method="post" name="candidate-edit-frm" id="candidate-edit-frm" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">Full name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Full name" value="{{ $e->name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $e->email }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="mobile">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" value="{{ $e->mobile }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="industry">Industry</label>
                                    <input type="text" name="industry" class="form-control" id="industry" placeholder="Industry" value="{{ $e->industry }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="current_job_position">Current Job Position</label>
                                    <input type="text" name="current_job_position" class="form-control" id="current_job_position" placeholder="Current Job Position" value="{{ $e->current_job_position }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="job_position">Job Position Looking For</label>
                                    <input type="text" name="job_position" class="form-control" id="job_position" placeholder="Job Position" value="{{ $e->job_position }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="experience">Experience</label>
                                    <input type="text" name="experience" class="form-control" id="experience" placeholder="Experience in month" value="{{ $e->experience }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="gender">Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="">Select status</option>
                                        <option value="male" {{ ($e->gender == 'male')? 'selected': '' }}>Male</option>
                                        <option value="female" {{ ($e->gender == 'female')? 'selected': '' }}>Female</option>
                                        <option value="other" {{ ($e->gender == 'other')? 'selected': '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="pan_no">PAN No</label>
                                    <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="PAN No" value="{{ $e->pan_no }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="aadhar_no">Aadhar No</label>
                                    <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Aadhar No" value="{{ $e->aadhar_no }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="address" value="{{ $e->address }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="city">City</label>
                                    <input type="text" name="city" class="form-control" id="city" placeholder="City" value="{{ $e->city }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="country">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" placeholder="Country" value="{{ $e->country }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="zip">Zip</label>
                                    <input type="text" name="zip" class="form-control" id="zip" placeholder="zip" value="{{ $e->zip }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="current_company">Current Company</label>
                                    <input type="text" name="current_company" class="form-control" id="current_company" placeholder="Current Company" value="{{ $e->current_company }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="current_salary">Current Salary</label>
                                    <input type="text" name="current_salary" class="form-control" id="current_salary" placeholder="Current Salary" value="{{ $e->current_salary }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="expected_salary">Expected Salary</label>
                                    <input type="text" name="expected_salary" class="form-control" id="expected_salary" placeholder="Expected Salary" value="{{ $e->expected_salary }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="expected_location">Expected Location</label>
                                    <input type="text" name="expected_location" class="form-control" id="expected_location" placeholder="Expected Location" value="{{ $e->expected_location }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="date_of_birth">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control" id="date_of_birth" placeholder="YYYY-MM-DD" value="{{ $e->date_of_birth }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="marital_status">Marital Status</label>
                                    <select class="form-control" name="marital_status" id="marital_status">
                                        <option value="">Select status</option>
                                        <option value="yes" {{ ($e->marital_status == 'yes')? 'selected': '' }}>Yes</option>
                                        <option value="no" {{ ($e->marital_status == 'no')? 'selected': '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="passport">Passport</label>
                                    <select class="form-control" name="passport" id="passport">
                                        <option value="">Select status</option>
                                        <option value="yes" {{ ($e->passport == 'yes')? 'selected': '' }}>Yes</option>
                                        <option value="no" {{ ($e->passport == 'no')? 'selected': '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="cv_file">Upload Your CV</label>
                                    <input type="file" id="cv_file" name="cv_file" class="filestyle imgInput" data-icon="false">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="parent_code">Parent Code</label>
                                    <input type="text" name="parent_code" class="form-control" id="parent_code" placeholder="Parent Code" value="{{ $e->parent_code }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="parent_email">Refer Partner Email</label>
                                    <input type="text" name="parent_email" class="form-control" id="parent_email" placeholder="Partner Email" value="{{ $e->parent_email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="parent_name">Refer Partner Name</label>
                                    <input type="text" name="parent_name" class="form-control" id="parent_name" placeholder="Refer Partner name" value="{{ $e->parent_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="parent_mobile">Refer Partner Mobile</label>
                                    <input type="text" name="parent_mobile" class="form-control" id="parent_mobile" placeholder="Refer Partner Mobile" value="{{ $e->parent_mobile }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Select status</option>
                                        <option value="not_verified" {{ ($e->status == 'not_verified')? 'selected': '' }}">Not Verified</option>
                                        <option value="candidate_contacted" {{ ($e->status == 'candidate_contacted')? 'selected': '' }}>Candidate Contacted</option>
                                        <option value="not_contactable" {{ ($e->status == 'not_contactable')? 'selected': '' }}>Not contactable</option>
                                        <option value="wrong_no" {{ ($e->status == 'wrong_no')? 'selected': '' }}>Wrong No</option>
                                        <option value="CV_received" {{ ($e->status == 'CV_received')? 'selected': '' }}>CV received</option>
                                        <option value="not_interested" {{ ($e->status == 'not_interested')? 'selected': '' }}>Not interested</option>
                                        <option value="awaiting_suitable_status" {{ ($e->status == 'awaiting_suitable_status')? 'selected': '' }}>Awaiting suitable status</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="skills">Skills</label>
                                    <input type="text" name="skills" class="form-control" id="skills" placeholder="Skills" value="{{ $e->skills }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="cv_file_client">Upload Your for client view</label>
                                    <input type="file" id="cv_file_client" name="cv_file_client" class="filestyle imgInput" data-icon="false">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button id="btn-submit" type="submit" class="btn btn-success btn-block mt-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('myscript')
@include('admin.scripts.candidates')
@endsection
