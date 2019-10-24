
@extends('layouts.app')

@section('content')


<div class="tp-page-head">
    <!-- page header -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="page-header text-center">
                    <h1>Booking List</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tp-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Booking List</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="container tabbed-page st-tabs">

        @if(Session::get('status_message'))
            <div class="row">
                <div class="col-md-12 st-tabs">
                    <div class="well-box" style="background-color: #00aeaf" >
                        <h3 style="color: #fff">{{Session::get('status_message')}}</h3>
                    </div>
                </div>
            </div>
        @endif
            
        <div class="row tab-page-header">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">List</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Event Date</th>
                  <th scope="col">Description</th>
                  <th scope="col">Book Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bookings as $booking)
                    <tr>
                      <th scope="row">{{$booking->id}}</th>
                      <td><a href="listing/{{$booking->listing_id}}">Details</a></td>
                      <td>{{$booking->name}}</td>
                      <td>{{$booking->email}}</td>
                      <td>{{$booking->phone}}</td>
                      <td>{{$booking->event_date}}</td>
                      <td>{{$booking->description}}</td>
                      <td>{{$booking->book_status}}</td>
                      @if(Auth::user()->user_type == "Buyer")
                        <td><button  data-toggle="modal" data-target="#updateBooking_{{$booking->listing_id}}" >Edit</button></td>
                      @elseif(Auth::user()->user_type == "Vendor")
                        <td><button  data-toggle="modal" data-target="#updateBookinByVendor_{{$booking->listing_id}}" >Edit</button></td>
                      @endif
                    </tr>
                @endforeach
              </tbody>
            </table>

            
            
        </div>
    </div>
</div>



@foreach($bookings as $booking)
    @if(Auth::user()->user_type == "Buyer")
        {{-- book modal section --}}
        <div class="modal fade bd-example-modal-lg" id="updateBooking_{{$booking->listing_id}}" tabindex="-1" role="dialog" aria-labelledby="imageOrVideoUploadLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="imageOrVideoUploadLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                     <div class="container">
                        <div class="row">
                            <div class=" col-md-8 side-box" id="inquiry">
                                <h2>Fill in your details and a Venue Specialist will get back to you shortly.</h2>
                                <form class="" action="{{url('/booking/update')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                    <input type="hidden" name="buyer_id" value="{{$booking->user_id}}">
                                    <input type="hidden" name="listing_id" value="{{$booking->listing_id}}">
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="control-label" for="name-one">Name:<span class="required">*</span></label>
                                        <div class="">
                                            <input id="name-one" name="name" value="{{$booking->name}}" type="text" placeholder="Name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone:<span class="required">*</span></label>
                                        <div class="">
                                            <input id="phone" name="phone" value="{{$booking->phone}}" type="text" placeholder="Phone" class="form-control input-md" required="">
                                            <span class="help-block"> </span> </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="control-label" for="email-one">E-Mail:<span class="required">*</span></label>
                                        <div class="">
                                            <input id="email-one" name="email" value="{{$booking->email}}" type="text" placeholder="E-Mail" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="default-calender">
                                        <div class="form-group">
                                            <label class="control-label" for="eventdate">Event Date<span class="required">*</span></label>
                                            <div class="">
                                                <div class="input-group">
                                                    <input type="date" name="event_date" value="{{$booking->event_date}}" class="form-control"  id="eventdate" placeholder="Event Date">
                                                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="guest">Description:<span class="required"></span></label>
                                        <div class="">
                                            <textarea class="form-control" rows="5" id="description" name="description">{{$booking->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button name="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>
        </div>

    @elseif(Auth::user()->user_type == "Vendor")
        <!-- Modal -->
        <div class="modal fade" id="updateBookinByVendor_{{$booking->listing_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{url('booking/confirmation')}}" method="post" >
                    @csrf
                    <input type="hidden" name="booking_id" value="{{$booking->id}}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select class="form-control" name="book_status">
                                @if($booking->book_status == "Pending")
                                    <option selected value="Pending">Pending</option>
                                    <option value="Confirm">Confirm</option>
                                    <option value="Cancel">Cancel</option>
                                @elseif($booking->book_status == "Confirm")
                                    <option value="Pending">Pending</option>
                                    <option selected value="Confirm">Confirm</option>
                                    <option value="Cancel">Cancel</option>
                                @elseif($booking->book_status == "Cancel")
                                   <option value="Pending">Pending</option>
                                    <option value="Confirm">Confirm</option>
                                    <option selected value="Cancel">Cancel</option>
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
    @endif
@endforeach



@endsection

