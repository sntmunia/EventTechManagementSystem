<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;


class Listing extends Model
{
    public $timestamps = false; 


    public function list_images(){
    	return $this->hasMany('App\Listing_image', 'id', 'listing_id');
    }

    public function rating(){

    	$relation = $this->hasMany('App\Listing_review');

    	 $relation->getQuery()
	        ->select(DB::raw('sum(listing_reviews.star) as totalStar'), DB::raw('count(listing_reviews.id) as totalPerson') );

    	return $relation;
    }


    public function isAddedToFablist(){

        $relation = $this->hasMany('App\Listing_fav_list');

        $relation->getQuery()
            ->select('listing_fav_lists.user_id')->where('listing_fav_lists.user_id', '=', Auth::user()->id);

        return $relation;

    }

}
