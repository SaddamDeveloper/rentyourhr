@extends('admin.layout.app')

@section('title', "City Edit")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.cities') }}">City</a></li>
        <li class="active">Edit</li>
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
                    <form action="{{ route('admin.city.update', $city->id) }}" method="post" name="city-edit-frm" id="city-edit-frm">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">City</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="City name" value="{{ $city->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">Select State</label>
                                    <select class="form-control myselect" name="state_id" id="state_id" data-parsley-required>
                                        <option></option>
                                        @forelse ($states as $state)
                                            <option value="{{ $state->id }}" @if($state->id == $city->state_id) selected @endif>{{ $state->name . " - " . $state->country->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
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
