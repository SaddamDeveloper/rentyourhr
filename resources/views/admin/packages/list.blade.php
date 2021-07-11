@extends('admin.layout.app')

@section('title', "Packages")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Packages</li>
    </ol>
</section>
<section class="content">
    <div class="box">
        <div class="row">
            <div class="box-body">
                <div class="col-md-6 col-xs-12">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control pull-right" placeholder="Search" value="{{ (isset($request->keyword)) ? $request->keyword : null }}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="btn-group">
                        <a href="{{ route('admin.packages', 'active') }}" class="btn bg-purple btn-flat btn-sm">
                            Active Packages
                        </a>
                        <a href="{{ route('admin.packages', 'archived') }}" class="btn bg-navy btn-flat btn-sm">
                            Deleted Packages
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <a href="{{ route('admin.package.create') }}" class="btn bg-maroon btn-flat btn-sm pull-right">
                        Create package
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Package</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Job Profile</th>
                            <th>Price</th>
                            <th>Replacement</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($data as $e)
                            <tr>
                                <td>{{ $e->id }}</td>
                                <td>{{ $e->job->job_name }}</td>
                                <td>{{ $e->amount }}</td>
                                <td>{{ $e->replace_day }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.package.edit', $e->id) }}" class="btn btn-xs btn-warning">Edit</a>
                                        @if ($e->status)
                                            <a class="btn btn-xs btn-danger delete-package" href="{{ route('admin.package.destroy', $e->id) }}" title="Delete Data" data-method="delete">Delete</a>
                                        @else
                                            <a class="btn btn-xs btn-success restore-package" href="{{ route('admin.package.restore', $e->id) }}" title="Delete Data" data-method="get">Restore</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        @endforelse
                    </table>
                    <div class="mt-5">
                        {{ $data->appends(Request::except('page'))->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('myscript')
@include('admin.scripts.package')
@endsection
