@extends('layouts.app')

@section('content')

    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-curtains icon-white"></i>
                        </div>
                        <h1>Are you Supplier - Start Business</h1>
                        <p>Event Tech Vendor works with thousands of wedding vendors worldwide.</p>
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
                        <li class="active">Sing Up Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container"> 
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="well-box">
                        <form method="POST" action="{{ url('create-vendor') }}" >
                            @csrf
                            <h2>Vendor Registration</h2>
                            <input type="hidden" name="user_type" value="Vendor">
                            <div class="form-group">
                                <label class="control-label" for="email">E-mail<span class="required">*</span></label>
                                <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
							<div class="form-group">
                                <label class="control-label" for="email">Categories<span class="required">*</span></label>
								<select class="form-control" name="vendor_categorie_id">
									@if($vendor_categories)
										@foreach($vendor_categories as $vendor_categorie)
											<option value="{{$vendor_categorie->id}}">{{$vendor_categorie->name}}</option>
										@endforeach
									@endif
								</select>
                            </div>
							<div class="form-group">
                                <label class="control-label" for="email">Location<span class="required">*</span></label>
                                <select class="form-control" name="location_id">	
									@if($locations)
										@foreach($locations as $location)
											<option value="{{$location->id}}">{{$location->name}}</option>
										@endforeach
									@endif
								</select>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label for="password" class="control-label">{{ __('Password') }}<span class="required">*</span></label>
                                <input id="password" type="password" placeholder="Password" class="form-control input-md {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}<span class="required">*</span></label>
                                <input id="password-confirm" type="password" placeholder="Password-confirm" class="form-control input-md" name="password_confirmation" required>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                <button name="submit" class="btn btn-primary btn-lg">create an account</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="feature-block feature-left">
                                <div class="well-box">
                                    <div class="feature-icon"><i class="icon-love-letter icon-size-60 icon-default"></i></div>
                                    <div class="feature-content">
                                        <h3>Questions ? Contact us </h3>
                                        <p>Can't get any answer am poenatis condimentum. Fusce risus odiamrper at, lacinia vel leo.</p>
                                        <a href="#" class="btn btn-default btn-sm">Help Center</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="feature-block feature-left">
                                <div class="well-box">
                                    <div class="feature-icon"><i class="icon-list-3 icon-size-60 icon-default"></i></div>
                                    <div class="feature-content">
                                        <h3>Event Pricing</h3>
                                        <p>View our pricing table enenatis conntum. Fusce risus odio, egestas sit amet usllamcornia vel leo.</p>
                                        <a href="{{url('pricing')}}" class="btn btn-default btn-sm">View Pricing</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection