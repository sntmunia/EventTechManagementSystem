<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Vendor_categorie;
use App\Vendor;
use App\User;
use App\Payment;
use Auth;
use File;
use DB;
use Validator;
use Session;

class AdminController extends Controller
{


    public function dashboard(){

    	if (Auth::user()) {

    		if (Auth::user()->user_type == "Admin") {
                $vendors = DB::table('users')
                         ->select(DB::raw('count(id) as totalVendor'))
                         ->where('users.user_type', '=', 'Vendor')
                         ->get();

                $buyers = DB::table('users')
                         ->select(DB::raw('count(id) as totalBuyer'))
                         ->where('users.user_type', '=', 'Buyer')
                         ->get();


                $payments = DB::table('payments')
                         ->select(DB::raw('sum(amount) as amount, month'))
                         ->groupBy('month')
                         ->orderBy('id', 'desc')
                         ->where('payments.status', '=', 'Success')
                         ->get();

                $mothlyAvarage = DB::table('payments')
                         ->select(DB::raw('AVG(amount) as amount'))
                         ->groupBy('year')
                         ->where('payments.status', '=', 'Success')
                         ->get();

                $totalAnaual = DB::table('payments')
                         ->select(DB::raw('sum(amount) as amount'))
                         ->groupBy('year')
                         ->where('payments.status', '=', 'Success')
                         ->get();

                $activeUser = DB::table('users')
                                 ->select(DB::raw('count(id) as total'))
                                 ->where('users.status', '=', 'Active')
                                 ->get();

                $inactiveUser = DB::table('users')
                                 ->select(DB::raw('count(id) as total'))
                                 ->where('users.status', '=', 'Inactive')
                                 ->get();

                //dd($inactiveUser[0]->total);


    			return view('admin.dashboard')
                            ->with('payments', $payments)
                            ->with('mothlyAvarage', $mothlyAvarage[0]->amount)
                            ->with('totalAnaual', $totalAnaual[0]->amount)
                            ->with('activeUser', $activeUser[0]->total)
                            ->with('inactiveUser', $inactiveUser[0]->total)
                            ->with('totalVendor', $vendors[0]->totalVendor)
                            ->with('totalBuyer', $buyers[0]->totalBuyer);

    		}else{
    			return redirect(url('/home'));
    		}

    	}else{
    		return redirect(url('/login'));
    	}
        
    }

    public function vendorCategories(){

    	if (Auth::user()) {

    		if (Auth::user()->user_type == "Admin") {
    			$vendor_categories = Vendor_categorie::all();

        		return view('admin.categories')->with('vendor_categories', $vendor_categories);
    		}else{
    			return redirect(url('/home'));
    		}

    	}else{
    		return redirect(url('/login'));
    	}

    }

    public function location(){

    	if (Auth::user()) {

    		if (Auth::user()->user_type == "Admin") {
    			$locations = Location::all();

        		return view('admin.location')->with('locations', $locations);
    		}else{
    			return redirect(url('/home'));
    		}

    	}else{
    		return redirect(url('/login'));
    	}
    	
    }

    public function addNewCategories(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'name' => ['required', 'string']
            ])->validate();


    	$vendor_categorie = new Vendor_categorie;

    	$vendor_categorie->name = $request->name;
    	$vendor_categorie->save();

        Session::flash('status_message', 'New categories has been post Successfully');
        
        
        return redirect(url('admin/vendor-cetegories'));
    }

    public function updateCategories(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'name' => ['required', 'string']
            ])->validate();

    	$vendor_categorie = Vendor_categorie::find($request->categoreis_id);

    	$vendor_categorie->name = $request->name;
    	$vendor_categorie->save();

        Session::flash('status_message', 'Updated Successfully done');
        
        return redirect(url('admin/vendor-cetegories'));
    }

    public function addNewLocation(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'name' => ['required', 'string']
            ])->validate();

    	$location = new Location;

    	$location->name = $request->name;
    	$location->save();

        Session::flash('status_message', 'New location has been post Successfully');
        
        return redirect(url('admin/location'));
    }

    public function updateLocation(Request $request){
        //validate all the fields
        Validator::make($request->all(), [
            'name' => ['required', 'string']
            ])->validate();

    	$location = Location::find($request->location_id);

    	$location->name = $request->name;
    	$location->save();

        Session::flash('status_message', 'Updated Successfully done');
        
        return redirect(url('admin/location'));
    }


    public function vendors(){

    	if (Auth::user()) {

    		if (Auth::user()->user_type == "Admin") {
    			$users = User::where('user_type', '=', 'Vendor')->get();
        		return view('admin.vendors')->with('users', $users);
    		}else{
    			return redirect(url('/home'));
    		}

    	}else{
    		return redirect(url('/login'));
    	}
    	
    }

    public function buyers(){

    	if (Auth::user()) {

    		if (Auth::user()->user_type == "Admin") {
    			$users = User::where('user_type', '=', 'Buyer')->get();
        		return view('admin.buyers')->with('users', $users);
    		}else{
    			return redirect(url('/home'));
    		}

    	}else{
    		return redirect(url('/login'));
    	}
    	
    }

    public function updateVendorUserStatus(Request $request){

    	$user = User::find($request->user_id);

    	$user->status = $request->status;
    	$user->save();

        Session::flash('status_message', 'Status has been updated Successfully');
        
        return redirect(url('admin/vendors'));
    }

    public function updateBuyerUserStatus(Request $request){
    	$user = User::find($request->user_id);

    	$user->status = $request->status;
    	$user->save();

        Session::flash('status_message', 'Status has been updated Successfully');
        
        return redirect(url('admin/buyers'));
    }



    public function paymentList($id){
        
        $payments = Payment::where('vendor_id', '=', $id)->orderBy('id', 'desc')->get();

        //dd($payments);
        
        return view('admin/vendor-payment-list')->with('payments', $payments)->with('vendor_id', $id);
    }

    public function payment(Request $request){
        
        $payment = Payment::find($request->payment_id);

        $payment->month = $request->month;
        $payment->year = $request->year;
        $payment->status = $request->status;

        $payment->save();

        if ($request->status == "Success") {
            if ($payment->status == "Success") {
                $vendor = Vendor::find($request->vendor_id);

                $vendor->vendor_package_type = "Premium";
                $vendor->save();

            }else{
                $vendor->vendor_package_type = "Regular";
                $vendor->save();
            }
        }

        Session::flash('status_message', 'Paymetn has been updated Successfully');
        
        return redirect(url('payment/vendor/'.$request->vendor_id));
    }


    public function updatePackage(Request $request){

        //dd($request->vendor_id);

        $vendor = Vendor::find($request->vendor_id);

        $vendor->vendor_package_type = $request->package;
        $vendor->save();
        Session::flash('status_message', 'Vendor Subscription package has been updated Successfully.');

        return redirect(url('admin/vendors'));


    }
}
