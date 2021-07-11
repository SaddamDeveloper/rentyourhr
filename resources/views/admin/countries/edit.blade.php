@extends('admin.layout.app')

@section('title', "Country Edit")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.users') }}">Country</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Country Create From</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.countries') }}" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>  Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.country.update', $user->id) }}" method="post" name="country-edit-frm" id="country-edit-frm">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">Full name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Full name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="mobile">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" value="{{ $user->mobile }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="address">Street Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Street Address" value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="country">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" placeholder="Country" value="{{ $user->country }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="zip">Zip</label>
                                    <input type="text" name="zip" class="form-control" id="zip" placeholder="Zip" value="{{ $user->zip }}">
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
@endsection
