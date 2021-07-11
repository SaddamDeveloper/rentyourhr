@extends('admin.layout.app')

@section('title', "Orders Details")

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

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Orders Details</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $order->order['company'] }}</td>
                        </tr>
                        <tr>
                             <th>Description</th>
                             <td>{{ $order->order['description'] }}</td>
                        </tr>
                        <tr>
                             <th>Profile</th>
                             <td>{{ $order->position['job_name'] }}</td>
                        </tr>
                        <tr>
                             <th>Package</th>
                             <td>{{ $order->package['replace_day'] }} Days- {{ $order->package['amount'] }}</td>
                        </tr>
                        <tr>
                             <th>Price</th>
                             <td>{{ $order->price }}</td>
                        </tr>
                        <tr>
                             <th>Quantity</th>
                             <td>{{ $order->quantity }}</td>
                        </tr>
                        <tr>
                             <th>Minimum Salary</th>
                             <td>{{ $order->min_salary }}</td>
                        </tr>
                        <tr>
                             <th>Maximum Salary</th>
                             <td>{{ $order->max_salary }}</td>
                        </tr>
                        <tr>
                             <th>Experience</th>
                             <td>{{ $order->experience  }}</td>
                        </tr>
                        <tr>
                             <th>Amount</th>
                             <td>{{ $order->amount }}</td>
                        </tr>
                        <tr>
                             <th>GST Number</th>
                             <td>{{ $order->gst_number }}</td>
                        </tr>
                        <tr>
                             <th>CGST</th>
                             <td>{{ $order->cgst }}</td>
                        </tr>
                        <tr>
                             <th>SGST</th>
                             <td>{{ $order->sgst }}</td>
                        </tr>
                        <tr>
                             <th>IGST</th>
                             <td>{{ $order->igst }}</td>
                        </tr>
                        <tr>
                             <th>Total</th>
                             <td>{{ $order->total }}</td>
                        </tr>
                        <tr>
                             <th>Description</th>
                             <td>{{ $order->description }}</td>
                        </tr>
                        <tr>
                             <th>Address</th>
                             <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                             <th>State</th>
                             <td>{{ $order->state }}</td>
                        </tr>
                        <tr>
                             <th>City</th>
                             <td>{{ $order->city }}</td>
                        </tr>
                        <tr>
                             <th>Zip</th>
                             <td>{{ $order->zip }}</td>
                        </tr>


                    </table>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('myscript')
@endsection
