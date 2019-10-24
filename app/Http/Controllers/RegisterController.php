<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use App\User;
use App\Buyer;
use App\Vendor;
use App\Vendor_categorie;
use App\Location;


class RegisterController extends Controller
{
    //


    public function signupBuyer()
    {

        return view('signup-buyer');
        //return view('auth.register');

    }

    public function signupVendor()
    {
		$vendor_categories = Vendor_categorie::all();
        $locations = Location::all();

        return view('signup-vendor')->with("vendor_categories", $vendor_categories)->with("locations", $locations);

    }
    public function createVendor(Request $request)
    {

        //validate all the fields
        Validator::make($request->all(), [
            'user_type' => ['required', 'string', 'max:10'],
            'vendor_categorie_id' => ['required', 'int'],
            'location_id' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

        $user = new User;

        $user->user_type = $request->user_type;
        $user->email = $request->email;
        $user->status = "Active";
        $user->password = Hash::make($request->password);

        $user->save(); 
		
		$vendor = new Vendor;
        $vendor->user_id = $user->id;
        $vendor->vendor_categorie_id = $request->vendor_categorie_id;
        $vendor->location_id = $request->location_id;
        $vendor->vendor_package_type = "Regular";
        $vendor->vendor_tittle = "";
        $vendor->address = "";
        $vendor->vendor_description = "";
        $vendor->phone = "";
        $vendor->profile_pic = "vendor-logo.jpg";
        $vendor->cover_pic = "video.jpg";
        $vendor->complete_profile = "";
		
		$vendor->save();

        Session::flash('status_message', 'Account has been created successfully. Please Login.');

        return redirect('/login');

    }

    public function createBuyer(Request $request)
    {

    	//validate all the fields
        Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ])->validate();

        $user = new User;

        $user->user_type = "Buyer";
        $user->email = $request->email;
        $user->status = "Active";
        $user->password = Hash::make($request->password);

        $user->save();

        $buyer = new Buyer;
        $buyer->user_id = $user->id;
        $buyer->name = $request->name;
        $buyer->event_date = $request->event_date;

        $buyer->save();

        Session::flash('status_message', 'Account has been created successfully. Please Login.');

        return redirect('/login');

    }
}
