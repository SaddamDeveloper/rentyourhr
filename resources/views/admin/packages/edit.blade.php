@extends('admin.layout.app')

@section('title', "Package Update")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.packages') }}">Packages</a></li>
        <li class="active">Update</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Package Update From</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.packages') }}" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>  Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.package.update', $package->id) }}" method="post" name="package-edit-frm" id="package-edit-frm">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="control-label" for="job_profile_id">Job Profile</label>
                                    <select class="form-control" name="job_profile_id" id="job_profile_id">
                                        <option value="">Select Job Profile</option>
                                        @forelse ($jobs as $e)
                                            <option value="{{ $e->id }}" {{ ($package->job_profile_id === $e->id) ? 'selected' : '' }}>{{ $e->job_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="amount">Base Price (without GST)</label>
                                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Base Price" value="{{ $package->amount }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="replace_day">Replace Within (Days)</label>
                                    <input type="text" name="replace_day" class="form-control" id="replace_day" placeholder="Replace Within" value="{{ $package->replace_day }}">
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
@include('admin.scripts.package')
@endsection
