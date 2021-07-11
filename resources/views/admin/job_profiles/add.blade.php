@extends('admin.layout.app')

@section('title', "Job Profile Add")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.jobs') }}">Job Profiles</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Job Profile Create From</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.jobs') }}" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>  Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.job.store') }}" method="post" name="job-add-frm" id="job-add-frm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="job_name">Job Profile</label>
                                    <input type="text" name="job_name" class="form-control" id="job_name" placeholder="Job Profile">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="salary">Avararge minimum salary</label>
                                    <input type="text" name="salary" class="form-control" id="salary" placeholder="Avararge minimum salary">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="must_have">Skill must have</label>
                                    <input type="text" name="must_have" class="form-control" id="must_have" placeholder="Skill must have">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="good_to_have">Skill Good Have</label>
                                    <input type="text" name="good_to_have" class="form-control" id="good_to_have" placeholder="Skill good have">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="btn-submit" type="submit" class="btn btn-success btn-block">Save</button>
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
@include('admin.scripts.job')
@endsection
