<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Vendor;
use Auth;
use Session;
use Stripe;


class PaymentController extends Controller
{


	public function stripe()
    {
        return view('payment');
    }
  

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 75 * 75,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Premium Subcription payment" 
        ]);
  
        Session::flash('success', 'Payment successful!');


        $payment = new Payment;

        $payment->vendor_id = Auth::user()->vendorDetails->id;
        $payment->month = $request->month;
        $payment->year = $request->year;
        $payment->amount = 75;
        $payment->status = 'Pending';

        $payment->save();

        // $vendor = Vendor::find(Auth::user()->vendorDetails->id);

        // $vendor->vendor_package_type = 'Premium';
        // $vendor->save();


          
        return redirect(url('payment-list/vendor/'.Auth::user()->vendorDetails->id));
    }


    public function paymentList($id){
        
        $payments = Payment::where('vendor_id', '=', $id)->orderBy('id', 'desc')->get();

        //dd($payments);
        
        return view('payment-list')->with('payments', $payments);
    }


}
