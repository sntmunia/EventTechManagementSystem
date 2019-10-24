@extends('admin.layout')


@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">

		@if(Session::get('status_message'))
            <div class="row">
                <div class="col-md-12 st-tabs">
                    <div class="well-box" style="background-color: #00aeaf" >
                        <h3 style="color: #fff">{{Session::get('status_message')}}</h3>
                    </div>
                </div>
            </div>
        @endif

        
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Vendors({{count($users)}})</h1>
		</div>

		<!-- Content Row -->
		<div class="row">
			<table class="table">
		      <thead class="thead-dark">
		        <tr>
		          <th scope="col">#</th>
		          <th scope="col">Name</th>
		          <th scope="col">Package Type</th>
		          <th scope="col">Status</th>
		          <th scope="col">Action</th>
		        </tr>
		      </thead>
		      <tbody>
		       @foreach($users as $user)
		      		<tr>
		              <th scope="row">{{$user->id}}</th>
		              <td>{{$user->vendorDetails->vendor_tittle}}</td>
		              <td>{{$user->vendorDetails->vendor_package_type}}</td>
		              <td>{{$user->status}}</td>
		              <td>
		              	<a data-toggle="modal" data-target="#updateUserStatus_{{$user->id}}" href="#" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
							  <i class="fas fa-edit"></i>
							</span>
							<span class="text">Edit</span>
						</a>
						<a href="{{url('payment/vendor/'.$user->vendorDetails->id)}}" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
							  <i class="fa fa-arrow-right"></i>
							</span>
							<span class="text">Payment List</span>
						</a>
						<a data-toggle="modal" data-target="#changePackage_{{$user->id}}" href="#" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
							  <i class="fa fa-arrow-right"></i>
							</span>
							<span class="text">Change Package</span>
						</a>
		              </td>
		            </tr>
		      	@endforeach
		      </tbody>
		    </table>
		</div>
	 </div>


	

@endsection


@section("modal-or-js")

    @foreach($users as $user)
    	<!-- Modal -->
	    <div class="modal fade" id="updateUserStatus_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form action="{{url('admin/update-vendor-vendor-status')}}" method="post" >
	                @csrf
	                <input type="hidden" name="user_id" value="{{$user->id}}">
	                <div class="row">
	                    <div class="form-group col-md-12">
	                        <select class="form-control" name="status">
                                @if($user->status == "Active")
                                    <option selected value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                @elseif($user->status == "Inactive")
                                    <option value="Active">Active</option>
                                    <option selected value="Inactive">Inactive</option>
                                @endif
                            </select>
	                    </div>
	                    <div class="form-group col-md-12">
	                        <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
	                    </div>
	                </div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>

	    <!-- Modal -->
		    <div class="modal fade" id="changePackage_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		      <div class="modal-dialog" role="document">
		        <div class="modal-content">
		          <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalLabel">Subscription package Change</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		          </div>
		          <div class="modal-body">
		            <form action="{{url('subscription-package/update')}}" method="post" >
		                @csrf
		                <input type="hidden" name="vendor_id" value="{{$user->vendorDetails->id}}">
		                <div class="row">
		                    <div class="form-group col-md-12">
		                    	<label>Subscription package</label>
		                        <select class="form-control" name="package" required >
	                                   <option value="Regular"  @if($user->vendorDetails->vendor_package_type == "Regular") selected @endif >Regular</option>
	                                   <option value="Premium"  @if($user->vendorDetails->vendor_package_type == "Premium") selected @endif >Premium</option>
	                            </select>
		                    </div>
		                    <div class="form-group col-md-12">
		                        <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
		                    </div>
		                </div>
		            </form>
		          </div>
		        </div>
		      </div>
		    </div>

    @endforeach
@endsection