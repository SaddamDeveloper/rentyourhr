@extends('admin.layout.app')

@section('title', "User Details")

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
        <li class="active">Details</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            {{ $user }}
        </div>
    </div>
</section>
@endsection

@section('myscript')
@include('admin.scripts.user')
@endsection
