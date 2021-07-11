@extends('admin.layout.app')

@section('title', "Candidate Details")

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
        <li class="active">Candidate Details</li>
    </ol>
</section>
<section class="content">
    <div class="box">
        <div class="row">
            <div class="box-body">
                <div class="col-md-4 col-xs-12">
                    Candidate Details
                </div>
                <div class="col-md-4 col-xs-12">
                </div>
                <div class="col-md-4 col-xs-12">
                    <a href="{{ route('admin.candidates') }}" class="btn bg-maroon btn-flat btn-sm pull-right">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $e }}
        </div>
    </div>
</section>
@endsection

@section('myscript')
@include('admin.scripts.candidates')
@endsection
