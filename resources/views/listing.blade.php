@extends('layouts.app')

@section('content')

<div class="tp-page-head">
    <!-- page header -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="page-header text-center">
                    <div class="icon-circle">
                        <i class="icon icon-size-60  icon-list icon-white"></i>
                    </div>
                    <h1>Listing view</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tp-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Vendor List</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="filter-box">
    <div class="container">
        <div class="row filter-form">
            <div class="col-md-12">
                <h4>Refine Your Search</h4>
            </div>
            <form class="col-md-12" action="{{url('listing/filter')}}" method="post" >
                @csrf
                <div class="col-md-3">
                    <label class="control-label" for="venuetype">Venue Type</label>
                    <select name="vendor_categorie_id" class="form-control">
                        @isset($vendor_categorie_id)
                            @if($vendor_categorie_id == "")
                                <option value="" selected >Select Vendor Category</option>
                                @foreach($vendor_categories as $vendor_categorie)
                                    <option value="{{$vendor_categorie->id}}">{{$vendor_categorie->name}}</option>
                                @endforeach
                            @else
                                <option value="">Select Vendor Category</option>
                                @foreach($vendor_categories as $vendor_categorie)
                                    @if($vendor_categorie_id == $vendor_categorie->id)
                                        <option value="{{$vendor_categorie->id}}" selected >{{$vendor_categorie->name}}</option>
                                    @else
                                        <option value="{{$vendor_categorie->id}}">{{$vendor_categorie->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                        @else
                            <option value="">Select Vendor Category</option>
                            @foreach($vendor_categories as $vendor_categorie)
                                <option value="{{$vendor_categorie->id}}">{{$vendor_categorie->name}}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="capacity">Capacity</label>
                    <select name="location_id" class="form-control">
                        @isset($location_id)
                            @if($location_id == "")
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            @else
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    @if($location->id == $location_id)
                                        <option value="{{$location->id}}" selected >{{$location->name}}</option>
                                    @else
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                        @else
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="price">Highest Price</label>
                    @isset($price)
                        <input class="form-control" type="number" name="price" value="{{$price}}" placeholder="Price" >  
                    @else
                        <input class="form-control" type="number" name="price" placeholder="Price">  
                    @endisset       
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">Refine Your Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mb30">
                    <h2> {{count($listings)}} Listing in your search.</h2>
                </div>
            </div>

            @if($listings)
                @foreach($listings as $list)
                    <div class="col-md-4 vendor-box"> 
                        <!-- venue box start-->
                        <div class="vendor-image">
                            <!-- venue pic -->
                            <a href="{{url('listing/'.$list->id)}}"><img src="{{url('images/'.$list->img)}}" alt="wedding venue" class="img-responsive"></a>
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
        <div class="row">
            <div class="col-md-12 tp-pagination">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous"> <span aria-hidden="true">Previous</span> </a>
                    </li>
                    <li class="active"><a href="#">1</a></li>
                    <li>
                        <a href="#" aria-label="Next"> <span aria-hidden="true">NEXT</span> </a>
                    </li>
                </ul>
            </div>
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