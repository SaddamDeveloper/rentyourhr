@extends('admin.layout.app')

@section('title', "City Add")

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
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">City Create From</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('admin.cities') }}" class="btn btn-box-tool">
                            <i class="fa fa-arrow-left"></i>  Back</a>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.city.store') }}" method="post" name="city-add-frm" id="city-add-frm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">Select State</label>
                                    <select class="form-control" name="state_id" id="state_id">
                                        <option value="">Select state</option>
                                        @forelse ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name . " - " . $state->country->name }}</option>
                                        @empty
                                        @endforelse

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">City</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="City name">
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
@include('admin.scripts.city')
@endsection
