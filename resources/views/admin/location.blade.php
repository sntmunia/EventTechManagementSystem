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
			<h1 class="h3 mb-0 text-gray-800">Location</h1>
			<a data-toggle="modal" data-target="#addNewLocation" href="#" class="btn btn-primary btn-icon-split">
				<span class="icon text-white-50">
				  <i class="fas fa-plus"></i>
				</span>
				<span class="text">Add New Location</span>
			</a>
		</div>

		<!-- Content Row -->
		<div class="row">
			<table class="table">
		      <thead class="thead-dark">
		        <tr>
		          <th scope="col">#</th>
		          <th scope="col">Name</th>
		          <th scope="col">Action</th>
		        </tr>
		      </thead>
		      <tbody>
		       @foreach($locations as $location)
		      		<tr>
		              <th scope="row">{{$location->id}}</th>
		              <td>{{$location->name}}</td>
		              <td>
		              	<a data-toggle="modal" data-target="#editLocation_{{$location->id}}" href="#" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
							  <i class="fas fa-edit"></i>
							</span>
							<span class="text">Edit</span>
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
	<!-- Modal -->
    <div class="modal fade" id="addNewLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{url('admin/add-new-location')}}" method="post" >
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="name">Location name:<span class="required">*</span></label>
                        <div class="">
                            <input id="name" name="name" type="text" placeholder="Location name" class="form-control input-md" required="">
                            <span class="help-block"> </span> 
                        </div>
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

    @foreach($locations as $location)
    	<!-- Modal -->
	    <div class="modal fade" id="editLocation_{{$location->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLabel">Update Location</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form action="{{url('admin/update-location')}}" method="post" >
	                @csrf
	                <input type="hidden" name="location_id" value="{{$location->id}}">
	                <div class="row">
	                    <div class="form-group col-md-12">
	                        <label class="control-label" for="name">Locations name:<span class="required">*</span></label>
	                        <div class="">
	                            <input id="name" name="name" value="{{$location->name}}" type="text" placeholder="Categories name" class="form-control input-md" required>
	                            <span class="help-block"> </span> 
	                        </div>
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
    @endforeach
@endsection