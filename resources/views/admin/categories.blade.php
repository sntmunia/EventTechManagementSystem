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
			<h1 class="h3 mb-0 text-gray-800">Categories</h1>
			<a data-toggle="modal" data-target="#addNewCategories" href="#" class="btn btn-primary btn-icon-split">
				<span class="icon text-white-50">
				  <i class="fas fa-plus"></i>
				</span>
				<span class="text">Add New Categories</span>
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
		       @foreach($vendor_categories as $categorie)
		      		<tr>
		              <th scope="row">{{$categorie->id}}</th>
		              <td>{{$categorie->name}}</td>
		              <td>
		              	<a data-toggle="modal" data-target="#editCategories_{{$categorie->id}}" href="#" class="btn btn-primary btn-icon-split">
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
    <div class="modal fade" id="addNewCategories" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{url('admin/add-new-categories')}}" method="post" >
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="control-label" for="name">Categories name:<span class="required">*</span></label>
                        <div class="">
                            <input id="name" name="name" type="text" placeholder="Categories name" class="form-control input-md" required="">
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

    @foreach($vendor_categories as $categorie)
    	<!-- Modal -->
	    <div class="modal fade" id="editCategories_{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form action="{{url('admin/update-categories')}}" method="post" >
	                @csrf
	                <input type="hidden" name="categoreis_id" value="{{$categorie->id}}">
	                <div class="row">
	                    <div class="form-group col-md-12">
	                        <label class="control-label" for="name">Categories name:<span class="required">*</span></label>
	                        <div class="">
	                            <input id="name" name="name" value="{{$categorie->name}}" type="text" placeholder="Categories name" class="form-control input-md" required>
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