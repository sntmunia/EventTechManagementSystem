<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Vendor_categorie;
use App\Vendor;
use App\Listing;
use App\Listing_review;
use App\Listing_image;
use Auth;
use Storage;
use File;
use DB;
use Validator;
use Session;

class VendorController extends Controller
{
    //
    public function vendorLists()
    {
        $vendors = Vendor::all();

    	$locations = Location::all();
    	$vendor_categories = Vendor_categorie::all();

        return view('vendor')->with('vendors', $vendors)->with('locations', $locations)->with('vendor_categories', $vendor_categories);

    }

    public function favouriteVendorLists()
    {
        $vendors = Vendor::select('vendors.*')
                    ->where('vendor_fav_lists.user_id', '=', Auth::user()->id)
                    ->join('vendor_fav_lists', 'vendor_fav_lists.vendor_id', '=', 'vendors.id')
                    ->get();

        $locations = Location::all();
        $vendor_categories = Vendor_categorie::all();

        //dd($vendors);
        
        return view('vendor')->with('vendors', $vendors)->with('locations', $locations)->with('vendor_categories', $vendor_categories);

    }


    public function vendorFilter(Request $request)
    {
             //validate all the fields
            Validator::make($request->all(), [
                'vendor_categorie_id' => ['required', 'int'],
                'location_id' => ['required', 'int'],
                ])->validate();

            $locations = Location::all();
            $vendor_categories = Vendor_categorie::all();


            if ($request->star) {

            }else{
                if ($request->vendor_categorie_id == "" && $request->location_id == "") {
                    $vendors = Vendor::all();
                }elseif ($request->vendor_categorie_id == "") {
                    $vendors = Vendor::where('location_id', '=', $request->location_id)
                                    ->get();
                }elseif($request->location_id == ""){
                    $vendors = Vendor::where('vendor_categorie_id', '=', $request->vendor_categorie_id)
                                    ->get();
                }else{
                    $vendors = Vendor::where('vendor_categorie_id', '=', $request->vendor_categorie_id)
                                    ->where('location_id', '=', $request->location_id)
                                    ->get();
                }
            }


        return view('vendor')
                ->with('vendors', $vendors)
                ->with('locations', $locations)
                ->with('vendor_categories', $vendor_categories)
                ->with('vendor_categorie_id', $request->vendor_categorie_id)
                ->with('location_id', $request->location_id);

    }

    public function showVendor($id){

        $vendor = Vendor::find($id);
            
        return view('vendor-home')->with('vendorProfile', $vendor);

    }


