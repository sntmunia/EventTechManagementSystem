<?php


//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pricing', 'HomeController@pricing');
Route::get('/about-us', 'HomeController@aboutUs');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/signup-buyer', 'RegisterController@signupBuyer');
Route::get('/signup-vendor', 'RegisterController@signupVendor');
Route::post('/create-vendor', 'RegisterController@createVendor');
Route::post('/create-buyer', 'RegisterController@createBuyer');


Route::get('/listing', 'VendorController@showAllList');
Route::get('/listing/{id}', 'VendorController@showListingDetails');
Route::post('/listing', 'VendorController@storeNewList');
Route::post('/listing/filter', 'VendorController@listingFilter'); 
Route::post('/listing/review/', 'VendorController@review');
Route::post('/images-upload', 'VendorController@imagesUpload');


Route::get('/vendors', 'VendorController@vendorLists');
Route::get('/vendor/{id}', 'VendorController@showVendor');
Route::post('/vendor/filter', 'VendorController@vendorFilter'); 
Route::post('/vendors/profile/update', 'VendorController@updateProfile'); 
Route::post('/vendors/profile-pic/update', 'VendorController@updatePicProfile'); 

Route::get('favourite/vendors', 'VendorController@favouriteVendorLists');
Route::get('favourite/listings', 'VendorController@favouriteListingLists');
Route::post('/user/favourite/vendor/add', 'UserController@addVendorToFav');
Route::post('/user/favourite/vendor/remove', 'UserController@removeVendorToFav');
Route::post('/user/favourite/listing/add', 'UserController@addListingToFav');
Route::post('/user/favourite/listing/remove', 'UserController@removeListingToFav');


Route::post('/booking', 'UserController@booking');
Route::post('/booking/update', 'UserController@updateBooking');
Route::post('/booking/confirmation', 'UserController@bookingConfirmationByVendor');
Route::get('/history', 'UserController@history');


//image upload
Route::get('image-view/{id}','ImageController@index');
Route::post('image-view','ImageController@store');


Route::get('admins','AdminController@dashboard');
Route::get('admin/vendor-cetegories','AdminController@vendorCategories');
Route::post('admin/add-new-categories','AdminController@addNewCategories');
Route::post('admin/update-categories','AdminController@updateCategories');

Route::get('admin/location','AdminController@location');
Route::post('admin/add-new-location','AdminController@addNewLocation');
Route::post('admin/update-location','AdminController@updateLocation');

Route::get('admin/vendors','AdminController@vendors');
Route::get('admin/buyers','AdminController@buyers');
Route::post('admin/update-vendor-vendor-status','AdminController@updateVendorUserStatus');
Route::post('admin/update-vendor-buyer-status','AdminController@updateBuyerUserStatus');


Route::get('payment/vendor/{id}','AdminController@paymentList');
Route::get('payment-list/vendor/{id}','PaymentController@paymentList');
Route::post('payment/update','AdminController@payment');

Route::post('subscription-package/update','AdminController@updatePackage');

Route::post('stripe', 'PaymentController@stripePost')->name('stripe.post');

