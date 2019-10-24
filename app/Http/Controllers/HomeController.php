<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor_categorie;
use App\Location;
use App\Vendor;
use App\Listing;
use App\Plan;
use Auth;
use DB;
use Validator;
use Session;

class HomeController extends Controller
{
    
    public function index()
    {
        if (Auth::user()) {
            if(Auth::user()->user_type == "Vendor"){

                $vendor = Vendor::where('user_id', '=', Auth::user()->id)->get();;
               return view('vendor-home')->with('vendorProfile', $vendor[0]);

            }elseif(Auth::user()->user_type == "Admin"){
                return redirect(url('/admins'));

            }elseif(Auth::user()->user_type == "Buyer"){
                
                $vendor_categories = Vendor_categorie::all();
                $locations = Location::all();

                $listings = Listing::select('listings.*')
                            ->join('vendors', 'listings.vendor_id', 'vendors.id')
                            ->where('vendors.vendor_package_type', '=', 'Premium')
                            ->get();


                return view('home')->with("vendor_categories", $vendor_categories)->with("locations", $locations)->with('listings', $listings);
            }
        }else{

            $listings = Listing::select('listings.*', DB::raw('sum(listing_reviews.star) as totalStar'), 
                                    DB::raw('count(listing_reviews.star) as totalPerson'))
                            ->join('vendors', 'listings.vendor_id', 'vendors.id')
                            ->groupBy('listings.id')
                            ->leftJoin('listing_reviews', 'listings.id', '=', 'listing_reviews.listing_id')
                            ->where('vendors.vendor_package_type', '=', 'Premium')
                            ->get();


            //dd( $listings);

            $vendor_categories = Vendor_categorie::all();
            $locations = Location::all();
            return view('home')->with("vendor_categories", $vendor_categories)->with("locations", $locations)->with('listings', $listings);
        }
    }

    public function pricing(){
        
        return view('pricing');
    }

    public function aboutUs(){
        return view('about-us');
    }

}
