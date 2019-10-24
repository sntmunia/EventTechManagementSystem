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


		<!-- Content Row -->
		<div class="row">
			<table class="table">
		      <thead class="thead-dark">
		        <tr>
		          <th scope="col">#</th>
		          <th scope="col">Month</th>
		          <th scope="col">Year</th>
		          <th scope="col">Amount</th>
		          <th scope="col">Status</th>
		          <th scope="col">Action</th>
		        </tr>
		      </thead>
		      <tbody>
		       @foreach($payments as $payment)
		      		<tr>
		              <th scope="row">{{$payment->id}}</th>
		              <td>{{$payment->month}}</td>
		              <td>{{$payment->year}}</td>
		              <td>{{$payment->amount}}</td>
		              <td>{{$payment->status}}</td>
		              <td>
		              	<a data-toggle="modal" data-target="#payment_{{$payment->id}}" href="#" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
							  <i class="fa fa-arrow-right"></i>
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

	@foreach($payments as $payment)

		<!-- Modal -->
		    <div class="modal fade" id="payment_{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		      <div class="modal-dialog" role="document">
		        <div class="modal-content">
		          <div class="modal-header">
		            <h5 class="modal-title" id="exampleModalLabel">Payments</h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		              <span aria-hidden="true">&times;</span>
		            </button>
		          </div>
		          <div class="modal-body">
		            <form action="{{url('payment/update')}}" method="post" >
		                @csrf
		                <input type="hidden" name="payment_id" value="{{$payment->id}}">
		                <input type="hidden" name="vendor_id" value="{{$vendor_id}}">
		                <div class="row">
		                    <div class="form-group col-md-12">
		                    	<label>Month</label>
		                        <select class="form-control" name="month" required >
	                                   <option value="Jan" @if($payment->month == "Jan") selected @endif >January</option>
	                                   <option value="Fev" @if($payment->month == "Fev") selected @endif >February</option>
	                                   <option value="Mar" @if($payment->month == "Mar") selected @endif >March</option>
	                                   <option value="Apr" @if($payment->month == "Apr") selected @endif >April</option>
	                                   <option value="May" @if($payment->month == "May") selected @endif >May</option>
	                                   <option value="Jun" @if($payment->month == "Jun") selected @endif >June</option>
	                                   <option value="Jul" @if($payment->month == "Jul") selected @endif >July</option>
	                                   <option value="Aug" @if($payment->month == "Aug") selected @endif >Aguest</option>
	                                   <option value="Sep" @if($payment->month == "Sep") selected @endif >September</option>
	                                   <option value="Oct" @if($payment->month == "Oct") selected @endif >October</option>
	                                   <option value="Nov" @if($payment->month == "Nov") selected @endif >November</option>
	                                   <option value="Dec" @if($payment->month == "Dec") selected @endif >December</option>
	                            </select>
		                    </div>
		                    <div class="form-group col-md-12">
		                    	<label>Year</label>
		                        <select class="form-control" name="year" required >
	                                   <option value="2019" @if($payment->year == "2019") selected @endif >2019</option>
	                                   <option value="2020" @if($payment->year == "2020") selected @endif >2020</option>
	                                   <option value="2021" @if($payment->year == "2021") selected @endif >2021</option>
	                                   <option value="2022" @if($payment->year == "2022") selected @endif >2022</option>
	                                   <option value="2013" @if($payment->year == "2023") selected @endif >2013</option>
	                                   <option value="2024" @if($payment->year == "2024") selected @endif >2024</option>
	                                   <option value="2025" @if($payment->year == "2025") selected @endif >2025</option>
	                                   <option value="2026" @if($payment->year == "2026") selected @endif >2026</option>
	                                   <option value="2027" @if($payment->year == "2027") selected @endif >2027</option>
	                                   <option value="2028" @if($payment->year == "2028") selected @endif >2028</option>
	                                   <option value="2029" @if($payment->year == "2029") selected @endif >2029</option>
	                            </select>
		                    </div>
		                    <div class="form-group col-md-12">
		                    	<label>Year</label>
		                        <select class="form-control" name="status" required >
	                                   <option value="Pending">Pending</option>
	                                   <option value="Success" >Success</option>
	                                   <option value="Failed" >Failed</option>
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