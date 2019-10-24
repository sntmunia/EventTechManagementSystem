<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Vendor extends Model
{
    public $timestamps = false;

    public function loginInformation(){
        return $this->belongsTo('App\User', 'user_id');
    }


    public function listings()
    {
        return $this->hasMany('App\Listing');

    }

    public function rating(){

    	$relation = $this->hasMany('App\Listing');

    	 $relation->getQuery()
	        ->join('listing_reviews', 'listings.id', '=', 'listing_reviews.listing_id')
	        ->select(DB::raw('sum(listing_reviews.star) as totalStar'), DB::raw('count(listing_reviews.star) as totalPerson'))
	        ->groupBy('listing_reviews.listing_id');

    	return $relation;
    }


    public function minMaxPrice(){

    	$relation = $this->hasMany('App\Listing');

    	 $relation->getQuery()
	        ->select(DB::raw('min(listings.price) as minPrice'), DB::raw('max(listings.price) as maxPrice') );

    	return $relation;
    }


    public function isAddedToFablist(){

        $relation = $this->hasMany('App\Vendor_fav_list');

        $relation->getQuery()
            ->select('vendor_fav_lists.user_id')->where('vendor_fav_lists.user_id', '=', Auth::user()->id);

        return $relation;

    }
    
}
