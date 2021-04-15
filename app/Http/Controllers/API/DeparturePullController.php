<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Departure;
use App\Destination;
use App\Country;
use App\DepartureDestination;

class DeparturePullController extends Controller
{
    public function countryRelatedDeparture(Request $request){

      $country_name = $request->country;
      $company = $request->company_name;
      $user_tenant = User::where('company_name',$company)->value('tenant_id');

      	$departures = DB::table('countries')
	      			->join('destinations','destinations.country_id','=','countries.id')
	      			->join('departure_destinations','departure_destinations.destination_id','=','destinations.id')
	                ->join('departures','departures.id','=','departure_destinations.departure_id')
	                ->where('countries.country_name',$country_name)
	                ->where('departures.tenant_id', $user_tenant)
	                ->distinct()
	                ->select('departures.*')
	                ->get();
            if(count($departures) > 0){
            	$country_departure = [];
            	foreach ($departures as $key => $dep) {
          			$dest_row = DB::table('departure_destinations')
          						->where('departure_id',$dep->id)
					        	->pluck('destination_id')
					        	->toArray();
					$destname_name = array();
					
		            foreach ($dest_row as $key => $value) {
		                $desti_name = Destination::join('countries','countries.id','=','destinations.country_id')
		                			->where('destinations.id', $value)
		                			->distinct()
		                			->select('destinations.id as dest_id','destinations.dest_name','countries.id as count_id','countries.country_name')
		                			->first();
		                if($desti_name){
		                	array_push($destname_name, $desti_name);
		                }
		            }
		            $dep->destinations = $destname_name;

		            // Itinerary Pdf

		            $itinerary_id = DB::table('agent_itineraries')
		            			->where('departure_id',$dep->id)
		            			->where('tenant_id',$user_tenant)
					        	->value('id');
	                $itinerary = DB::table('agent_itineraries')
	                			->where('departure_id',$dep->id)
		            			->where('tenant_id',$user_tenant)
	                			->select('id','title','description','pdf_file','tenant_id','dep_type','unique_key')
	                			->first();
		            $dep->itineraries = $itinerary;

		            //Pricing
		            $price_row = DB::table('prices')
		            			->where('departure_id',$dep->id)
		            			->where('price_type_id', 2)
					        	->select('price_type_id','price_inr','price_usd')
					        	->get();
		            
		            $dep->prices = $price_row;
		            
		            //Inclusions
		            $inclu_row = DB::table('inclusions')
		            			->where('departure_id',$dep->id)
		            			->where('tenant_id',$user_tenant)
					        	->pluck('id')->toArray();
		            $inclusion = array();
		            foreach ($inclu_row as $key => $value) {
		                $inclu = DB::table('inclusions')->join('departures','departures.id','=','inclusions.departure_id')
		                			->where('inclusions.id', $value)
		                			->where('inclusions.tenant_id',$user_tenant)
		                			->select('inclusions.name','inclusions.description','inclusions.tenant_id','inclusions.dep_type')
		                			->first();
		                if($inclu){
		                 array_push($inclusion, $inclu);
		                }
		            }
		            $dep->inclusions = $inclusion;
		            
		        array_push($country_departure, $dep);
          		}
          	}
          	// echo "<pre>";
          	// print_r($departures);
          	// exit;
        return response()->json(['data' => $country_departure], 200);
    }
}
