@extends('site.layouts.app')

@section('title', 'Seclet Your Position')

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
            <h3 class="mb-30 title_color">Products</h3>
            @if (isset($products) && !empty($products))
                <div class="job-card">
                    @foreach ($products as $product)  
                        <div class="job-card-group productGroup">
                            <div class="card">
                                <h5 class="card-header">{{$product->job_name}}</h5>
                                <div class="card-body row">
                                    @if (isset($product->packages) && !empty($product->packages))
                                        @foreach ($product->packages as $package)
                                            <div class="col-md-4">
                                                <a href="{{route('product.details',['job_profile_id'=>$product->id,'package_id'=>$package->id])}}">
                                                    Amount : {{$package->amount}} <br>
                                                    Replacement Day : {{$package->replace_day}}
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                                             
                                </div>
                            </div>
                        </div><br>
                    @endforeach
                </div>            
            @endif
        </div>
    </div>
</div>
@endsection

@section('myscript')

{{-- @include('site.scripts.product_script') --}}
@endsection
