@extends('layouts.app')

@section('content')

<div class="vendor-page-header">
    <div style="background: linear-gradient(rgba(0, 0, 0, 0.58), rgba(0, 0, 0, 0.57)), rgba(0, 0, 0, 0.58) url(/images/{{$vendorProfile->cover_pic}}) no-repeat center; background-size: cover; height: 460px;" > </div>
    <div class="vendor-profile-info">
        <div class="container">
            <div class="row">
                <div class="col-md-3 hidden-xs">
                    <div class="vendor-profile-block">
                        <div class="vendor-profile"> 
                            <img src="{{url('/images/'.$vendorProfile->profile_pic)}}" alt="" class="img-responsive">
                            @if(Auth::user() && Auth::user()->id == $vendorProfile->user_id && Auth::user()->user_type == "Vendor")
                                <BUTTON style="width: 100%"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfilePicModal" >Update Photo</BUTTON>
                            @endif
                        </div>
                    </div>
                </div>

                @if($vendorProfile->complete_profile == 1)

                @else
                    <div class="col-md-8">
                        <div class="profile-meta mb30">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="vendor-profile-title">{{$vendorProfile->vendor_tittle}}</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><span class="meta-address"> <i class="fa fa-map-marker"></i> <span class="address"> {{$vendorProfile->address}} </span> </span>
                                </div>
                                <div class="col-md-4"><span class="meta-email"><i class="fa fa-envelope"></i>{{$vendorProfile->loginInformation->email}}</span></div>
                                <div class="col-md-4"><span class="meta-call"><i class="fa fa-phone"></i>{{$vendorProfile->phone}}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="color: #fff; margin-top: 15px">Verndor package type: <span style="color: #00aeaf; margin-top: 15px" >{{$vendorProfile->vendor_package_type}}</span> </h3>
                                </div>
                            </div>
                        </div>
                        <div class="profile-meta">
                            <div class="row">
                                {{-- <div class="col-md-4"><span class="meta-website"><i class="fa fa-link"></i> http://www.myvenue.com</span></div> --}}
                                <div class="col-md-6">
                                    <div class="vendor-profile-social"> 
                                        <span>
                                          <ul class="listnone">
                                            <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                                          </ul>
                                        </span> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if(Auth::user() && Auth::user()->id == $vendorProfile->user_id && Auth::user()->user_type == "Vendor")
                                        <BUTTON  type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfileModal" >Update Profile</BUTTON>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>



<div class=" ">
    <div class="container">

        @if(Session::get('status_message'))
            <div class="row">
                <div class="col-md-12 st-tabs">
                    <div class="well-box" style="background-color: #00aeaf" >
                        <h3 style="color: #fff">{{Session::get('status_message')}}</h3>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="venue-details">
                <div class="col-md-12">
                    <div class="st-tabs">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#myListing" title="Gallery" aria-controls="myListing" role="tab" data-toggle="tab"> <i class="fa fa-list"></i><span class="tab-title"> My Listing</span></a>
                            </li>
                            @if(Auth::user() && Auth::user()->id == $vendorProfile->user_id)
                                <li role="presentation"> <a href="#add-new-list" title="about info" aria-controls="about" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> <span class="tab-title"> Add New List</span> </a> </li>
                            @endif                                <li role="presentation"> <a href="#about" title="about info" aria-controls="about" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> <span class="tab-title"> About Vendor</span> </a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- tab content start-->
                            <div role="tabpanel" class="tab-pane fade in active" id="myListing">
                                <div class="row">
                                    @if($vendorProfile->listings)
                                        @foreach($vendorProfile->listings as $vendorLinsting)
                                            <div class="col-md-6">
                                                <div class="vendor-list-block mb30">
                                                    <!-- vendor list block -->
                                                    <div class="vendor-img">
                                                        <a href="{{url('listing/'.$vendorLinsting->id)}}"><img src="{{url('images/'.$vendorLinsting->img)}}" alt="wedding venue" class="img-responsive"></a>
                                                        <div class="category-badge"><a href="#" class="category-link">category-badge</a></div>
                                                        <div class="price-lable">${{$vendorLinsting->price}}</div>
                                                        <div class="favorite-action">
                                                            <div id="listing_{{$vendorLinsting->id}}">
                                                                @if(Auth::user())
                                                                    @if(count($vendorLinsting->isAddedToFablist) > 0)
                                                                        @if($vendorLinsting->isAddedToFablist[0]->user_id == Auth::user()->id)
                                                                            <a href="javascript:;" onclick="removeFromFavlist($(this), {{Auth::user()->id}}, {{$vendorLinsting->id}})" class="fav-icon">
                                                                                <i style="color: red" class="fa fa-heart"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="javascript:;" onclick="addToFavlist($(this), {{Auth::user()->id}}, {{$vendorLinsting->id}})" class="fav-icon">
                                                                                <i style="color: black" class="fa fa-heart"></i>
                                                                            </a>
                                                                        @endif
                                                                    @else
                                                                        <a href="javascript:;" onclick="addToFavlist($(this), {{Auth::user()->id}}, {{$vendorLinsting->id}})" class="fav-icon">
                                                                            <i style="color: black" class="fa fa-heart"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <a href="javascript:;" onclick="alert('You Have to Login First.')" class="fav-icon">
                                                                            <i style="color: black" class="fa fa-heart"></i>
                                                                        </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vendor-detail">
                                                        <!-- vendor details -->
                                                        <div class="caption">
                                                            <h2><a href="{{url('listing/'.$vendorLinsting->id)}}" class="title">{{$vendorLinsting->title}}</a></h2>
                                                            <div class="vendor-meta"> 
                                                                <span class="location"> 
                                                                    <i class="fa fa-map-marker map-icon"></i> {{$vendorLinsting->location}}
                                                                </span> 
                                                                <span class="rating">
                                                                    @if($vendorLinsting->rating[0]->totalPerson > 0 )
                                                                        @if( round($vendorLinsting->rating[0]->totalStar/$vendorLinsting->rating[0]->totalPerson) ==1 )
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        @elseif( round($vendorLinsting->rating[0]->totalStar/$vendorLinsting->rating[0]->totalPerson) ==2 )
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        @elseif( round($vendorLinsting->rating[0]->totalStar/$vendorLinsting->rating[0]->totalPerson) ==3 )
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        @elseif( round($vendorLinsting->rating[0]->totalStar/$vendorLinsting->rating[0]->totalPerson) ==4 )
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star-o"></i>
                                                                        @elseif( round($vendorLinsting->rating[0]->totalStar/$vendorLinsting->rating[0]->totalPerson) ==5 )
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                        @else
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        @endif
                                                                    @else
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                        <i class="fa fa-star-o"></i>
                                                                    @endif

                                                                        <span class="rating-count">({{$vendorLinsting->rating[0]->totalPerson}})</span>
                                                                 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.vendor details -->
                                                </div>
                                                <!-- /.vendor list block -->
                                            </div>

                                        @endforeach
                                    @endif
                                    
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="add-new-list">
                                <div class="venue-details">
                                    <h2>Add New List</h2>
                                    <p>Fill in your details and a Venue Specialist will get back to you shortly.Fill in your details and a Venue Specialist will get back to you shortly.Fill in your details and a Venue Specialist will get back to you shortly.Fill in your details and a Venue Specialist will get back to you shortly</p>
                                    <form action="{{url('/listing')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="control-label" for="title">Title:<span class="required">*</span></label>
                                            <div class="">
                                                <input id="title" name="title" type="text" placeholder="Title" class="form-control input-md" required>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="control-label" for="price">Price:<span class="required">*</span></label>
                                            <div class="">
                                                <input id="price" name="price" type="number" placeholder="Price" class="form-control input-md" required>
                                                <span class="help-block"> </span> </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="control-label" for="location">Location:<span class="required">*</span></label>
                                            <div class="">
                                                <input id="location" name="location" type="text" placeholder=Location" class="form-control input-md" required>
                                            </div>
                                        </div>
                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="control-label" for="description">Description<span class="required">*</span></label>
                                            <div class="">
                                                <textarea rows="10" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="control-label" for="img">Image:<span class="required">*</span></label>
                                            <div class="">
                                                <input id="img" name="img" type="file" class="form-control input-md" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button name="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="about">
                                <div class="venue-details">
                                    <p>{{$vendorProfile->vendor_description}}</p>
                                    {{-- <h2>Why Our Wedding Venue </h2>
                                    <ul class="check-circle">
                                        <li>Wedding parties have exclusive use of the venue for the day</li>
                                        <li>Last Minute Offer £3,800 inc VAT for any wedding booked in the next 8 weeks.</li>
                                        <li>Licensed for civil ceremonies, civil partnerships and outside ceremonies with stunning views.</li>
                                        <li>This venue is a superb location for a Wedding Reception catering from 30 to 650 guests.</li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /.tab content start-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- modal section --}}
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfilePicModalLabel">Update profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{url('/vendors/profile/update')}}" method="post">
            @csrf

            <div class="modal-body">
                <div class="form-group">
                    <label for="title" class="control-label">{{ __('Title') }}<span class="required">*</span></label>
                    <input id="title" name="title" value="{{$vendorProfile->vendor_tittle}}" type="text" placeholder="Your title" class="form-control input-md " required>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">{{ __('Address') }}<span class="required">*</span></label>
                    <input id="address" name="address" value="{{$vendorProfile->address}}" type="text" placeholder="Your address" class="form-control input-md " required>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label">{{ __('Description') }}<span class="required">*</span></label>
                    <textarea  id="description" name="description" type="text" placeholder="Your description" class="form-control input-md"  rows="10" required>{{$vendorProfile->vendor_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">{{ __('Phone') }}<span class="required">*</span></label>
                    <input id="phone" name="phone" value="{{$vendorProfile->phone}}" type="text" placeholder="Your phone" class="form-control input-md " required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>


<div class="modal fade" id="updateProfilePicModal" tabindex="-1" role="dialog" aria-labelledby="updateProfilePicModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfilePicModalLabel">Update Profile and Cover Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="{{url('/vendors/profile-pic/update')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">
                <div class="form-group">
                    <label for="profile_pic" class="control-label">{{ __('Profile Pic') }}</label>
                    <input id="profile_pic" name="profile_pic" value="{{$vendorProfile->vendor_tittle}}" type="file" class="form-control input-md">
                </div>
                <div class="form-group">
                    <label for="cover_pic" class="control-label">{{ __('Cover Pic') }}</label>
                    <input id="cover_pic" name="cover_pic" value="{{$vendorProfile->address}}" type="file" class="form-control input-md">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>



@endsection



@section('js-script')

    <script>

        function addToFavlist(thisRow, userID, listingID){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/user/favourite/listing/add') }}',
                type: 'POST',
                data: {user_id: userID, listing_id: listingID}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                thisRow.remove();

                var markup = "<a href='javascript:;'' onclick='removeFromFavlist($(this), "+userID+", "+listingID+")' class='fav-icon' >"
                                +"<i style='color: red' class='fa fa-heart'></i>"
                            +"</a>";

                $("#listing_"+listingID).append(markup);


               })
               .fail(function(){

            });


        }

        function removeFromFavlist(thisRow, userID, listingID){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url('/user/favourite/listing/remove') }}',
                type: 'POST',
                data: {user_id: userID, listing_id: listingID}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                thisRow.remove();

                var markup = "<a href='javascript:;'' onclick='addToFavlist($(this), "+userID+", "+listingID+")' class='fav-icon' >"
                                +"<i style='color: black' class='fa fa-heart'></i>"
                            +"</a>";

                $("#listing_"+listingID).append(markup);

                
               })
               .fail(function(){
                
            });


        }
    </script>


@endsection