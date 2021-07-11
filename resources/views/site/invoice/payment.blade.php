@extends('site.layouts.app')

@section('title', 'Payment')

@section('mystyle')
<style>
    .frm-feedback {
        color: #FF0000;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-30 title_color">Invoice</h3>
            <div class="job-card">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Position</th>
                            <th>Package</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>IGST</th>
                            <th>Total</th>
                        </tr>
                        @forelse ($orders->items as $e)
                            <tr>
                                <td>{{ $e->position['job_name'] }}</td>
                                <td>{{ $e->package->replace_day }} Days- {{ $e->package->amount }}</td>
                                <td>{{ $e->price }}</td>
                                <td>{{ $e->quantity }}</td>
                                <td>{{ $e->amount }}</td>
                                <td>{{ $e->cgst }}</td>
                                <td>{{ $e->sgst }}</td>
                                <td>{{ $e->igst }}</td>
                                <td>{{ $e->total }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Company Nmae</th>
                                    <td>{{ $orders->company }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $orders->description }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Total Amount</th>
                                    <td>{{ $orders->total_amount }}</td>
                                </tr>
                                <tr>
                                    <th>GST Amount</th>
                                    <td>{{ $orders->gst }}</td>
                                </tr>
                                <tr>
                                    <th>Bill Total</th>
                                    <td>{{ $orders->bill_total }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

               <hr>

                <div class="job-card-group productGroup">
                    <div class="row product">
                        <div class="col-md-5">

                        </div>
                        <div class="col-md-5">

                        </div>
                        <div class="col-md-2 mt-10">
                            <input type="submit" class="template-btn" value="Payment" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('myscript')
@endsection
