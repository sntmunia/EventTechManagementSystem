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
                        <h1>Vendor list view</h1>
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
                        <li class="active">Vendor list view</li>
                    </ol>
                </div>
                <div class="col-md-4 text-right"> </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-sidebar">
                        <div class="col-md-12 form-title">
                            <h2>Refine Your Search</h2>
                        </div>
                        <form action="{{url('vendor/filter')}}" method="post" >
                            @csrf
                            <div class="col-md-12 form-group">
                                <label class="control-label" for="venuetype">VENDOR CATEGORY</label>
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
                            <div class="col-md-12 form-group">
                                <div class="price-range default-range">
                                	<label class="control-label" for="venuetype">LOCATION</label>
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
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                @foreach($vendors as $vendor)
                    <!-- /.vendor list -->
                    <div class="vendor-box-list">
                        <!-- vendor list -->
                        <div class="row">
                            <div class="col-md-5 no-right-pd">
                                <div class="vendor-image">
                                    <!-- venue pic -->
                                    <a href="{{url('/vendor/'.$vendor->id)}}"><img src="{{url('images/'.$vendor->profile_pic)}}" alt="wedding venue" class="img-responsive"></a>
                                    <div class="favourite-bg">
                                        <div id="vendor_{{$vendor->id}}">
                                            @if(Auth::user())
                                                @if(count($vendor->isAddedToFablist) > 0)
                                                    @if($vendor->isAddedToFablist[0]->user_id == Auth::user()->id)
                                                        <a href="javascript:;" onclick="removeFromFavlist($(this), {{Auth::user()->id}}, {{$vendor->id}})" class="">
                                                            <i style="color: red" class="fa fa-heart"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:;" onclick="addToFavlist($(this), {{Auth::user()->id}}, {{$vendor->id}})" class="">
                                                            <i style="color: black" class="fa fa-heart"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="javascript:;" onclick="addToFavlist($(this), {{Auth::user()->id}}, {{$vendor->id}})" class="">
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
                            </div>
                            <!-- /.venue pic -->
                            <div class=" col-md-7 no-left-pd">
                                <!-- venue details -->
                                <div class="vendor-list-details">
                                    <div class="caption">
                                        <!-- caption -->
                                        <h2><a href="{{url('/vendor/'.$vendor->id)}}" class="title">{{$vendor->vendor_tittle}}</a></h2>
                                        <p class="location"><i class="fa fa-map-marker"></i> {{$vendor->address}}.</p>
                                        <div class="rating">
                                            @if(count($vendor->rating) > 0 ) 
                                                @if(round($vendor->rating[0]->totalStar/$vendor->rating[0]->totalPerson) == 1)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                @elseif(round($vendor->rating[0]->totalStar/$vendor->rating[0]->totalPerson) == 2)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                @elseif(round($vendor->rating[0]->totalStar/$vendor->rating[0]->totalPerson) == 3)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                @elseif(round($vendor->rating[0]->totalStar/$vendor->rating[0]->totalPerson) == 4)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star"></i> 
                                                    <i class="fa fa-star-o"></i> 
                                                @elseif(round($vendor->rating[0]->totalStar/$vendor->rating[0]->totalPerson) == 5)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                @endif

                                                <span class="rating-count">{{$vendor->rating[0]->totalPerson}}</span> 
                                                
                                                
                                            @else
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i> 
                                                <i class="fa fa-star-o"></i> 
                                                <i class="fa fa-star-o"></i> 
                                                <i class="fa fa-star-o"></i> 
                                                <span class="rating-count">0</span> 

                                            @endif
                                            
                                        </div>
                                    </div>
                                    <!-- /.caption -->
                                    <div class="vendor-price">
                                        <div class="price">${{$vendor->minMaxPrice[0]->minPrice}} - ${{$vendor->minMaxPrice[0]->maxPrice}}</div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.vendor list -->
                @endforeach

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
    </div>
    </div> 



@endsection



@section('js-script')

    <script>

        function addToFavlist(thisRow, userID, VendorID){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ url('/user/favourite/vendor/add') }}',
                type: 'POST',
                data: {user_id: userID, vendor_id: VendorID}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                thisRow.remove();

                var markup = "<a href='javascript:;'' onclick='removeFromFavlist($(this), "+userID+", "+VendorID+")' >"
                                +"<i style='color: red' class='fa fa-heart'></i>"
                            +"</a>";

                $("#vendor_"+VendorID).append(markup);

                
               })
               .fail(function(){
                
            });


        }

        function removeFromFavlist(thisRow, userID, VendorID){

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url('/user/favourite/vendor/remove') }}',
                type: 'POST',
                data: {user_id: userID, vendor_id: VendorID}
               })
               .done(function(data){
                console.log(data);
                var response = JSON.parse(data);

                thisRow.remove();

                var markup = "<a href='javascript:;'' onclick='addToFavlist($(this), "+userID+", "+VendorID+")' >"
                                +"<i style='color: black' class='fa fa-heart'></i>"
                            +"</a>";

                $("#vendor_"+VendorID).append(markup);

                
               })
               .fail(function(){
                
            });


        }
    </script>


@endsection