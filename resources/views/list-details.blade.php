
@extends('layouts.app')

@section('content')


    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <h1>List Details</h1>
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
                        <li><a href="#">Venue Listing</a></li>
                        <li class="active">{{$listing->title}}</li>
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
                <div class="col-md-8 title">
                    <h1>{{$listing->title}}</h1>
                    <p class="location"><i class="fa fa-map-marker"></i>{{$listing->location}}</p>
                    <hr>
                    <div class="rating">
                        @if($listing->totalStar != null  && $listing->totalPerson > 0 )
                            @if(round($listing->totalStar/$listing->totalPerson) == 1)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> 
                            @elseif(round($listing->totalStar/$listing->totalPerson) == 2)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> 
                            @elseif(round($listing->totalStar/$listing->totalPerson) == 3)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i> 
                                <i class="fa fa-star-o"></i> 
                            @elseif(round($listing->totalStar/$listing->totalPerson) == 4)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star-o"></i> 
                            @elseif(round($listing->totalStar/$listing->totalPerson) == 5)
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            @endif
                        @else
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        @endif
                        
                    </div>
                </div>
                <div class="col-md-4 venue-data">
                    <div class="venue-info">
                        <!-- venue-info-->
                        <div class="pricebox">
                            <div>Avg price:</div>
                            <span class="price">${{$listing->price}}</span></div>
                    </div>
                    @if(Auth::user())
                        @if(Auth::user()->user_type == "Vendor")
                            <BUTTON class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#imageOrVideoUpload" >Add Photos</BUTTON>
                        @else
                            <BUTTON class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#bookNow" >Book Now</BUTTON>
                        @endif
                    @else
                        <a href="{{url('/login')}}" class=" col-md-12 btn btn-primary" >Please Login for book</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#photo" title="Gallery" aria-controls="photo" role="tab" data-toggle="tab"> <i class="fa fa-photo"></i> <span class="tab-title">Photo</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#about" title="about info" aria-controls="about" role="tab" data-toggle="tab">
                                <i class="fa fa-info-circle"></i>
                                <span class="tab-title">About</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#onmap" title="Location" aria-controls="onmap" role="tab" data-toggle="tab"> <i class="fa fa-map-marker"></i> <span class="tab-title">On map</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" title="Review" aria-controls="reviews" role="tab" data-toggle="tab"> <i class="fa fa-commenting"></i> <span class="tab-title">Reviews</span></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- tab content start-->
                        <div role="tabpanel" class="tab-pane fade in active" id="photo">
                            <div id="sync1" class="owl-carousel">
                                <div class="item"> <img src="{{url('images/'.$listing->img)}}" alt="" class="img-responsive"> </div>
                                
                                @if($listing_images)
                                    @foreach($listing_images as $image)
                                        <div class="item"> <img src="{{url('images/'.$image->img)}}" alt="" class="img-responsive"> </div>
                                    @endforeach
                                @endif
                            </div>
                            <div id="sync2" class="owl-carousel">
                                <div class="item"> <img src="{{url('images/'.$listing->img)}}" alt="" class="img-responsive"> </div>
                                @if($listing_images)
                                    @foreach($listing_images as $image)
                                        <div class="item"> <img src="{{url('images/'.$image->img)}}" alt="" class="img-responsive"> </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="about">
                            <div class="venue-details">
                                <p>{{$listing->description}}</p>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="onmap">
                            <div id="googleMap" class="map"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="video">
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <!--<iframe class="embed-responsive-item" src=" Video URL HERE"></iframe>-->
                                <a href="javascript:void(0)"><img src="{{url('images/video.jpg')}}" alt="" class="img-responsive"></a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            <!-- comments -->
                            <div class="customer-review">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>Users Review</h1>
                                        <div class="review-list">
                                            @foreach($listinReviews as $listinReview)
                                                <!-- Comment -->
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                        <div class="user-pic"> <img class="img-responsive img-circle" src="{{url('images/userpic.jpg')}}" alt=""> </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-10">
                                                        <div class="panel panel-default arrow left">
                                                            <div class="panel-body">
                                                                <div class="text-left">
                                                                    <h3>{{$listinReview->title}}</h3>
                                                                    <div class="rating"> 
                                                                        @if($listinReview->star == 1)
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-o"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                        @elseif($listinReview->star == 2)
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                        @elseif($listinReview->star == 3)
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star-o"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                        @elseif($listinReview->star == 4)
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star"></i> 
                                                                            <i class="fa fa-star-o"></i> 
                                                                        @elseif($listinReview->star == 5)
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="review-post">
                                                                    <p>{{$listinReview->comment}}</p>
                                                                </div>
                                                                <div class="review-user">
                                                                    Date: 
                                                                    {{-- By <a href="#">Jaisy and Kartin</a>, on  --}}
                                                                    <span class="review-date"></span>{{$listinReview->created_at}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="review"> 
                                            @if(Auth::user())
                                                <a class="btn tp-btn-primary btn-block tp-btn-lg" role="button" data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="review"> Write A Review </a> 
                                            @else
                                                <a class="btn tp-btn-primary btn-block tp-btn-lg" href="/login" aria-expanded="false" aria-controls="review"> Please Login for posting review. </a> 
                                            @endif
                                        </div>
                                        <div class="collapse review-list review-form" id="review">
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h1>Write Your Review</h1>
                                                    <form class="" action="{{url('listing/review/')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="listing_id" value="{{$listing->id}}">
                                                        <div class="rating-group">
                                                            <div class="radio radio-success radio-inline">
                                                                <input type="radio" name="star" id="radio1" value="1" required >
                                                                <label for="radio1" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i></span> </label>
                                                            </div>
                                                            <div class="radio radio-success radio-inline">
                                                                <input type="radio" name="star" id="radio2" value="2" required >
                                                                <label for="radio2" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                                            </div>
                                                            <div class="radio radio-success radio-inline">
                                                                <input type="radio" name="star" id="radio3" value="3" required >
                                                                <label for="radio3" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                                            </div>
                                                            <div class="radio radio-success radio-inline">
                                                                <input type="radio" name="star" id="radio4" value="4" required >
                                                                <label for="radio4" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                                            </div>
                                                            <div class="radio radio-success radio-inline">
                                                                <input type="radio" name="star" id="radio5" value="5" required >
                                                                <label for="radio5" class="radio-inline"> <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> </label>
                                                            </div>
                                                        </div>
                                                        <!-- Text input-->
                                                        <div class="form-group">
                                                            <label class=" control-label" for="title">Review Title</label>
                                                            <div class=" ">
                                                                <input id="title" name="title" type="text" placeholder="Review Title" class="form-control input-md" required>
                                                            </div>
                                                        </div>
                                                        <!-- Textarea -->
                                                        <div class="form-group">
                                                            <label class=" control-label">Write Review</label>
                                                            <div class="">
                                                                <textarea class="form-control" name="comment" rows="8" placeholder="Write Review" required ></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- Button -->
                                                        <div class="form-group">
                                                            <button name="submit" class="btn tp-btn-default tp-btn-lg">Submit Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab content start-->
                </div>
            </div>
        </div>
    </div>


    {{-- modal section --}}
    <div class="modal fade bd-example-modal-lg" id="imageOrVideoUpload" tabindex="-1" role="dialog" aria-labelledby="imageOrVideoUploadLabel" aria-hidden="true">
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
                        <iframe class="col-md-8" height="365" src="{{url('image-view/'.$listing->id)}}">
                              <p>Your browser does not support iframes.</p>
                        </iframe>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>

    
    @if(Auth::user())
        {{-- book modal section --}}
        <div class="modal fade bd-example-modal-lg" id="bookNow" tabindex="-1" role="dialog" aria-labelledby="imageOrVideoUploadLabel" aria-hidden="true">
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
                                <form class="" action="{{url('/booking')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="buyer_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="listing_id" value="{{$listing->id}}">
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="control-label" for="name-one">Name:<span class="required">*</span></label>
                                        <div class="">
                                            @if(Auth::user() && Auth::user()->user_type == "Buyer" )
                                                <input id="name-one" name="name" value="{{Auth::user()->buyerDetails->name}}" type="text" placeholder="Name" class="form-control input-md" required="">
                                            @else
                                                <input id="name-one" name="name" type="text" placeholder="Name" class="form-control input-md" required="">
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone:<span class="required">*</span></label>
                                        <div class="">
                                            <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" required="">
                                            <span class="help-block"> </span> </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="control-label" for="email-one">E-Mail:<span class="required">*</span></label>
                                        <div class="">
                                            <input id="email-one" name="email" value="{{Auth::user()->email}}" type="text" placeholder="E-Mail" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="default-calender">
                                        <div class="form-group">
                                            <label class="control-label" for="eventdate">Event Date<span class="required">*</span></label>
                                            <div class="">
                                                <div class="input-group">
                                                    @if(Auth::user() && Auth::user()->user_type == "Buyer" )
                                                        <input type="date" name="event_date" value="{{Auth::user()->buyerDetails->event_date}}" class="form-control"  id="eventdate" placeholder="Event Date">
                                                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                    @else
                                                        <input type="date" name="event_date" class="form-control" id="eventdate" placeholder="Event Date">
                                                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                    @endif 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="guest">Description:<span class="required"></span></label>
                                        <div class="">
                                            <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button name="submit" class="btn btn-primary btn-lg btn-block">Book</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>
        </div>
    @endif



@endsection


@section('js-script')
    <script type="text/javascript" src="{{ asset('js/thumbnail-slider.js') }}"></script>
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script>
        var myCenter = new google.maps.LatLng(23.0203458, 72.5797426);

        function initialize() {
            var mapProp = {
                center: myCenter,
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var marker = new google.maps.Marker({
                position: myCenter,

                icon: 'images/pinkball.png'
            });

            marker.setMap(map);
            var infowindow = new google.maps.InfoWindow({
                content: "Hello Address"
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <script type="text/javascript" src="{{ asset('js/price-slider.js') }}"></script>
        <script>
        $(function() {
            $("#weddingdate").datepicker();
        });
    </script>

@endsection
