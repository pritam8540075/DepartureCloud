<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/newtext', function () {
    return view('departure.text');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/start_from_destination', 'Departure\DepartureController@startFromDestination')->name('start_from');
Auth::routes(['verify' => true]);
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index')->name('home');
	//Departure Routes
	Route::get('/my/departures', 'Departure\DepartureController@departureIndex')->name('departure');
	Route::get('/departure/basic-detail/create', 'Departure\DepartureController@departureCreate')->name('departure_create');
	Route::get('/departure/basic-detail/edit/{id}', 'Departure\DepartureController@departureEdit')->name('departure_edit');
	Route::post('/departure/basic-detail/store', 'Departure\DepartureController@departureStore')->name('departure_store');
	Route::post('/departure/basic-detail/update/{id}', 'Departure\DepartureController@departureUpdate')->name('departure_update');
	Route::post('/departure-disable/{id}', 'Departure\DepartureController@departureDisable')->name('departure_disable');
	Route::get('/departure/details/{id}', 'Departure\DepartureController@details')->name('departure_details');
	Route::post('/departure/hold/update', 'Departure\DepartureController@holdDurationUpdate')->name('departure_holdduration');
	Route::post('/departure/book/seat', 'Departure\DepartureController@bookSeat')->name('departure_book');
    Route::get('/departures', 'Departure\DepartureController@allDeparture')->name('all_departure');
	Route::get('/my/booking', 'Departure\DepartureController@myBooked')->name('my_booking');
	Route::post('/hold/departure/release/{id}', 'Departure\DepartureController@release');
	Route::get('/forcehold/departure/release/{id}', 'Departure\DepartureController@ForceRelease');
	Route::get('/all/departure/details/{id}', 'Departure\DepartureController@AllDepartureDetails')->name('all_departure_details');
	
	Route::get('/booking/history','Departure\DepartureController@BookingHistory')->name('booking_history');
    
	//buyer and supplier
	Route::get('/all/user/','Departure\DepartureController@UserList')->name('user_list');
    Route::post('/user-type-change/{id}', 'Departure\DepartureController@UserTypeChange')->name('user_update');
	Route::get('/all/suplier/','Departure\DepartureController@SupplierList')->name('suplier_list');
	Route::post('/user-status-change/{id}', 'Departure\DepartureController@UserStatusChange')->name('user_status');

	Route::get('/hold/history','Departure\DepartureController@HoldHistory')->name('hold_history');
    //departure approved
	Route::post('/departure-approve/{id}', 'Departure\DepartureController@departureApprove')->name('departure_approve');
	//Start From and To  Airlins Routes
	
	Route::get('/departure_airline', 'Departure\DepartureController@departureAirline')->name('departure_airline');
	Route::get('/departure_airline_return', 'Departure\DepartureController@departureAirline')->name('departure_airline_return');

	//departure search by destination 
    Route::get('/departure_destination_search', 'Departure\DepartureController@DepartureDestinationSearch');
    // departure approved
	Route::get('/departure_approved', 'Departure\DepartureController@ApprovedDeparture')->name('unapproved_departure');
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Route::get('/departure/inclusion/{id}', 'Departure\InclusionController@inclusionIndex')->name('inclusion');
	Route::post('/departure/inclusion/store/{id}', 'Departure\InclusionController@storeInclusion')->name('inclusion_store');
	Route::post('/departure/inclusion/update/{id}', 'Departure\InclusionController@updateInclusion')->name('inclusion_update');
	
	//inactive departure
	Route::get('/departure/inacitve','Departure\DepartureController@inactiveDeparture')->name('inactive_depature');
	
	//role route
    Route::get('/departure/role/create','RoleController@index')->name('role');
	Route::post('/departure/role/save','RoleController@create')->name('role_create');
	Route::get('/departure/user/create','RoleController@user')->name('user');
	Route::post('/departure/user/save','RoleController@UserCreate')->name('user_create');
	Route::post('/departure/user/disable/{id}','RoleController@disable')->name('user_disable');
	Route::post('/departure/user/role/permission','RoleController@PermissionAllow')->name('role_permission');
	Route::post('/departure/user/role/permission','RoleController@PermissionAllow')->name('role_permission');

	//Ititberary PDF
	Route::get('/pdf-itinerary/create/{id}', 'Departure\ItineraryPdfController@pdfItinerayCreate')->name('pdf_itinerary');
	Route::post('/pdf-itinerary/store/{id}', 'Departure\ItineraryPdfController@pdfItinerayStore')->name('pdf_itinerary_store');
	Route::post('/pdf-itinerary/update/{id}', 'Departure\ItineraryPdfController@pdfItinerayUpdate')->name('pdf_itinerary_update');

	
	//Terms of Payment
	Route::get('/terms/payment/create/{id}', 'Departure\TermsPayementController@TermsPaymentCreate')->name('terms_payment');
	Route::post('/terms/payment/store/{id}', 'Departure\TermsPayementController@TermsPayemntStore')->name('terms_payment_store');
	Route::post('/terms/payment/update/{id}', 'Departure\TermsPayementController@TermsPaymentUpdate')->name('terms_payment_update');
    //currency converion
	Route::get('/currency/converion', 'Departure\TermsPayementController@currencyConverion')->name('currency_converion');
	Route::post('/currency/converion/update', 'Departure\TermsPayementController@currencyConverionUpdate')->name('currency_converion_update');
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	Route::get('/departure/itinerary/create/{id}', 'Departure\ItineraryController@itineraryIndex')->name('itinerary_create');
	Route::post('/departure/itinerary/store/{id}', 'Departure\ItineraryController@itineraryStore')->name('itinerary_store');
	Route::post('/departure/itinerary/update/{id}', 'Departure\ItineraryController@itineraryUpdate')->name('itinerary_update');
	Route::get('get-itinerary-destination-pois-ajax', 'Departure\ItineraryController@getDestinationPoiAjax');

	Route::post('/itinerary-disable/{id}', 'Departure\ItineraryController@itinerayDisable')->name('itinerary_disable');

	Route::get('/agent-itinerary', 'AgentItineraryController@agentItinerayIndex')->name('agent_itinerary_index');
	Route::get('/agent-itinerary/create', 'AgentItineraryController@agentItinerayCreate')->name('agent_itinerary');
	Route::post('/agent-itinerary/store', 'AgentItineraryController@agentItinerayStore')->name('agent_itinerary_store');
	Route::get('/agent-itinerary/edit/{id}', 'AgentItineraryController@agentItinerayEdit')->name('agent_itinerary_edit');
	Route::post('/agent-itinerary/update/{id}', 'AgentItineraryController@agentItinerayUpdate')->name('agent_itinerary_update');
	Route::post('/agent-itinerary-disable/{id}', 'AgentItineraryController@agentItineraryDestroy')->name('agent_iti_disable');

	//Pricing Module Routes
	Route::get('/get_pricing_ajax', 'Departure\DepartureController@getPricingAjax')->name('get_pricing_ajax');
    Route::post('/departure/price_update', 'PricingModuleController@updatePriceModal')->name('price_update');
	//Book section
	Route::get('/book/details','BookController@index')->name('book');
	Route::post('/book/seat','BookController@store')->name('store');
	Route::post('/book/hold','BookController@hold')->name('hold');

    //departure Booking History
	Route::get('/departure/booking/history/{id}','Departure\DepartureController@DepartureBookingHistory')->name('departure_booking_history');
	Route::get('/all/departure/booking/history','Departure\DepartureController@AllDepartureBookingHistory')->name('all_departure_booking_history');
	Route::get('/departure/booking/history/details/{id}','Departure\DepartureController@BookingHistoryDetails')->name('departure_booking_history_details');

	//departure hold history
	Route::get('/all/departure/hold/history','Departure\DepartureController@AllDepartureHoldHistory')->name('all_departure_hold_history');
    Route::get('/departure/hold/history/details/{id}','Departure\DepartureController@HoldHistoryDetails')->name('departure_hold_history_details');
	//user profile
	Route::get('/my/profile','ProfileController@UserProfile')->name('profile');
	Route::get('/my/profile/edit','ProfileController@UserEdit')->name('edit_profile');
	Route::post('/my/profile/update','ProfileController@UserProfileUpdate')->name('update_prifile');
	
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/book','BookController@index')->name('booking_section');
