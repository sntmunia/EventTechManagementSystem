<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use DB;
use Auth;
use Validator;
use Session;

class UserController extends Controller
{
    //
    public function addVendorToFav(Request $request){


    	DB::table('vendor_fav_lists')
    		->insert(['user_id' => $request->user_id, 'vendor_id' =>  $request->vendor_id]);


    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'Vendor added successfully to your favourite lists.';

        return json_encode($response);

    }


    public function removeVendorToFav(Request $request){

    	DB::table('vendor_fav_lists')
    	->where('user_id', '=', $request->user_id)
    	->where('vendor_id', '=', $request->vendor_id)
    	->delete();

    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'Vendor has been removed from your favourite lists.';

        return json_encode($response);
    }

    public function addListingToFav(Request $request){

    	DB::table('listing_fav_lists')
    		->insert(['user_id' => $request->user_id, 'listing_id' =>  $request->listing_id]);


    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'Listing added successfully to your favourite lists.';

        return json_encode($response);

    }


    public function removeListingToFav(Request $request){

    	DB::table('listing_fav_lists')
    	->where('user_id', '=', $request->user_id)
    	->where('listing_id', '=', $request->listing_id)
    	->delete();

    	$response = array();
        $response['status']  = 'success';
        $response['message'] = 'Listing has been removed from your favourite lists.';

        return json_encode($response);
    }


    public function booking(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'buyer_id' => ['required', 'int'],
            'email' => ['required', 'string', 'email'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'listing_id' => ['required', 'int']
            ])->validate();


        $booking = new Booking;

        $booking->user_id = $request->buyer_id;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->event_date = $request->event_date;
        $booking->description = $request->description;
        $booking->listing_id = $request->listing_id;
        $booking->book_status = "Pending";
        $booking->payment_status = "";

        $booking->save();

        Session::flash('status_message', 'Booking Request has been send to vendor Successfully');

        return redirect(url('/history'));
    }

    public function updateBooking(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'listing_id' => ['required', 'int']
            ])->validate();

        $booking = Booking::find($request->booking_id);

        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->event_date = $request->event_date;
        $booking->description = $request->description;

        $booking->save();

        Session::flash('status_message', 'Booking Request has been been updated Successfully');

        return redirect(url('/history'));

    }

    public function bookingConfirmationByVendor(Request $request){

        $booking = Booking::find($request->booking_id);

        $booking->book_status = $request->book_status;

        $booking->save();

        Session::flash('status_message', 'Booking Request comfirmation has been updated Successfully');

        return redirect(url('/history'));

    }

    public function history(){

        if (Auth::user()->user_type == "Vendor") {

            $bookings = Booking::select('bookings.*')
                            ->join('listings', 'bookings.listing_id', '=', 'listings.id')
                            ->where('listings.vendor_id', '=', Auth::user()->vendorDetails->id)
                            ->get();

            //dd($bookings);

            return view('booking-history')->with('bookings', $bookings);



        }elseif(Auth::user()->user_type == "Buyer"){
            $bookings = Booking::where('user_id', '=', Auth::user()->id)->get();
            return view('booking-history')->with('bookings', $bookings);
        }
        
    }

    
}
