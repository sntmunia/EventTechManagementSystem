<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Are you local weddding vendor provider & looking for wedding vendor website template. Wedding Vendor Responsive Website Template suitable for wedding vendor supplier, wedding agency, wedding company, wedding events etc.. ">
    <meta name="keywords" content="Wedding Vendor, wedding template, wedding website template, events, wedding party, wedding cake, wedding dress, wedding couple, couple, Wedding Venues Website Template">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wedding') }}</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template style.css -->
    <link rel="stylesheet"  href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet"  href="{{ asset('css/owl.transitions.css') }}">

    @yield("specific-header_link")

    <!-- Font used in template -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,400italic,500,500italic,700,700italic,300italic,300' rel='stylesheet' type='text/css'>
    <!--font awesome icon -->
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/4.4.0/css/font-awesome.min.css') }}">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- /.top search -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 top-message">
                    <p>Welcome to Wedding Vendor.</p>
                </div>
                <div class="col-md-6 top-links">
                    <ul class="listnone">
                        @if(Auth::user())
                            @if(Auth::user()->user_type == "Vendor")
                                <li><a href="{{ url('pricing') }}">Subcription package</a></li>
                                <li><a href="{{ url('payment-list/vendor/'.Auth::user()->vendorDetails->id) }}">Payment List</a></li>
                            @endif
                            <li>
                                <a href="{{ URL('/logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    @if(Auth::user()->user_type == "Buyer")
                                       Logout({{Auth::user()->buyerDetails->name}})
                                    @else
                                        Logout(Vendor)
                                    @endif
                                </a>

                                <form id="logout-form" action="{{ URL('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        @else
                            {{-- <li><a href="{{ url('pricing') }}">Pricing</a></li> --}}
                            <li><a href="{{ url('signup-buyer') }}" class=" ">Are You Buyer</a></li>
                            <li><a href="{{ url('signup-vendor') }}">Are you vendor?</a></li>
                            <li><a href="{{ url('login') }}">Log in</a></li>
                        @endif

                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 logo">
                    <div class="navbar-brand">
                        <a href="{{url('/')}}"><img style="height: 50px; width: 100px" src="{{url('images/logo.png')}}" alt="Wedding Vendors" ></a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="navigation" id="navigation">
                        <ul>
                            <li class="active"><a href="{{ url('home') }}">Home</a>
                            </li>
                            <li><a href="{{ url('listing') }}">Listing</a>
                            </li>
                            <li><a href="{{ url('vendors') }}">Vendor</a>
                            </li>
                            @if(Auth::user())
                                <li class="has-sub"><span class="submenu-button"></span><a href="#">Favourite</a>
                                    <ul>
                                        <li><a href="{{ url('favourite/vendors') }}">Vendor</a></li>
                                        <li><a href="{{ url('favourite/listings') }}">Listing</a></li>
                                    </ul>
                                </li>
                            @endif
                            </li>
                            @if(Auth::user() && Auth::user()->user_type == "Buyer" )
                                <li><a href="{{ url('history') }}">Booking History</a>
                            @endif
                            @if(Auth::user() && Auth::user()->user_type == "Vendor" )
                                <li><a href="{{ url('history') }}">Booking Request</a>
                            @endif
                            <li><a href="{{ url('about-us') }}">About Us</a>
                            </li>
                        </ul>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

    

    @yield("content")
    


    <!-- /. Call to action -->
    <div class="footer">
        <!-- Footer -->
        <div class="container">
            <div class="row">
                <div class="col-md-5 ft-aboutus">
                    <h2>Event.Vendor</h2>
                    <p>At Event Vendor our purpose is to help people find great online network connecting wedding suppliers and wedding couples who use those suppliers. <a href="#">Start Find Vendor!</a></p>
                </div>
                <div class="col-md-3 ft-link">
                    <h2>Useful links</h2>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-md-4 newsletter">
                    <h2>Subscribe for Newsletter</h2>
                    
                    <div class="social-icon">
                        <h2>Be Social &amp; Stay Connected</h2>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- /.Footer -->
    <div class="tiny-footer">
        <!-- Tiny footer -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">Copyright © 2014. All Rights Reserved</div>
            </div>
        </div>
    </div>
    <!-- /. Tiny Footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Flex Nav Script -->
    <script src="{{ asset('js/jquery.flexnav.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/navigation.js') }}"></script>
    <!-- slider -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"" type="text/javascript"></script>
    <!-- testimonial -->
    <script src="{{ asset('js/testimonial.js') }}" type="text/javascript"></script>
    <!-- sticky header -->
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/header-sticky.js') }}"></script>

    


    @yield("js-script")




</body>


<!-- Mirrored from jituchauhan.com/wedding/wedding-new/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Jun 2019 15:32:58 GMT -->
</html>
