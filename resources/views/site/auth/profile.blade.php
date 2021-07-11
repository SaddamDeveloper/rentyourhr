@extends('site.layouts.app')

@section('title', 'Profile Update')

@section('mystyle')

@endsection

@section('content')
<section class="user-profile-page section-padding">
    <div class="container">
        <div class="team-single">
            <div class="row">
                <div class="col-lg-4 col-md-5 xs-margin-30px-bottom">
                    <div class="bg-light-gray padding-30px-all">
                        <h4>My Profile</h4>
                        <p>Welcome {{ $user->name }}.</p>
                        <div class="margin-20px-top">
                            <ul class="margin">
                                <li><a href="javascript:void(0)"><i class="fa fa-envelope"></i></a> {{ $user->company_name }}</li>
                                <li><a href="javascript:void(0)"><i class="fa fa-mobile"></i> {{ $user->mobile }}</a></li>
                                <li><a href="javascript:void(0)"><i class="fa fa-envelope"></i></a> {{ $user->email }}</li>
                                <li><a href="{{ route('profile.update') }}"><i class="fa fa-pencil"></i>Edit Your details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="team-single-text padding-50px-left sm-no-padding-left">
                        <h4 class=>Addresses</h4>
                        <div class="single-content1">
                            <div class="single-job mb-4">
                                <h4>Add a Location</h4>
                                <form id="userAddressFrm" action="{{route('user.address.store')}}" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Address Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="Address Name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" class="form-control" placeholder="Address" id="address">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="zip">Zip Code</label>
                                                <input type="text" name="zip" class="form-control" placeholder="Zip Code" id="zip">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select name="state" class="form-control state" id="state">
                                                    <option></option>
                                                    @forelse ($states as $e)
                                                        <option value="{{ $e->name }}" data-state="{{ $e->id }}">{{ $e->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select name="city" class="form-control city" id="city">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="more-job-btn mt-4">
                                                <button type="submit" class="genric-btn primary radius text-uppercase font-weight-bold">Add another</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h4>Addresses</h4>
                    <div class="table table-responsive">
                        <table class="table order-table">
                            <thead class="text-secondary font-size-small">
                                <tr>
                                    <th scope="col">Location Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="user-address-table">
                                @forelse ($user_address as $item)
                                    <tr>
                                        <th scope="row">{{ $item->name }}</th>
                                        <th scope="row">{{ $item->address }}</th>
                                        <th scope="row">{{ $item->city }} - {{ $item->zip }}</th>
                                        <th scope="row">{{ $item->state }}</th>
                                        <td>
                                            <a href="{{ route('address.remove', $item->id) }}" data-method="delete" class="delete-address">
                                                <i class="fa fa-trash fa-2x text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('myscript')
@include('site.scripts.profile')
@endsection