    public function updateProfile(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'phone' => ['required', 'string'],
            ])->validate();

    	$vendor = Vendor::where('user_id', '=', Auth::user()->id)
				          ->update(['vendor_tittle' => $request->title, 
				          			'address' => $request->address, 
				          			'vendor_description' => $request->description, 
				          			'phone' => $request->phone]);

        Session::flash('status_message', 'Profile Updated Successfully.');


		return back();

    }

    public function updatePicProfile(Request $request){


    	if ($request->profile_pic && $request->cover_pic) {
    		
    		$profilePhoto = $request->file('profile_pic');
    		$coverPhoto = $request->file('profile_pic');
        	$paths  = [];

            $profileExtension = $profilePhoto->getClientOriginalExtension();
            $coverExtension = $coverPhoto->getClientOriginalExtension();
            $profileFilename  = 'img_profile_userid_' . Auth::user()->id . '.' . $profileExtension;
            $coverFilename  = 'img_coverpic_userid_' . Auth::user()->id . '.' . $coverExtension;

            $paths[]   = $profilePhoto->storeAs('image', $profileFilename);
            $paths[]   = $coverPhoto->storeAs('image', $coverExtension);

            $paths[] = Storage::disk('uploaded_images')->put($profileFilename, file_get_contents($profilePhoto));
            $paths[] = Storage::disk('uploaded_images')->put($coverExtension, file_get_contents($coverPhoto));

            Vendor::where('user_id', '=', Auth::user()->id)
		          ->update(['profile_pic' => $profileFilename, 
		          			'cover_pic' => $coverFilename]);

            Session::flash('status_message', 'Profile and cover pic updated Successfully');


    	}elseif ($request->profile_pic) {

    		$photo = $request->file('profile_pic');
        	$paths  = [];

            $extension = $photo->getClientOriginalExtension();
            $filename  = 'img_profile_userid_' . Auth::user()->id . '.' . $extension;
            $paths[]   = $photo->storeAs('image', $filename);

            $paths[] = Storage::disk('uploaded_images')->put($filename, file_get_contents($photo));

            Vendor::where('user_id', '=', Auth::user()->id)
				          ->update(['profile_pic' => $filename]);

            Session::flash('status_message', 'Profile pic updated Successfully');


    	} else if($request->cover_pic){

    		$photo = $request->file('cover_pic');
        	$paths  = [];

            $extension = $photo->getClientOriginalExtension();
            $filename  = 'img_coverpic_userid_' . Auth::user()->id . '.' . $extension;
            $paths[]   = $photo->storeAs('image', $filename);

            $paths[] = Storage::disk('uploaded_images')->put($filename, file_get_contents($photo));

            Vendor::where('user_id', '=', Auth::user()->id)
				          ->update(['cover_pic' => $filename]);

            Session::flash('status_message', 'Cover pic updated Successfully');
    	}


		          
		 return back();

    }

    public function showAllList(){
        
        $listings = Listing::select('listings.*', DB::raw('sum(listing_reviews.star) as totalStar'), 
                                    DB::raw('count(listing_reviews.star) as totalPerson'))
                        ->leftJoin('listing_reviews', 'listings.id', '=', 'listing_reviews.listing_id')
                        ->groupBy('listings.id')
                        ->get();

        $locations = Location::all();
        $vendor_categories = Vendor_categorie::all();

        return view('listing')->with('listings', $listings)->with('locations', $locations)->with('vendor_categories', $vendor_categories);
    }

    public function favouriteListingLists(){

        $locations = Location::all();
        $vendor_categories = Vendor_categorie::all();

        $listings = Listing::select('listings.*')
                    ->where('listing_fav_lists.user_id', '=', Auth::user()->id)
                    ->join('listing_fav_lists', 'listing_fav_lists.listing_id', '=', 'listings.id')
                    ->get();

        return view('listing')->with('listings', $listings)->with('locations', $locations)->with('vendor_categories', $vendor_categories);
    }

    public function listingFilter(Request $request){

        $locations = Location::all();
        $vendor_categories = Vendor_categorie::all();

        if($request->vendor_categorie_id == "" && $request->location_id == "" && $request->price == ""){
            $listings = Listing::all();

        }elseif($request->location_id == "" && $request->price == ""){
            $listings = Listing::select('listings.*')
                        ->where('vendors.vendor_categorie_id', '=', $request->vendor_categorie_id)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();

        }elseif($request->vendor_categorie_id == "" && $request->price == ""){
            $listings = Listing::select('listings.*')
                        ->where('vendors.location_id', '=', $request->location_id)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();

        }elseif($request->vendor_categorie_id == "" && $request->location_id == ""){
            $listings = Listing::select('listings.*')
                        ->where('listings.price', '<=', $request->price)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();

        }elseif($request->vendor_categorie_id == ""){
            $listings = Listing::select('listings.*')
                        ->where('vendors.location_id', '=', $request->location_id)
                        ->where('listings.price', '<=', $request->price)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();

        }elseif($request->location_id == ""){
            $listings = Listing::select('listings.*')
                        ->where('vendors.vendor_categorie_id', '=', $request->vendor_categorie_id)
                        ->where('listings.price', '<=', $request->price)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();

        }elseif($request->price == ""){
            $listings = Listing::select('listings.*')
                        ->where('vendors.vendor_categorie_id', '=', $request->vendor_categorie_id)
                        ->where('vendors.location_id', '=', $request->location_id)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();

        }else{
            $listings = Listing::select('listings.*')
                        ->where('vendors.vendor_categorie_id', '=', $request->vendor_categorie_id)
                        ->where('vendors.location_id', '=', $request->location_id)
                        ->where('listings.price', '<=', $request->price)
                        ->join('vendors', 'vendors.id', '=', 'listings.vendor_id')
                        ->get();
        }


        return view('listing')
                ->with('listings', $listings)
                ->with('locations', $locations)
                ->with('vendor_categories', $vendor_categories)
                ->with('vendor_categorie_id', $request->vendor_categorie_id)
                ->with('location_id', $request->location_id)
                ->with('price', $request->price);
    }


    public function showListingDetails($id){

        $listing = Listing::select('listings.*', DB::raw('sum(listing_reviews.star) as totalStar'), 
                                    DB::raw('count(listing_reviews.star) as totalPerson'))
                            ->leftJoin('listing_reviews', 'listings.id', '=', 'listing_reviews.listing_id')
                            ->where('listings.id', '=', $id)
                            ->groupBy('listings.id')
                            ->get();
        $listing_images = Listing_image::where('listing_id', '=', $id)->get();
        $listinReviews = Listing_review::where('listing_id', '=', $id)->get(); 

        //dd($listing);

    	return view('list-details')->with('listing', $listing[0])->with('listing_images', $listing_images)->with('listinReviews', $listinReviews);

    }

    public function storeNewList(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'price' => ['required', 'int'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string']
            ])->validate();

    	$photo = $request->file('img');
    	$paths  = [];

        $extension = $photo->getClientOriginalExtension();
        $filename  = 'img_listing_' . uniqid() . '.' . $extension;
        $paths[]   = $photo->storeAs('image', $filename);

        $paths[] = Storage::disk('uploaded_images')->put($filename, file_get_contents($photo));


    	$listing = new Listing;

    	$listing->vendor_id = Auth::user()->vendorDetails->id;
    	$listing->title = $request->title;
    	$listing->price = $request->price; 
    	$listing->location = $request->location;
    	$listing->description = $request->description;
    	$listing->img = $filename;

    	$listing->save();


    	echo "Successfull";


        Session::flash('status_message', 'New List has been post Successfully');

    	return back();

    }

   public function review(Request $request){

        //validate all the fields
        Validator::make($request->all(), [
            'listing_id' => ['required', 'int'],
            'title' => ['required', 'string'],
            'comment' => ['required', 'string'],
            'star' => ['required', 'int']
            ])->validate();

        $listingReview = new Listing_review();

        $listingReview->listing_id = $request->listing_id;
        $listingReview->title = $request->title;
        $listingReview->comment = $request->comment;
        $listingReview->star = $request->star;

        $listingReview->save();

        Session::flash('status_message', 'Review has been post Successfully');

        return redirect('/listing/'.$request->listing_id);
   }

}
