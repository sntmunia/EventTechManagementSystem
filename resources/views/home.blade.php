@extends('layouts.app')

@section('content')

<div class="slider-bg">
        <!-- slider start-->
        <div id="slider" class="owl-carousel owl-theme slider">
            <div class="item"><img src="images/hero-image-3.jpg" alt="Wedding couple just married"></div>
            <div class="item"><img src="images/hero-image-2.jpg" alt="Wedding couple just married"></div>
            <div class="item"><img src="images/hero-image.jpg" alt="Wedding couple just married"></div>
        </div>
        <div class="find-section">
            <!-- Find search section-->
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-1 col-md-10 finder-block">
                        <div class="finder-caption">
                            <h1>Find your perfect Event Vendor</h1>
                            <p>Over <strong>1200+ Event Vendor </strong>for you special date &amp; Find the perfect venue &amp; save you date.</p>
                        </div>
                        <div class="finderform">
                            <form action="{{url('/vendor/filter')}}" method="post" >
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control" name="vendor_categorie_id">
                                            <option>Select Vendor Category</option>
                                            @if($vendor_categories)
                                                @foreach($vendor_categories as $vendor_categorie)
                                                    <option value="{{$vendor_categorie->id}}">{{$vendor_categorie->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select class="form-control" name="location_id">
                                            <option>Select City</option>
                                            @if($locations)
                                                @foreach($locations as $location)
                                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Find Vendors</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Find search section-->
    </div>
    <!-- slider end-->
    <div class="section-space80">
        <!-- Feature Blog Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Your Event Planing Start Here</h1>
                        <p>Various versions have evolved over the years sometimes by accident sometimes on purpose.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- feature center -->
                <div class="col-md-4">
                    <div class="feature-block feature-center">
                        <!-- feature block -->
                        <div class="feature-icon"><img src="images/vendor.svg" alt=""></div>
                        <h2>Find local vendor</h2>
                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</p>
                    </div>
                </div>
                <!-- /.feature block -->
                <div class="col-md-4">
                    <div class="feature-block feature-center">
                        <!-- feature block -->
                        <div class="feature-icon"><img src="images/mail.svg" alt=""></div>
                        <h2>Contact vendor</h2>
                        <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    </div>
                </div>
                <!-- /.feature block -->
                <div class="col-md-4">
                    <div class="feature-block feature-center">
                        <!-- feature block -->
                        <div class="feature-icon"><img src="images/couple.svg" alt=""></div>
                        <h2>Save Your Date</h2>
                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour or non-characteristic words etc.</p>
                    </div>
                </div>
                <!-- /.feature block -->
            </div>
            <!-- /.feature center -->
        </div>
    </div>
    <!-- Feature Blog End -->
    <div class="section-space80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Featured Event Vendor listing</h1>
                        <p>Many desktop publishing packages and web page editors now use orem psum as their default model text.</p>
                    </div>
                </div>
            </div>
            <div class="row ">

            @if($listings)
                @foreach($listings as $list)

                    <div class="col-md-4 vendor-box"> 
                        <!-- venue box start-->
                        <div class="vendor-image">
                            <!-- venue pic -->
                            <a href="{{url('listing/'.$list->id)}}"><img src="{{url('images/'.$list->img)}}" alt="wedding venue" class="img-responsive"></a>
                            <div class="feature-label"></div>
                            <div class="favourite-bg">
                                <div id="listing_{{$list->id}}">
                                    @if(Auth::user())
                                        @if(count($list->isAddedToFablist) > 0)
                                            @if($list->isAddedToFablist[0]->user_id == Auth::user()->id)
                                                <a href="javascript:;" onclick="removeFromFavlist($(this), {{Auth::user()->id}}, {{$list->id}})" class="">
                                                    <i style="color: red" class="fa fa-heart"></i>
                                                </a>
                                            @else
                                                <a href="javascript:;" onclick="addToFavlist($(this), {{Auth::user()->id}}, {{$list->id}})" class="">
                                                    <i style="color: black" class="fa fa-heart"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="javascript:;" onclick="addToFavlist($(this), {{Auth::user()->id}}, {{$list->id}})" class="">
                                                <i style="color: black" class="fa fa-heart"></i>
                                            </a>
                                        @endif
                                    @else
                                        <a href="javascript:;" onclick="alert('You Have to Login First.')" class="">
                                                <i style="color: black" class="fa fa-heart"></i>
                                            </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.venue pic -->
                        <div class="vendor-detail">
                            <!-- venue details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="{{url('listing/'.$list->id)}}" class="title">{{$list->title}}</a></h2>
                                <p class="location"><i class="fa fa-map-marker"></i> {{$list->location}}.</p>
                                <div class="rating ">
                                    @if($list->totalStar != null  && $list->totalPerson > 0 )
                                        @if(round($list->totalStar/$list->totalPerson) == 1) 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i> 
                                            <i class="fa fa-star-o"></i> 
                                            <i class="fa fa-star-o"></i> 
                                            <i class="fa fa-star-o"></i> 
                                        @elseif(round($list->totalStar/$list->totalPerson) == 2)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star-o"></i> 
                                            <i class="fa fa-star-o"></i> 
                                            <i class="fa fa-star-o"></i> 
                                        @elseif(round($list->totalStar/$list->totalPerson) == 3)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i> 
                                            <i class="fa fa-star-o"></i> 
                                        @elseif(round($list->totalStar/$list->totalPerson) == 4)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star-o"></i> 
                                        @elseif(round($list->totalStar/$list->totalPerson) == 5)
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
                                 <span class="rating-count">({{$list->totalPerson}})</span> 
                                </div>
                            </div>
                            <!-- /.caption -->
                            <div class="vendor-price">
                                <div class="price">${{$list->price}}</div>
                            </div>
                        </div>
                        <!-- venue details -->
                    </div>

                    
                @endforeach
            @endif 


                


            </div>
        </div>
    </div>

    <!-- /. Testimonial Section -->
    <div class="section-space80">
        <!-- Call to action -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 couple-block">
                    <div class="couple-icon"><img src="images/couple.svg" alt=""></div>
                    <h2>Are you find the venue ?</h2>
                    <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    <a href="#" class="btn btn-primary">Find Vendor</a> </div>
                <div class="col-md-6 vendor-block">
                    <div class="vendor-icon"><img src="images/vendor.svg" alt=""></div>
                    <h2>Are you vender ?</h2>
                    <p>Fusce eget elementum quam, vel tempor justo. Ut imperdiet eget sapien dictum aliquam. Nulla maximus sodales dignissim.</p>
                    <a href="#" class="btn btn-primary">Add Your Listing</a></div>
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

                var markup = "<a href='javascript:;'' onclick='removeFromFavlist($(this), "+userID+", "+listingID+")' >"
                                +"<i style='color: red' class='fa fa-heart'></i>"
                            +"</a>";

                $("#listing_"+listingID).append(markup);

                

                // swal({
                //   type: response.status,
                //   position: 'top-end',
                //   title: response.message,
                //   showConfirmButton: false,
                //   timer: 500
                // })
               })
               .fail(function(){
                // swal({
                //   position: 'top-end',
                //   type: 'error',
                //   title: 'fail to add into Cart.',
                //   showConfirmButton: false,
                //   timer: 500
                // })
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

                var markup = "<a href='javascript:;'' onclick='addToFavlist($(this), "+userID+", "+listingID+")' >"
                                +"<i style='color: black' class='fa fa-heart'></i>"
                            +"</a>";

                $("#listing_"+listingID).append(markup);

                
               })
               .fail(function(){
                
            });


        }
    </script>


@endsection
