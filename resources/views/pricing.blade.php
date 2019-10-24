 @extends('layouts.app')

@section('content')

    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-budget icon-white"></i>
                        </div>
                        <h1>Pricing Table</h1>
                        <p>Fusce volutpat turpis sit amet justo venenatis vestibul leo augue, molestie nec lacus utemper rhoncus arcuoin auctor sodales interdum.</p>
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
                        <li class="active">Pricing Table</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="main-container">

        <div class="container">
            <div class="row pricing-container">
                <div class="col-md-6 pricing-box pricing-box-regualr">
                    <div class="well-box">
                        <h2 class="price-title">Regular</h2>
                        <h1 class="price-plan"><span class="dollor-sign">$</span>Free<span class="permonth">/mo</span></h1>

                        @if(Auth::user()->vendorDetails->vendor_package_type == 'Regular')
                            <a href="#" onclick="alert('Your are already in this plan.')" class="btn btn-primary btn-sm">Selected</a>
                        @else
                            <a href="#" onclick="alert('Your cannot download in this package. please contact to admin.')" class="btn btn-default btn-sm">Select Plan</a> 
                        @endif
                        
                    </div>
                        <ul class="check-circle list-group">
                            <li class="list-group-item">24/7 Email Support</li>
                            <li class="list-group-item">ePayments &amp; eInvoices</li>
                            <li class="list-group-item">Advanced Review Management</li>
                            <li class="list-group-item">Education Webinars</li>
                        </ul>
                </div>
                <div class="col-md-6 pricing-box pricing-box-top">
                    <div class="well-box">
                        <h2 class="price-title">Premium</h2>
                        <h1 class="price-plan"><span class="dollor-sign">$</span>75<span class="permonth">/mo</span></h1>

                        @if(Auth::user()->vendorDetails->vendor_package_type == 'Premium')
                            <a href="#" onclick="alert('Your are already in this plan.')" class="btn btn-primary btn-sm">Selected</a> 
                        @else
                            <a href="#" data-toggle="modal" data-target="#payment" class="btn btn-default btn-sm">Select Plan</a> 
                        @endif

                        
                    </div>
                    <ul class="check-circle list-group">
                        <li class="list-group-item">24/7 Email Support</li>
                        <li class="list-group-item">Unlimited User Accounts</li>
                        <li class="list-group-item">Secure Client Transactions</li>
                        <li class="list-group-item">Online Appointment Scheduling</li>
                    </ul>
                </div>
            </div>
            <div></div>
            <div class="section-space80">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title mb60 text-center">
                            <h1>Do you have a question ?</h1>
                        </div>
                    </div>
                    <div class="col-md-6 question-block">
                        <div class="question-answer">
                            <h2><span class="question-sign">Q</span> Which payment methods are supported?</h2>
                            <p>Sed lacinia lectus sedurna luctus interdumras commodo porttitor always faucibus Nullam sollicitudin ultriciesleo non viverra neque laoreet amazin consectetur nisl sedblandit turpis enimac urabitur.</p>
                        </div>
                        <div class="question-answer">
                            <h2><span class="question-sign">Q</span> What uisque ulrices eficiturn interdum justo?</h2>
                            <p>Sed lacinia lectus sedurna luctus interdumras commodo porttitor always faucibus Nullam sollicitudin ultriciesleo non viverra neque laoreet amazin consectetur nisl sedblandit turpis enimac urabitur.</p>
                        </div>
                        <div class="question-answer">
                            <h2><span class="question-sign">Q</span> How ullam diissim nisiege luctus anteui?</h2>
                            <p>Mauris metus leoelemetum condimentum tellus velornare dictum ligula uisque vestibulum molestieerat euleifend turpis fermentum quisras offer massaelit potentiorbi rhoncus pellen tesque exanibus. </p>
                        </div>
                    </div>
                    <div class="col-md-6 question-block">
                        <div class="question-answer">
                            <h2><span class="question-sign">Q</span> Can I cancel or refund my subscription?</h2>
                            <p>Phasellus quislandit velitorbi aliquet vulputate sagittis usce lobortis velsit amet facilisis imperdiet Integer lacinia sodales eratonec dignissim felisa duivulputat a triiqu nullafelis rhoncus.</p>
                        </div>
                        <div class="question-answer">
                            <h2><span class="question-sign">Q</span> Why tibulum consectetur lorem sagittis?</h2>
                            <p>Aenean varius ornare diamquis scelerisque. umsociis natoque penatibus etmagnis disarturientsitamet augue suscipit utfringilla velit sollicitudin In velest inturpis one sagittis interdu.</p>
                        </div>
                        <div class="question-answer">
                            <h2><span class="question-sign">Q</span> Why sociis natoque magnis diaturient montes?</h2>
                            <p>Lacinia lectus sedurna luctus interdumras commodo porttitor always faucibus Nullam interdum libero utfringilla cursus tortor magna consectetur nisl sedblandit turpis urabitur.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="well-box feature-left">
                        <div class="feature-icon"><i class="icon-love-letter icon-size-60 icon-default"></i></div>
                        <div class="feature-content">
                            <h3>Have questions? Contact us at</h3>
                            <p>We're here to help, 24 hours a day, 7 days a week utfrit inturpis one sagittis interdu.<strong><a href="#"> support@weddingvendor.com</a></strong></p>
                        </div>
                        <p></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well-box feature-left">
                        <div class="feature-icon"><i class="icon-heart-shaped-balloons icon-size-60 icon-default"></i></div>
                        <div class=" feature-content">
                            <h3>Want to know how it works ?</h3>
                            <p>Lacinia lectus sedurna luctus interdumras commodo pro utfringilla cursus tortor magna consectetur nisl sedblandit turpis <a href="#">Go to How it works.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="paymentLabel">Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                                                     data-cc-on-file="false"
                                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                                    id="payment-form">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default credit-card-box">
                                <div class="panel-heading display-table" >
                                    <div class="row display-tr" >
                                        <h3 class="panel-title display-td" >Payment Details</h3>
                                        <div class="display-td" >                            
                                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                        </div>
                                    </div>                    
                                </div>
                                <div class="panel-body">
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label> <input
                                                class='form-control' size='4' type='text'>
                                        </div>
                                    </div> 
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Month</label> 
                                            <select class="form-control" name="month" required >
                                                   <option value="Jan" >January</option>
                                                   <option value="Fev" >February</option>
                                                   <option value="Mar" >March</option>
                                                   <option value="Apr" >April</option>
                                                   <option value="May" >May</option>
                                                   <option value="Jun" >June</option>
                                                   <option value="Jul" >July</option>
                                                   <option value="Aug" >Aguest</option>
                                                   <option value="Sep" >September</option>
                                                   <option value="Oct" >October</option>
                                                   <option value="Nov" >November</option>
                                                   <option value="Dec" >December</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label' >Year</label>
                                            <select class="form-control" name="year" required >
                                                   <option value="2019" >2019</option>
                                                   <option value="2020" >2020</option>
                                                   <option value="2021" >2021</option>
                                                   <option value="2022" >2022</option>
                                                   <option value="2013" >2013</option>
                                                   <option value="2024" >2024</option>
                                                   <option value="2025" >2025</option>
                                                   <option value="2026" >2026</option>
                                                   <option value="2027" >2027</option>
                                                   <option value="2028" >2028</option>
                                                   <option value="2029" >November</option>
                                                   <option value="2029" >November</option>
                                            </select>
                                        </div>
                                    </div> 
              
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group card required'>
                                            <label class='control-label'>Card Number</label> <input
                                                autocomplete='off' class='form-control card-number' size='20'
                                                type='text'>
                                        </div>
                                    </div>
              
                                    <div class='form-row row'>
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
              
                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group hide'>
                                            <div class='alert-danger alert'>Please correct the errors and try
                                                again.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($75)</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>



@endsection


@section('js-script')

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            var $form         = $(".require-validation");
          $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                 'input[type=text]', 'input[type=file]',
                                 'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
                $errorMessage.addClass('hide');
         
                $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
              var $input = $(el);
              if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
              }
            });
          
            if (!$form.data('cc-on-file')) {
              e.preventDefault();
              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
              Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
              }, stripeResponseHandler);
            }
          
          });
          
          function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
          
        });
    </script>
@endsection 
