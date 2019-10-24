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
                        <h1>Create a FREE account &amp; save you date.</h1>
                        <p>Start Planning It's Free t amet justo venenatis vesti cus arcuoin auctor sodales interdum.</p>
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
                        <li class="active">Sign Up Buyer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-6 singup-couple">
                    <div class="well-box">
                        <h2>Let's turn your event into a reality!</h2>
                        <form  method="POST" action="{{ url('create-buyer') }}" >
                            @csrf
                            <!-- Text input-->
                            <div class="form-group">
                                <label for="password" class="control-label">{{ __('name') }}<span class="required">*</span></label>
                                <input id="name" name="name" type="text" placeholder="Your name" class="form-control input-md {{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label for="event_date" class="control-label">{{ __('Event Date') }}<span class="required">*</span></label>
                                <input type="date" placeholder="Event Date" id="event_date" name="event_date" class="form-control input-md {{ $errors->has('event_date') ? ' is-invalid' : '' }}" required>
                                @error('event_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email">E-mail<span class="required">*</span></label>
                                <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md{{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                <button id="submit" name="submit" class="btn btn-primary">Create An Account</button>
                            </div>
                        </form>
                    </div> 
                    <p>Already a Member? <a href="{{url('/login')}}">Log In</a></p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 feature-block">
                            <div class="well-box">
                                <div class="feature-icon"> <i class="icon-list-2 icon-size-60 icon-default"></i> </div>
                                <div class="feature-content">
                                    <h3>Event Checklist</h3>
                                    <p>Nullam porttitor lorem atdiam quis semper diam orci at neque.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 feature-block">
                            <div class="well-box">
                                <div class="feature-icon"><i class="icon-budget icon-size-60 icon-default"></i></div>
                                <div class="feature-content">
                                    <h3>Event Budget</h3>
                                    <p>Donec convallis libero et risus maximus cgestas sem venenatis vel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 feature-block">
                            <div class="well-box">
                                <div class="feature-icon"><i class="icon-wedding-arch icon-size-60 icon-default"></i></div>
                                <div class="feature-content">
                                    <h3>Event Vendors</h3>
                                    <p>Aliquam erat volutpat. Quisque ullamcorper quis ipsum eget consequat.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 feature-block">
                            <div class="well-box">
                                <div class="feature-icon"><i class="icon-two-hearts icon-size-60 icon-default"></i></div>
                                <div class="feature-content">
                                    <h3>Everything you need</h3>
                                    <p>Fusce dapibus ex ac justo facili libero et risus maximus convallis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


@endsection