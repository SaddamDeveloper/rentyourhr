@extends('site.layouts.app')

@section('title', 'Unpaid Invoices')

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
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($orders as $e)
                            <tr>
                                <td>{{ $e->id }}</td>
                                <td>{{ $e->created_at }}</td>
                                <td>{{ $e->total_amount }}</td>
                                <td>
                                    <a class="template-btn" href="{{ route('invoice.paynow', $e->order_id) }}">Pay Now</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('myscript')
@endsection
