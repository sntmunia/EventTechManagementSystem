<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing_image;

class ImageController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    	return view('upload-listing-image')->with('listID', $id);
    }


    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$extension = request()->file->getClientOriginalExtension();
        $filename  = 'img_listing_' . uniqid() . '.' . $extension;

        request()->file->move(public_path('images'), $filename);

        $isting_image = new Listing_image();

        $isting_image->listing_id = $request->listing_id;
        $isting_image->img = $filename;

        $isting_image->save();


    	return response()->json(['uploaded' => '/images/'.$filename]);
    }
}
