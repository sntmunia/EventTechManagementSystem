@extends('layouts.app')

@section('content')

<div class="tp-page-head">
    <!-- page header -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="page-header text-center">
                    <div class="icon-circle">
                        <i class="icon icon-size-60 icon-lock icon-white"></i>
                    </div>
                    <h1>Please login for using full features..</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.page header -->
<div class="tp-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Login</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="main-container">
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

            @if(Session::get('warning_message'))
                <div class="row">
                    <div class="col-md-12 st-tabs">
                        <div class="well-box" style="background-color: #FF0000" >
                            <h3 style="color: #fff">{{Session::get('warning_message')}}</h3>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 st-tabs">
                    <!-- Nav tabs -->
                    <div class="well-box">
                        <h3>User Login</h3>
                        <form  method="POST" action="{{ url('/login') }}" >
                            @csrf
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label" for="email">E-mail<span class="required">*</span></label>
                                <input id="email" name="email" type="text" placeholder="E-Mail" value="{{ old('email') }}" class="form-control input-md {{ $errors->has('email') ? ' is-invalid' : '' }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="control-label" for="password">Password<span class="required">*</span></label>
                                <input id="password" name="password" type="password" placeholder="Password" value="{{ old('password') }}" class="form-control input-md {{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                                <button id="submit" name="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        

@endsection