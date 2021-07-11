@extends('admin.layout.app')

@section('title', "User Edit")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.users') }}">Users</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">User Create From</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.users') }}" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>  Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" name="user-edit-frm" id="user-edit-frm">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="company_name">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Company Name" value="{{ $user->company_name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="address">Street Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Street Address" value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="location"> Company Location</label>
                                    <input type="text" name="location" class="form-control" id="location" placeholder="Location" value="{{ $user->location }}">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="roles">Roles <span class="required">*</span>
                                    </label>
                                    <div class="row">
                                        @forelse ($roles as $role)
                                            <div class="col-md-3">
                                                <label class="form-check-label">
                                                    <input name="roles[]" type="checkbox" class="flat-red roles" value="{{ $role->id }}" {{ (is_array($user->roles->pluck('id')->toArray()) && in_array($role->id, $user->roles->pluck('id')->toArray())) ? 'checked' : '' }}> {{ ucfirst($role->display_name) }}
                                                </label>
                                            </div>
                                        @empty
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                No Roles Added
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
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
@include('admin.scripts.user')
@endsection
