@extends('site.layouts.app')

@section('title', 'Check Out')

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
            <h3 class="mb-30 title_color">All Selected Job List</h3>
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
                            <th>Action</th>
                        </tr>
                        @forelse ($data as $e)
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
                                <td>
                                    <div class="btn-group">
                                         <a class="btn btn-xs btn-danger delete-job" href="{{ route('job.cart.destroy', $e->id) }}" title="Delete Data" data-method="delete">Remove</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
               <hr>
                <form action="{{ route('job.cart.place') }}" name="jobCartOrderFrm" id="jobCartOrderFrm" method="POST">
                    @csrf
                    <div class="job-card-group productGroup">
                        <div class="row product">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label" for="name">Company Name</label>
                                    <input type="text" name="company" class="form-control" placeholder="Company" id="company">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                   <label class="control-label" for="name">Description</label>
                                   <input type="text" name="description" class="form-control" placeholder="Description" id="description">
                                </div>
                            </div>
                            <div class="col-md-2 mt-10">
                                <input type="submit" class="template-btn" value="Checkout" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('myscript')

@include('site.scripts.product_checkout_script')
@endsection
