@extends('admin.layout.app')

@section('title', "Orders List")

@section('mystyle')

@endsection

@section('content')
<section class="content-header">
    <h1>
        Rent Your HR
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Orders</li>
    </ol>
</section>
<section class="content">
    <div class="box">
        <div class="row">
            <div class="box-body">
                <div class="col-md-4 col-xs-12">
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
                </div>
                <div class="col-md-4 col-xs-12">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Orders List</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Position</th>
                            <th>Package</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($data as $e)
                            <tr>
                                <td>{{ $e->order->user->name }}</td>
                                <td>{{ $e->order->user->email }}</td>
                                <td>{{ $e->order->user->mobile }}</td>
                                <td>{{ $e->position->job_name }}</td>
                                <td>{{ $e->package->replace_day }} Days- {{ $e->package->amount }}</td>
                                <td>{{ $e->order->status }}</td>
                                <td>
                                    <select name="status" class="changestatus" id="{{ $e->id }}">
                                        <option value="order_placed" {{ ($e->status == "order_placed")? "Selected" : "" }}>Order Placed</option>
                                        <option value="rejected" {{ ($e->status == "rejected")? "Selected" : "" }}>Rejected</option>
                                        <option value="candidate_provided" {{ ($e->status == "candidate_provided")? "Selected" : "" }}>Candidate Provided</option>
                                        <option value="replacement" {{ ($e->status == "replacement")? "Selected" : "" }}>Replacement</option>
                                        <option value="complete" {{ ($e->status == "complete")? "Selected" : "" }}>Complete</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.order.show', $e->id) }}" class="btn btn-xs btn-info">View</a>
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
@include('admin.scripts.order')
@endsection
