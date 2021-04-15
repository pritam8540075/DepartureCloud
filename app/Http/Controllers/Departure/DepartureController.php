<?php

namespace App\Http\Controllers\Departure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Intervention\Image\ImageServiceProvider;
use DB;
use Storage;
use Image;
use Auth;
use App\User;
use App\Departure;
use App\Destination;
use App\Country;
use App\DepartureDestination;
use App\Price;
use App\CountryDeparture;
use App\AllAirline;
use App\HotelCategory;
use App\AllDestination;
use App\HoldDeparture;
use App\HoldTill;
use App\HoldDuration;
use App\HoldDepartureSeat;
use App\BookDeparture;
use App\Itinerary;
use App\CurrencyConversion;
use Mail;

class DepartureController extends Controller
{ 
    public function departureIndex(Request $request)
    {
        //$permission = User::getPermissions();
        
        $from_date = $request->from;
        $from = date("yy-m-d", strtotime($from_date));
        $to_date = $request->to;
        $to = date("yy-m-d", strtotime($to_date));
        $date = date("Y-m-d");
        
        if($request->from){
            $departures = Departure::where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->whereBetween('start_date',[$from, $to])
                        ->orderBy('id', 'DESC')
                        ->get();
        }else{
            $departures = Departure::where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->orderBy('start_date', 'ASC')
                        ->orderBy('id', 'DESC')
                        ->get();
        }
        //$hold_array=[];
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
             $hold = HoldDepartureSeat::where('departure_id',$value->id) 
                        ->sum('hold_seat');
                if($hold){
                    $value->hold_sum = $hold;
                }
                else{
                    $value->hold_sum = 0;
                }
            }
        }
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
               $book = BookDeparture::where('departure_id',$value->id) 
                        ->sum('booked_seat');
               $single_book = BookDeparture::where('departure_id',$value->id) 
                            ->sum('single_supplement_booked_seat');
                $book_date = DB::table('book_departures')
                            ->join('users','book_departures.user_id','users.id')
                            ->select('book_departures.*','users.company_name')
                            ->where('departure_id',$value->id)->get();
                $value->book_date = $book_date;
                if($book){
                    $value->book_sum = $book;
                }
                else{
                    $value->book_sum = 0;
                }
                if($single_book){
                    $value->single_book_sum = $single_book;
                }
                else{
                    $value->single_book_sum = 0;
                }
               // return $value->book_sum + $value->single_book_sum;

               $hold_till = DB::table('hold_departures')->where('departure_id',$value->id)->get();
            if(count($hold_till)>0){
            foreach($hold_till as $row){
              if($row->departure_id == $value->id){
              $hold = $row->hold_till;
              }
             }
                }else{
                    $hold = 0;
                }

                $today = date("Y-m-d");
                $date1=date_create($today);
                $date2=date_create($value->start_date);
                $diff=date_diff($date1,$date2);
                $date = $diff->format("%R%a");

                if(($hold < $date) && ($value->available_seat > 0)){
                    $popup = '.bd-example-modal-sm';
                }
                else{
                    $popup = 0;
                }
                
            }
        }
        foreach($departures as $row){
            $departure_destination = DB::table('departure_destinations')
            ->join('destinations','departure_destinations.destination_id','destinations.id')
            ->select('destinations.country_name','destinations.dest_name')
            ->where('departure_destinations.departure_id',$row->id)
            ->get();
            $row->destination = $departure_destination;
           }  
       
        $holdduration = HoldDuration::all(); 
        $departureCount = Departure::where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->where('user_id',Auth::user()->id)
                        ->get();
        $total = count($departureCount);
        $active_departureCount = Departure::where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->whereDate('start_date', '>=', $date)
                        ->where('approve',1)
                        ->get();
        $active = count($active_departureCount);
        $pending_departureCount = Departure::where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->whereDate('start_date', '>=', $date)
                        ->where('approve',0)
                        ->get();
        $pending = count($pending_departureCount);
        $inactive_departureCount = Departure::where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->whereDate('start_date', '<=', $date)
                        ->where('approve',1)
                        ->get();
        $inactive = count($inactive_departureCount);
    
        
         if($request->ajax()){
            return view('departure.departure_index_data',compact('departures','to_date','from_date','holdduration'));
       }
        return view('departure.departure_index',compact('departures','total','to_date','from_date','holdduration','pending','inactive','active','popup','hold','date'));
    }

    public function allDeparture(Request $request){
        $from_date = $request->from;
        $to_date = $request->to;
        $date = date("Y-m-d");
        $from = $request->departure_from;
        $to = $request->departure_to;
        $status_filter =$request->status;
     
        if(($from_date && $to_date && $from && $to)){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->Where('from',$request->departure_from)
                        ->Where('ending_at',$request->departure_to)
                        ->WhereBetween('start_date',[$from_date, $to_date])
                        //->where('available_seat','>',$status_filter)
                        ->orderBy('id', 'DESC')
                        ->get();         
           }
        elseif($from && $to){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->Where('from',$request->departure_from)
                        ->Where('ending_at',$request->departure_to)
                        ->orderBy('id', 'DESC')
                        ->get();         
           }
           elseif($from){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->Where('from',$request->departure_from)
                        ->where('available_seat','!=',0)
                        ->orderBy('id', 'ASC')
                        ->get();         
           }
           elseif($to){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->Where('ending_at',$request->departure_to)
                        ->where('available_seat','!=',0)
                        ->orderBy('id', 'DESC')
                        ->get();         
           }
           elseif(($from_date && $to_date)){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->WhereBetween('start_date',[$from_date, $to_date])
                        ->orderBy('id', 'DESC')
                        ->get();         
           }
           elseif(($from_date)){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->Where('start_date',$from_date)
                        ->orderBy('id', 'DESC')
                        ->get();         
           }
           elseif(($to_date)){
            $departures = Departure::where('status',1)
                        ->where('approve',1)
                        ->whereDate('start_date', '>=', $date)
                        ->WhereBetween('start_date',$to_date)
                        ->orderBy('id', 'DESC')
                        ->get();         
           }
            elseif($status_filter == 1){
                $departures = Departure::where('status',1)
                ->where('approve',1)
                ->whereDate('start_date', '>=', $date)
                ->where('available_seat','>',0)
                ->orderBy('id', 'DESC')
                ->get();    
               }
               elseif($status_filter == 2 ){
               $departures = Departure::where('status',1)
                 ->where('approve',1)
                 ->whereDate('start_date', '>=', $date)
                 ->where('available_seat','=',0)
                 ->orderBy('id', 'DESC')
                 ->get();    
                // dd($departures);
                }
                
           
            elseif(Auth::user()->main_user_type == 2)
            {
                $departures = Departure::
                            where('dep_type','main')
                            ->where('status',1)
                            ->where('approve',1)
                            ->whereDate('start_date', '>=', $date)
                            ->orderBy('id', 'DESC')
                            ->get();
                //dd($departures);
            }
            else{
                $departures = Departure::
                              where('dep_type','main')
                            ->where('status',1)
                            ->where('approve',1)
                            ->whereDate('start_date', '>=', $date)
                            ->orderBy('id', 'DESC')
                            ->get();
                
            }
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
                $hold = HoldDepartureSeat::where('departure_id',$value->id) 
                        ->sum('hold_seat');
                if($hold){
                    $value->hold_sum = $hold;
                }
                else{
                    $value->hold_sum = 0;
                }


                    //return $value->id;
                    $book = BookDeparture::where('departure_id',$value->id) 
                            ->sum('booked_seat');
                            $single_book = BookDeparture::where('departure_id',$value->id) 
                                ->sum('single_supplement_booked_seat');
                    if($book){
                        $value->book_sum = $book;
                    }
                    else{
                        $value->book_sum = 0;
                    }
                    if($single_book){
                        $value->single_book_sum = $single_book;
                    }
                    else{
                        $value->single_book_sum = 0;
                    }
                   //return $value->book_sum
            }
        }
       

       $release = HoldDepartureSeat::all();
       $now =date("Y-m-d H:i:s");
        foreach($release as $row){
        if($now >= $row->date){    
            $update = HoldDepartureSeat::find($row->id);
            $update->delete();
            }
            //return $row->date;
            }

        $holdduration = HoldDuration::all(); 
        $departureCount = Departure::all();
        $total = count($departureCount);
        $active_departureCount = Departure::where('dep_type','main')
                        //->whereDate('start_date', '>=', $date)
                         ->where('approve',1)
                         ->where('status',1)
                        ->get();
        $active = count($active_departureCount);
        $pending_departureCount = Departure::where('dep_type','main')
                        ->whereDate('start_date', '>=', $date)
                        ->where('approve',0)
                        ->where('status',1)
                        ->get();
        $pending = count($pending_departureCount);
        $inactive_departureCount = Departure::where('dep_type','main')
                        ->whereDate('start_date', '<=', $date)
                        ->where('approve',1)
                        ->where('status',1)
                        ->get();
        $inactive = count($inactive_departureCount);

        foreach($departures as $row){
        $departure_destination = DB::table('departure_destinations')
        ->join('destinations','departure_destinations.destination_id','destinations.id')
        ->select('destinations.country_name','destinations.dest_name')
        ->where('departure_destinations.departure_id',$row->id)
        ->get();
        $row->destination = $departure_destination;
        $other_price = DB::table('prices')->where('departure_id',$row->id)->where('price_type_id',3)->get();
        
        $row->OtherPrice = $other_price;
        }
       
        if($request->ajax()){
            return view('departure.all_departure_data',compact('departures','to_date','from_date','holdduration'));
        }
          return view('departure.all_departure',compact('departures','total','to_date','from_date','holdduration','active','inactive','pending','from','to'));
    }
     

    public function ApprovedDeparture(Request $request){
        $from_date = $request->from;
        $to_date = $request->to;
        $date = date("Y-m-d");

        if($request->from){
            $departures = Departure::where('dep_type','main')
                        ->whereBetween('start_date',[$from_date, $to_date])
                        ->where('status',2)
                        ->orderBy('id', 'DESC')
                        ->get();
        }else{
            if(Auth::user()->main_user_type == 2)
            {
                 $departures = Departure::where('status',1)
                ->where('approve',0)
                ->whereDate('start_date', '>=', $date)
                ->orderBy('id', 'DESC')
                ->get();
            }
        }
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
                $hold = HoldDepartureSeat::where('departure_id',$value->id) 
                        ->sum('hold_seat');
                if($hold){
                    $value->hold_sum = $hold;
                }
                else{
                    $value->hold_sum = 0;
                }
            }
        }
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
                $book = BookDeparture::where('departure_id',$value->id) 
                        ->sum('booked_seat');
                if($book){
                    $value->book_sum = $book;
                }
                else{
                    $value->book_sum = 0;
                }
            }
        }
       $release = HoldDepartureSeat::all();
       $now =date("Y-m-d H:i:s");
      foreach($release as $row){
      if($now >= $row->date){    
        $update = HoldDepartureSeat::find($row->id);
        $update->delete();
        }
         //return $row->date;
        }

        $holdduration = HoldDuration::all(); 
        $departureCount = Departure::where('dep_type','main')
                        ->where('status',2)
                        ->whereDate('start_date', '>=', $date)
                        ->get();
        $total = count($departureCount);
        foreach($departures as $row){
        $departure_destination = DB::table('departure_destinations')
        ->join('destinations','departure_destinations.destination_id','destinations.id')
        ->select('destinations.country_name','destinations.dest_name')
        ->where('departure_destinations.departure_id',$row->id)
        ->get();
        $row->destination = $departure_destination;
       }    
       $pending_departureCount = Departure::where('dep_type','main')
                        ->whereDate('start_date', '>=', $date)
                        ->where('approve',0)
                        ->get();
        $pending = count($pending_departureCount);
        
          return view('departure.unapproved_departure',compact('departures','total','to_date','from_date','holdduration','pending'));
    }
 
    public function inactiveDeparture(){
        $date = date("Y-m-d");
        
        $departures = Departure::where('dep_type','main')
        ->where('status',1)
        ->where('approve',1)
        ->whereDate('start_date', '<=', $date)
        ->orderBy('id', 'DESC')
        ->get();
       
        $inactive = count($departures);
        return view('departure.inactive_departure',compact('departures','inactive'));
    }
    public function departureCreate()
    {
        $flight = AllAirline::all();
        $hotel = HotelCategory::all();
        $alldestination = AllDestination::all();
        $holdtill = HoldTill::all(); 
        $holdduration = HoldDuration::all(); 
        $indian_currency=CurrencyConversion::first();
        $inr = $indian_currency->indian_currency;

        return view('departure.basic_details_create',compact('flight','hotel','alldestination','holdtill','holdduration','inr'));
    }

    public function departureStore(Request $request)
    {
        $data = $request->all();
        $startFormat = $request->start_date;
       // $start_date = date("yy-m-d", strtotime($startFormat));
        $user = auth()->user();
        //Transport Type
        if($request->transport_type){
            $array_transport_type = array();
            for($i = 0; $i < count($request->transport_type); $i++) {
                if ($request->transport_type[$i] != '') {
                    array_push($array_transport_type, $request->transport_type[$i]);
                }
            }
        }
        else{
            $array_transport_type = [];
        }
        //Meal Plan
        if($request->meal_plan){
            $array_meal_plan = array();
            for($i = 0; $i < count($request->meal_plan); $i++) {
                if ($request->meal_plan[$i] != '') {
                    array_push($array_meal_plan, $request->meal_plan[$i]);
                }
            }
        }
        else{
            $array_meal_plan = [];
        }
        $departure_last_id =Departure::orderBy('id', 'desc')->first();
       
        $departure = new Departure;
        $departure->title = $request->title;
        $departure->no_of_days = $request->days;
        $departure->no_of_nights = $request->nights;
        //$departure->team_size = $request->team_size;
        $departure->transport_type = implode(",",$array_transport_type);
        $departure->meal_type = implode(",",$array_meal_plan);
        $departure->total_seat = $request->total_seat;
        //$departure->booked_seat = $request->booked_seat;
        $departure->from = $request->starting_from;
        $departure->ending_at = $request->ending_at;
        $departure->start_date = $request->start_date;
        $departure->description = $request->description;
        $departure->departure_ownner = $request->ownner;
        $departure->price_inr = round($request->price_inr);
        $departure->price_usd = round($request->price_usd);
        $departure->hotel_category = $request->hotel;
        $departure->company_name = $user->company_name;
        $departure->tenant_id = $user->tenant_id;
        $departure->hold_duration = $request->hold_time;
        $departure->flight = $request->origin_flight;
        $departure->origin_flight_no = $request->o_flight_no;
        $departure->origin_flight_date = $request->o_flight_dep_date;
        $departure->origin_flight_dep_time = $request->r_flight_dep_time;
        $departure->origin_flight_arrival_time = $request->o_flight_arrival_time;
        $departure->origin_flight_dep_airport = $request->o_flight_dep_airport;
        $departure->origin_flight_arriving_airport = $request->o_flight_arrival_airport;
        $departure->return_flight = $request->r_flight;
        $departure->return_flight_no = $request->r_flight_flight_no;
        $departure->return_flight_date = $request->r_flight_dep_date;
        $departure->return_flight_dep_time = $request->r_flight_dep_time;
        $departure->return_flight_arrival_time = $request->r_flight_arrival_time;
        $departure->return_flight_dep_airport = $request->r_flight_dep_airport;
        $departure->return_flight_arriving_airport = $request->r_flight_arrival_airport;
        $departure->single_supplyment_price_inr = $request->single_price_inr;
        $departure->single_supplyment_price_usd = $request->single_price_usd;
        $departure->dep_id = $departure_last_id->dep_id +1;
-
        $departure->user_id = $user->id;
        $departure->dep_type = "main";
        $departure->unique_key = Str::random(10).time();
        $departure->save();
        $last_id = $departure->id;
         
        $hold = new HoldDeparture;
        $hold->user_id =  $user->id;
        $hold->departure_id = $last_id;
        $hold->hold_till = $request->hold_duration;
        //$hold->hold_till = $request->hold_duration;
        $hold->date = date("Y-m-d H:i:s");
        $hold->save();

        $destArrays = json_decode($request->destinations);
        if($destArrays){
            foreach ($destArrays as $value) {
                if($value != null){
                    $countryCheck = Country::where('country_name',$value->country)
                            ->where('reference_id', $value->country_id)
                            ->first();
                    if($countryCheck == null)
                    {
                        $country  = new Country;
                        $country->country_name = $value->country;
                        $country->reference_id = $value->country_id;
                        $country->latitude = $value->country_lat;
                        $country->longitude = $value->country_long;
                        $country->official_name = $value->official_name;
                        $country->capital = $value->capital;
                        $country->largest_city = $value->largest_city;
                        $country->continent = $value->continent;
                        $country->description = $value->count_description;
                        $country->sub_continent = $value->sub_continent;
                        $country->iso_2 = $value->count_iso2;
                        $country->iso_3 = $value->count_iso3;
                        $country->isd_code = $value->isd_code;
                        $country->internet_tld = $value->internet_tld;
                        $country->currency = $value->currency;
                        $country->currency_symbol = $value->currency_symbol;
                        $country->currency_code = $value->currency_code;
                        $country->drives_on = $value->drive_on;
                        $country->area = $value->area;
                        $country->area_unit = $value->area_unit;
                        $country->population = $value->population;
                        $country->save();
                        $country_last_id = $country->id;
                    }else{
                        $count_id = Country::where('id',$countryCheck->id)->value('id');
                        $country = Country::find($count_id);
                        $country->country_name = $value->country;
                        $country->reference_id = $value->country_id;
                        $country->latitude = $value->country_lat;
                        $country->longitude = $value->country_long;
                        $country->official_name = $value->official_name;
                        $country->capital = $value->capital;
                        $country->largest_city = $value->largest_city;
                        $country->continent = $value->continent;
                        $country->description = $value->count_description;
                        $country->sub_continent = $value->sub_continent;
                        $country->iso_2 = $value->count_iso2;
                        $country->iso_3 = $value->count_iso3;
                        $country->isd_code = $value->isd_code;
                        $country->internet_tld = $value->internet_tld;
                        $country->currency = $value->currency;
                        $country->currency_symbol = $value->currency_symbol;
                        $country->currency_code = $value->currency_code;
                        $country->drives_on = $value->drive_on;
                        $country->area = $value->area;
                        $country->area_unit = $value->area_unit;
                        $country->population = $value->population;
                        $country->save();
                        $country_last_id = $country->id;
                    }
                    $country_dep_unique = CountryDeparture::where('departure_id',$last_id)
                                        ->where('country_id', $country_last_id)
                                        ->first();
                    if($country_dep_unique == null || $country_dep_unique == '')
                    {
                        $countryDepUpdate = new CountryDeparture;
                        $countryDepUpdate->country_id = $country_last_id;
                        $countryDepUpdate->departure_id = $last_id;
                        $countryDepUpdate->save();
                    }

                    $desti = Destination::where('dest_name',$value->name)
                            ->where('reference_id', $value->id)
                            ->first();
                    if($desti == null || $desti == '')
                    {

                        $destination  = new Destination;
                        $destination->dest_name = $value->name;
                        $destination->actualname = $value->actual_name;
                        $destination->country_name = $value->country;
                        $destination->country_id = $country_last_id;
                        $destination->reference_id = $value->id;
                        if($value->lat != ''){
                            $destination->latitude = $value->lat;
                        }
                        if($value->long != ''){
                            $destination->longitude = $value->long;
                        }
                        //$destination->longitude = $value->long;
                        $destination->country_iso_2 = $value->iso2;
                        $destination->country_iso_3 = $value->iso3;
                        $destination->region = $value->region;
                        $destination->description = $value->description;
                        $destination->save();
                        $dest_last_id = $destination->id;
                    }
                    else{
                        $destination = Destination::find($desti->id);
                        $destination->dest_name = $value->name;
                        $destination->actualname = $value->actual_name;
                        $destination->country_name = $value->country;
                        $destination->country_id = $country_last_id;
                        $destination->reference_id = $value->id;
                        if($value->lat != ''){
                            $destination->latitude = $value->lat;
                        }
                        if($value->long != ''){
                            $destination->longitude = $value->long;
                        }
                        $destination->country_iso_2 = $value->iso2;
                        $destination->country_iso_3 = $value->iso3;
                        $destination->region = $value->region;
                        $destination->description = $value->description;
                        $destination->save();
                        $dest_last_id = $destination->id;
                    }
                    $dep_unique = DepartureDestination::where('departure_id',$last_id)
                                ->where('destination_id', $dest_last_id)
                                ->first();
                    if($dep_unique == null || $dep_unique == '')
                    {
                        $depdestination  = new DepartureDestination;
                        $depdestination->departure_id=$last_id;
                        $depdestination->destination_id=$dest_last_id;
                        $depdestination->save();
                    }
                }
            }
        }
        $status = [
            'url'=> url('/departure/inclusion',$last_id),
        ];
        return response()->json($status);
    }

    public function departureEdit(Request $request, $id)
    {
        $flight = AllAirline::all();
        $hotel = HotelCategory::all();
        $alldestination = AllDestination::all(); 
        $holdtill = HoldTill::all(); 
        $holdduration = HoldDuration::all(); 

        $route_ids = $request->route('id'); 
        $route_id = (int)$route_ids;
        if(Auth::user()->main_user_type == 2)
        {
        $departures  = Departure::where('id',$id)
                    //->where('tenant_id',auth()->user()->tenant_id)
                    ->first();
        }
        else{
            $departures  = Departure::where('id',$id)
            ->where('tenant_id',auth()->user()->tenant_id)
            ->first();
        }
        if($departures){
            $data = explode(",",$departures->transport_type);
            $departures['transport_type'] = $data;
        }
        else{
            $departures['transport_type'] = [];
        }
        if($departures){
            $data = explode(",",$departures->meal_type);
            $departures['meal_type'] = $data;
        }
        else{
            $departures['meal_type'] = [];
        }
        $destinations = Destination::join('departure_destinations','departure_destinations.destination_id','=','destinations.id')
                        ->join('countries','countries.id','=','destinations.country_id')
                        ->where('departure_destinations.departure_id',$route_id)
                        ->select('destinations.dest_name as name','destinations.country_name as country','destinations.reference_id as id','destinations.latitude as lat','destinations.longitude as long','destinations.country_iso_2 as iso_2','destinations.country_iso_2 as iso_3','destinations.region as region','destinations.description as description','destinations.status as status','destinations.actualname as actualname','countries.reference_id as count_id','countries.country_name as c_name','countries.official_name as o_name','countries.capital as cap','countries.largest_city as largest_city','countries.continent as continent','countries.description as count_description','countries.sub_continent as count_sub_continent','countries.iso_2 as count_iso_2','countries.iso_3 as count_iso_3','countries.isd_code as count_isd_code','countries.latitude as count_latitude','countries.reference_id as count_id','countries.reference_id as count_latitude','countries.longitude as count_longitude','countries.internet_tld as count_internet_tld','countries.currency as count_currency','countries.currency_symbol as count_currency_symbol','countries.currency_code as count_currency_code','countries.cost_index_id as count_cost_index','countries.drives_on as count_drives_on','countries.area as count_area','countries.area_unit as count_area_unit','countries.population as count_population','countries.status as count_status',)
                        ->get();
        $indian_currency=CurrencyConversion::first();
        $inr = $indian_currency->indian_currency;
         $hold_departure = DB::table('hold_departures')->where('departure_id',$departures->id)->first(); 
        return view('departure.basic_details_edit',compact('departures','destinations','flight','hotel','alldestination','holdtill','holdduration','hold_departure','inr'));
    }

    public function departureUpdate(Request $request, $id)
    {
        $data = $request->all();
        $startFormat = $request->start_date;
        $start_date = date("yy-m-d", strtotime($startFormat));

        // //Transport Type
        // if($request->transport_type){
        //     $array_transport_type = array();
        //     for($i = 0; $i < count($request->transport_type); $i++) {
        //         if ($request->transport_type != '') {
        //             array_push($array_transport_type, $request->transport_type);
        //         }
        //     }
        // }
        // else{
        //     $array_transport_type = [];
        // }
        // //Meal Plan
        // if($request->meal_plan){
        //     $array_meal_plan = array();
        //     for($i = 0; $i < count($request->meal_plan); $i++) {
        //         if ($request->meal_plan != '') {
        //             array_push($array_meal_plan, $request->meal_plan);
        //         }
        //     }
        // }
        // else{
        //     $array_meal_plan = [];
        // }
        // $hold = HoldDeparture::where('departure_id',$id)->first();
        // $hold->user_id =  $user->id;
        // $hold->departure_id = $last_id;
        // $hold->hold_till = $request->hold_duration;
        // //$hold->hold_till = $request->hold_duration;
        // $hold->date = date("Y-m-d H:i:s");
        // $hold->save();
        $result = DB::table('hold_departures')
                ->where('departure_id', $id)
                ->update([
                 'hold_till' => $request->hold_duration,
                 ]);


        $departure = Departure::find($id);
        $departure->title = $request->title;
        $departure->no_of_days = $request->days;
        $departure->no_of_nights = $request->nights;
        //$departure->team_size = $request->team_size;
        $departure->transport_type = $request->transport_type;
        $departure->meal_type = $request->meal_plan;
        $departure->total_seat = $request->total_seat;
        //$departure->booked_seat = $request->booked_seat;
        $departure->from = $request->starting_from;
        $departure->ending_at = $request->ending_at;
        $departure->departure_ownner = $request->ownner;
        $departure->hotel_category = $request->hotel;
        $departure->price_inr =round($request->price_inr);
        $departure->price_usd =round($request->price_usd);
        $departure->flight = $request->flight;
        $departure->start_date = $request->start_date;
        $departure->description = $request->description;
        $departure->origin_flight_no = $request->o_flight_no;
        $departure->origin_flight_date = $request->o_flight_dep_date;
        $departure->origin_flight_dep_time = $request->r_flight_dep_time;
        $departure->origin_flight_arrival_time = $request->o_flight_arrival_time;
        $departure->origin_flight_dep_airport = $request->o_flight_dep_airport;
        $departure->origin_flight_arriving_airport = $request->o_flight_arrival_airport;
        $departure->return_flight = $request->r_flight;
        $departure->return_flight_no = $request->r_flight_flight_no;
        $departure->return_flight_date = $request->r_flight_dep_date;
        $departure->return_flight_dep_time = $request->r_flight_dep_time;
        $departure->return_flight_arrival_time = $request->r_flight_arrival_time;
        $departure->return_flight_dep_airport = $request->r_flight_dep_airport;
        $departure->return_flight_arriving_airport = $request->r_flight_arrival_airport;
        $departure->single_supplyment_price_inr = $request->single_price_inr;
        $departure->single_supplyment_price_usd = $request->single_price_usd;
        $departure->save();
        $last_id = $departure->id;
        $destArrays = json_decode($request->destinations);$departure->single_supplyment_price_inr = $request->single_price_inr;
        $departure->single_supplyment_price_usd = $request->single_price_usd;

        if($destArrays){
            DepartureDestination::where('departure_id', $last_id)->delete();
            CountryDeparture::where('departure_id', $last_id)->delete();
            foreach ($destArrays as $value) {
                if($value != null){
                    $countryCheck = Country::where('country_name',$value->country)
                            ->where('reference_id', $value->country_id)
                            ->first();
                    if($countryCheck == null || $countryCheck == '')
                    {
                        $country  = new Country;
                        $country->country_name = $value->country;
                        $country->reference_id = $value->country_id;
                        $country->latitude = $value->country_lat;
                        $country->longitude = $value->country_long;
                        $country->official_name = $value->official_name;
                        $country->capital = $value->capital;
                        $country->largest_city = $value->largest_city;
                        $country->continent = $value->continent;
                        $country->description = $value->count_description;
                        $country->sub_continent = $value->sub_continent;
                        $country->iso_2 = $value->count_iso2;
                        $country->iso_3 = $value->count_iso3;
                        $country->isd_code = $value->isd_code;
                        $country->internet_tld = $value->internet_tld;
                        $country->currency = $value->currency;
                        $country->currency_symbol = $value->currency_symbol;
                        $country->currency_code = $value->currency_code;
                        $country->drives_on = $value->drive_on;
                        $country->area = $value->area;
                        $country->area_unit = $value->area_unit;
                        $country->population = $value->population;
                        $country->save();
                        $country_last_id = $country->id;
                    }else{
                        $count_id = Country::where('id',$countryCheck->id)->value('id');
                        $country = Country::find($count_id);
                        $country->country_name = $value->country;
                        $country->reference_id = $value->country_id;
                        $country->latitude = $value->country_lat;
                        $country->longitude = $value->country_long;
                        $country->official_name = $value->official_name;
                        $country->capital = $value->capital;
                        $country->largest_city = $value->largest_city;
                        $country->continent = $value->continent;
                        $country->description = $value->count_description;
                        $country->sub_continent = $value->sub_continent;
                        $country->iso_2 = $value->count_iso2;
                        $country->iso_3 = $value->count_iso3;
                        $country->isd_code = $value->isd_code;
                        $country->internet_tld = $value->internet_tld;
                        $country->currency = $value->currency;
                        $country->currency_symbol = $value->currency_symbol;
                        $country->currency_code = $value->currency_code;
                        $country->drives_on = $value->drive_on;
                        $country->area = $value->area;
                        $country->area_unit = $value->area_unit;
                        $country->population = $value->population;
                        $country->save();
                        $country_last_id = $country->id;
                    }
                    $country_dep_unique = CountryDeparture::where('departure_id',$last_id)
                                        ->where('country_id', $country_last_id)
                                        ->first();
                    if($country_dep_unique == null || $country_dep_unique == '')
                    {
                        $countryDepUpdate = new CountryDeparture;
                        $countryDepUpdate->country_id = $country_last_id;
                        $countryDepUpdate->departure_id = $last_id;
                        $countryDepUpdate->save();
                    }
                    //Destination
                    $desti = Destination::where('dest_name',$value->name)
                            ->where('reference_id', $value->id)
                            ->first();
                    if($desti == null || $desti == '')
                    {
                        $destination  = new Destination;
                        $destination->dest_name = $value->name;
                        $destination->actualname = $value->actual_name;
                        $destination->country_name = $value->country;
                        $destination->country_id = $country_last_id;
                        $destination->reference_id = $value->id;
                        $destination->latitude = $value->lat;
                        $destination->longitude = $value->long;
                        $destination->country_iso_2 = $value->iso2;
                        $destination->country_iso_3 = $value->iso3;
                        $destination->region = $value->region;
                        $destination->description = $value->description;
                        $destination->save();
                        $dest_last_id = $destination->id;
                    }
                    else{
                        $destination = Destination::find($desti->id);
                        $destination->dest_name = $value->name;
                        $destination->actualname = $value->actual_name;
                        $destination->country_name = $value->country;
                        $destination->country_id = $country_last_id;
                        $destination->reference_id = $value->id;
                        $destination->latitude = $value->lat;
                        $destination->longitude = $value->long;
                        $destination->country_iso_2 = $value->iso2;
                        $destination->country_iso_3 = $value->iso3;
                        $destination->region = $value->region;
                        $destination->description = $value->description;
                        $destination->save();
                        $dest_last_id = $destination->id;
                    }
                    $dep_unique = DepartureDestination::where('departure_id',$last_id)
                                ->where('destination_id', $dest_last_id)
                                ->first();
                    if($dep_unique == null || $dep_unique == '')
                    {
                        $depdestination  = new DepartureDestination;
                        $depdestination->departure_id=$last_id;
                        $depdestination->destination_id=$dest_last_id;
                        $depdestination->save();
                    }
                }
            }   
        }
        $status = [
                'url'=> url('/departure/inclusion',$last_id),
            ];
        return response()->json($status);
    }

    public function departureDisable(Request $request, $id)
    {
        $departures  = Departure::find($id);
        //dd($departures);
        if($departures->status == 0){
            $departures->status = 1;
            $departures->save();
        }
        else{
            $departures->status = 0;
            $departures->save();
        }
        //return redirect('/my/departures');
        return response()->json(['success'=>'Departure disabled successfully!']);
    }
    // Departure End
    // Departure Approve and unapprove
    public function departureApprove(Request $request, $id)
    {
        $departures  = Departure::find($id);
        //dd($departures);
        if($departures->approve == 1){
            $departures->approve = 0;
            $departures->save();
        }
        else{
            $departures->approve = 1;
            $departures->save();
        }
        
        return response()->json(['success'=>'Departure disabled successfully!']);
    }
    // Departure approve and unapprove end
   
    public function getDestinationAjax(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Destination::select("id","dest_name")
                        ->where('dest_name','LIKE',"%$search%")
                        ->get(20);
            }
        else{
            $data = Destination::select("id","dest_name")
                        ->limit(10)
                        ->get();
        }
        return response()->json($data);
    }

    public function getPricingAjax(Request $request)
   {
      $departure_id = $request->departure_id;
       $type = DB::table('pricing_types')
                       ->select("pricing_types.id","pricing_types.type","name","pricing_types.symbol_inr","pricing_types.symbol_usd")
                       ->distinct()
                       ->get();
       foreach ($type as $key => $value) {
           $type_row = Price::where('price_type_id',$value->id)
                       ->where('departure_id', $departure_id)
                       ->select('price_inr','price_usd')
                       ->first();
           $value->pricing = $type_row;
       }
       // echo "<pre>";
       // print_r($type);
       //$result = array_filter($optional_tour);
      return response()->json($type);
   }
   public function updatePriceModal(Request $request)
    {
      $data = $request->all();
      //dd($data);
      Price::where('departure_id',$request->edit_id)->delete();
      foreach($request->price_type_id as $key => $value)
      {
      if($request->price_inr[$value] || $request->price_usd[$value])
      {
      $price_update = new Price;
      $price_update->price_inr = $request->price_inr[$value];
      $price_update->price_usd = $request->price_usd[$value];
      $price_update->symbol_inr = $request->symbol_inr[$value];
      $price_update->symbol_usd = $request->symbol_usd[$value];
      $price_update->price_type_id = $value;
      $price_update->departure_id = $request->edit_id;
      $price_update->save();
      }
    }
$status = [
       'message'=> "Success!",
   ];
   return response()->json($status);
  }

   public function details($id){
       $departure_details = Departure::where('tenant_id',auth()->user()->tenant_id)->where('id',$id)->first();
      
       $departures = DB::table('departures')->where('dep_type','main')
                        ->where('tenant_id',auth()->user()->tenant_id)
                        ->orderBy('id', 'DESC')
                        ->paginate(25);
        
        
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
                $hold = HoldDepartureSeat::where('departure_id',$id) 
                        ->sum('hold_seat');
                if($hold){
                    $value->hold_sum = $hold;
                }
                else{
                    $value->hold_sum = 0;
                }
            }
        }
        
        if(count($departures)>0){
            foreach ($departures as $key => $value) {
                $book = BookDeparture::where('departure_id',$id) 
                        ->sum('booked_seat');
                if($book){
                     $value->book_sum = $book;
                }
                else{
                    $value->book_sum = 0;
                }
                $single_book = BookDeparture::where('departure_id',$id) 
                        ->sum('single_supplement_booked_seat');
                if($single_book){
                     $value->single_book_sum = $single_book;
                }
                else{
                    $value->single_book_sum = 0;
                }

            }
        }

        
        $itinerary = DB::table('departures')
                    ->join('agent_itineraries','agent_itineraries.departure_id','departures.id')
                    ->select('agent_itineraries.*')
                    ->where('agent_itineraries.user_id',Auth::user()->id)
                    ->first();
                    
        $inclusion = DB::table('departures')
                    ->join('inclusions','inclusions.departure_id','departures.id')
                    ->select('inclusions.*')
                    ->where('inclusions.user_id',Auth::user()->id)
                    ->where('inclusions.departure_id',$id)
                    ->get();
                
       $user_hold = DB::table('hold_departure_seats')
                    ->join('users','hold_departure_seats.user_id','users.id')
                    ->select('hold_departure_seats.*','users.company_name')
                    ->where('departure_id', $departure_details->id)
                    ->get();    
      
       $departure_destination = DB::table('departure_destinations')
                              ->join('destinations','departure_destinations.destination_id','destinations.id')
                              ->select('destinations.country_name','destinations.dest_name')
                              ->where('departure_destinations.departure_id',$departure_details->id)
                              ->get();
      $departure_book = DB::table('book_departures')
            ->join('users','book_departures.user_id','users.id')
            ->join('departures','departures.id','book_departures.departure_id')
            ->select('book_departures.*','users.company_name','users.name','departures.price_inr','departures.price_usd','single_supplyment_price_usd','single_supplyment_price_inr')
            ->where('departure_id',$id)->get();


       return view('departure.departure_details',compact('departure_details','hold','book','itinerary','inclusion','user_hold','departure_destination','departure_book'));
   }
   public function holdDurationUpdate(Request $request){
    $available = Departure::find($request->id);
    $extra_av = $available->available_seat;
    $extra_request =$request->hold;
    if($extra_request > $extra_av){
        $extra_seat_hold = $extra_request - $extra_av;
         $extra_hold_user = 0;
         $request1 = $request->available;
     }else{
        $request1 = $request->hold;
        $extra_hold_user = $request->available - $request->hold;
        $extra_seat_hold = 0;
     }
        
       $save = new HoldDepartureSeat;
       $save->user_id = Auth::user()->id;
       $save->departure_id = $request->id;
       $save->hold_seat = $request1;
       $save->extra_hold_seat = $extra_seat_hold; 
       $save->hold_duration = $request->hours;
       $save->date = date("Y-m-d H:i:s", strtotime("+{$request->hours} hours"));
       $save->note = $request->note;
       //return $save;
       if($save->save()){
        $available = Departure::find($request->id);
        $available->available_seat = $extra_hold_user;
        $available->save();
           return redirect()->back()->withSuccess('Successfully Hold');
       }
   }
   public function bookSeat(Request $request){
       
       $save = new BookDeparture;
       $save->user_id = Auth::user()->id;
       $save->departure_id = $request->id;
       $save->booked_seat = $request->book;
       $save->single_supplement_booked_seat = $request->single_book;
       $save->note = $request->note;
       $save->date = date("Y-m-d");
       if($save->save()){
        $available = Departure::find($request->id);
        $available->available_seat = $request->available - ($request->book + $request->single_book);
        $available->save(); 
        return redirect()->back()->withSuccess('Successfully Booked');
        }
   }
   public function myBooked(){        
        $user = User::find(Auth::user()->id);
        // $departure = Departure::find($user->id);
        // if($departure){
        //     $mybook = DB::table('')
        // }else{
            $mybook = DB::table('book_departures')
                  ->leftjoin('departures','departures.id','book_departures.departure_id')
                  ->select('departures.*','book_departures.booked_seat','book_departures.single_supplement_booked_seat','book_departures.date','book_departures.user_id as uid')
                  ->where('book_departures.user_id',Auth::user()->id)
                  ->get();
                  foreach($mybook as $value){
                    $booking_price = DB::table('prices')->where('departure_id',$value->id)->where('price_type_id',3)->first();
                    
                        if($booking_price){
                           $value->booking_price = $booking_price;
                        }
                        else{
                            $value->booking_price = 0;
                        }
                        
                  }
       return view('departure.mybook',compact('mybook','user'));
   }

   public function release(Request $request, $id){

    HoldDepartureSeat::find($id)->delete(); 
    return redirect()->back()->with('msg','Released Departures');
    }
   // hold history function
public function ForceRelease(Request $request, $id){

         HoldDepartureSeat::find($id)->delete(); 
         return redirect()->back()->with('msg','Released Departures');
   }

    public function startFromDestination(Request $request){
        $startDest = [];
        if($request->has('q')){
            $search = $request->q;
            $startDest = DB::table('all_destinations')->select("id","destination")
                        ->where('destination','LIKE',"%$search%")
                        ->get(15);
            
        }else{
            $startDest = DB::table('all_destinations')->select("id","destination")
                        ->limit(15)
                        ->get();
        }
        return response()->json($startDest);
    }

   

    public function departureAirline(Request $request){
        $startDest = [];
        if($request->has('q')){
            $search = $request->q;
            $startDest = DB::table('all_airlines')->select("id","airline")
                        ->where('airline','LIKE',"%$search%")
                        ->get(15);
            
        }else{
            $startDest = DB::table('all_airlines')->select("id","airline")
                        ->limit(15)
                        ->get();
        }
        return response()->json($startDest);
    }

    public function DepartureDestinationSearch(Request $request){
        $startDest = [];
        if($request->has('q')){
            $search = $request->q;
            $startDest = DB::table('all_destinations')->select("id","destination")
                        ->where('destination','LIKE',"%$search%")
                        ->get(15);
            
        }else{
            $startDest = DB::table('all_destinations')->select("id","destination")
                        ->limit(10)
                        ->get();
        }
        return response()->json($startDest);
    }
    

    public function AllDepartureDetails($id){
        $departure_details = Departure::where('id',$id)->first();
       
        $departures = DB::table('departures')->where('dep_type','main')
                         ->where('tenant_id',auth()->user()->tenant_id)
                         ->orderBy('id', 'DESC')
                         ->get();
         
         
        //  if(count($departures)>0){
        //      foreach ($departures as $key => $value) {
        //          $hold = HoldDepartureSeat::where('departure_id',$id) 
        //                  ->sum('hold_seat');
        //          if($hold){
        //              $value->hold_sum = $hold;
        //          }
        //          else{
        //              $value->hold_sum = 0;
        //          }
        //      }
        //  }
         
        //  if(count($departures)>0){
        //      foreach ($departures as $key => $value) {
        //          $book = BookDeparture::where('departure_id',$id) 
        //                  ->sum('booked_seat');
        //          if($book){
        //              $value->book_sum = $book;
        //          }
        //          else{
        //              $value->book_sum = 0;
        //          }
        //      }
        //  }
 
        $hold_till = DB::table('hold_departures')->where('departure_id',$id)->get();
                         if(count($hold_till)>0){
                         foreach($hold_till as $row){
                           if($row->departure_id == $id){
                           $hold = $row->hold_till;
                           }
                          }
                        }else{
                          $hold = 0;
                        }
          
                       $today = date("Y-m-d");
                       $date1=date_create($today);
                       $date2=date_create( $departure_details->start_date);
                       $diff=date_diff($date1,$date2);
                       $date = $diff->format("%R%a"); 

                      
                            $hold = HoldDepartureSeat::where('departure_id',$departure_details->id) 
                                    ->sum('hold_seat');
                            if($hold){
                                  $departure_details->hold_sum = $hold;
                            }
                            else{
                                  $departure_details->hold_sum = 0;
                            }
                    
                            $book = BookDeparture::where('departure_id',$departure_details->id) 
                                    ->sum('booked_seat');
                            if($book){
                                $departure_details->book_sum = $book;
                            }
                            else{
                                $departure_details->book_sum = 0;
                            }
                            $single_book = BookDeparture::where('departure_id',$departure_details->id) 
                            ->sum('single_supplement_booked_seat');
                            if($single_book){
                               $departure_details->single_book_sum = $single_book;
                            }
                            else{
                                $departure_details->single_book_sum = 0;
                            }
                      

         $itinerary = DB::table('departures')
                     ->join('agent_itineraries','agent_itineraries.departure_id','departures.id')
                     ->select('agent_itineraries.*')
                     ->where('agent_itineraries.departure_id',$id)
                     ->first();
                     
         $inclusion = DB::table('departures')
                     ->join('inclusions','inclusions.departure_id','departures.id')
                     ->select('inclusions.*')
                     //->where('inclusions.user_id',Auth::user()->id)
                     ->where('inclusions.departure_id',$id)
                     ->get();
                 
        $user_hold = DB::table('hold_departure_seats')
                     ->join('users','hold_departure_seats.user_id','users.id')
                     ->select('hold_departure_seats.*','users.company_name')
                     ->where('departure_id', $id)
                     ->get();  
        $count=count($user_hold); 
       
        $departure_destination = DB::table('departure_destinations')
                               ->join('destinations','departure_destinations.destination_id','destinations.id')
                               ->select('destinations.country_name','destinations.dest_name')
                               ->where('departure_destinations.departure_id',$departure_details->id)
                               ->get();
        $price = DB::table('prices')->where('departure_id',$departure_details->id)->first();
        $price1 = DB::table('prices')->where('departure_id',$departure_details->id)->skip(1)->take(1)->first();
        $price2 = DB::table('prices')->where('departure_id',$departure_details->id)->skip(2)->take(1)->first();

        $departure_book = DB::table('book_departures')
            ->join('users','book_departures.user_id','users.id')
            ->join('departures','departures.id','book_departures.departure_id')
            ->select('book_departures.*','users.company_name','users.name','departures.price_inr','departures.price_usd','single_supplyment_price_usd','single_supplyment_price_inr')
            ->where('departure_id',$id)->get();

 
        return view('departure.all_departure_details',compact('departure_details','itinerary','inclusion','user_hold','departure_destination','price','price1','price2','hold','date','count','departure_book'));
    }

    public function SupplierList(){
        $userlist = User::where('main_user_type', 1)->paginate(15);
        return view('departure.supplier',compact('userlist'));
    }
    public function UserList(){
        $userlist = User::where('main_user_type', 0)->paginate(15);
        return view('departure.user_list',compact('userlist'));
    }

    public function BookingHistory(){

        $book = DB::table('book_departures')
        ->leftjoin('departures','departures.id','book_departures.departure_id')
        ->select('departures.*','book_departures.booked_seat','book_departures.date','book_departures.user_id as uid')
        ->paginate(15);
       
        foreach($book as $row){
          $buyers = DB::table('users')->where('id',$row->uid)->get();
           $row->company=$buyers;
        }
              return view('departure.booking_history',compact('book'));
    }

    public function HoldHistory(){
          $hold = DB::table('hold_departure_seats')
        ->leftjoin('departures','departures.id','hold_departure_seats.departure_id')
        ->select('departures.*','hold_departure_seats.hold_duration','hold_departure_seats.date','hold_departure_seats.hold_seat','hold_departure_seats.user_id as uid','hold_departure_seats.id as hold_id')
        //->where('book_departures.user_id',Auth::user()->id)
        ->paginate(15);
        foreach($hold as $row){
            $holded_user = DB::table('users')->where('id',$row->uid)->get();
         $row->hold=$holded_user;
          }
          return view('departure.hold_history',compact('hold'));
    }
    public function DepartureBookingHistory($id){
        $book_date = DB::table('book_departures')
                            ->join('users','book_departures.user_id','users.id')
                            ->join('departures','departures.id','book_departures.departure_id')
                            ->select('book_departures.*','users.company_name','users.name','departures.price_inr','departures.price_usd','single_supplyment_price_usd','single_supplyment_price_inr')
                            ->where('departure_id',$id)->get();
     return view('departure.departure_booking_history',compact('book_date'));
    }
    public function AllDepartureBookingHistory(){
        if(Auth::user()->main_user_type == 1){
        $book = DB::table('book_departures')
                            ->join('users','book_departures.user_id','users.id')
                            ->join('departures','departures.id','book_departures.departure_id')
                            ->select('book_departures.*','users.company_name','users.name','departures.title','departures.price_inr','departures.price_usd','departures.single_supplyment_price_usd','departures.single_supplyment_price_inr','departures.id as d_id')
                            ->where('departures.user_id',Auth::user()->id)->get();
           
            // foreach($book as $row){
            // $price = DB::table('prices')->where('departure_id',$row->d_id)->where('price_type_id',3)->get();
            //    return  $row->otherPrice = $book;
            // }
        $total = count($book);
        }else{
            $book = DB::table('book_departures')
                            ->join('users','book_departures.user_id','users.id')
                            ->join('departures','departures.id','book_departures.departure_id')
                            ->select('book_departures.*','users.company_name','users.name','departures.title','departures.price_inr','departures.price_usd','departures.single_supplyment_price_usd','departures.single_supplyment_price_inr','departures.id as d_id')
                            ->get();
          
            foreach($book as $row){
            $price = DB::table('prices')->where('departure_id',$row->d_id)->where('price_type_id',3)->get();
             $row->otherPrice = $book;
            }
            $total = count($book);
       }
       return view('departure.all_departure_booking_history',compact('book','total'));
  }




    public function BookingHistoryDetails($id){

        $book = BookDeparture::find($id);
        $departure = Departure::find($book->departure_id);
        $user = User::find($book->user_id);
        $destination = DB::table('departure_destinations')
        ->join('destinations','departure_destinations.destination_id','destinations.id')
        ->select('destinations.country_name','destinations.dest_name')
        ->where('departure_destinations.departure_id',$departure->id)
        ->get();
      $price = DB::table('prices')->where('departure_id',$departure->id)->where('price_type_id',3)->get();
      return view('departure.departure_booking_history_details',compact('book','departure','user','destination','price'));
    }


    public function AllDepartureHoldHistory(){
        if(Auth::user()->main_user_type == 1){
        $hold = DB::table('hold_departure_seats')
                            ->join('users','hold_departure_seats.user_id','users.id')
                            ->join('departures','departures.id','hold_departure_seats.departure_id')
                            ->select('hold_departure_seats.*','users.company_name','users.name','departures.title','departures.price_inr','departures.price_usd','departures.single_supplyment_price_usd','departures.single_supplyment_price_inr','departures.id as d_id')
                            ->where('departures.user_id',Auth::user()->id)
                            ->get();
           
            // foreach($book as $row){
            // $price = DB::table('prices')->where('departure_id',$row->d_id)->where('price_type_id',3)->get();
            //    return  $row->otherPrice = $book;
            // }
        $total = count($hold);
        }else{
            $hold = DB::table('hold_departure_seats')
                        ->join('users','hold_departure_seats.user_id','users.id')
                        ->join('departures','departures.id','hold_departure_seats.departure_id')
                        ->select('hold_departure_seats.*','users.company_name','users.name','departures.title','departures.price_inr','departures.price_usd','departures.single_supplyment_price_usd','departures.single_supplyment_price_inr','departures.id as d_id')
                        ->get();
          
            foreach($hold as $row){
            $price = DB::table('prices')->where('departure_id',$row->d_id)->where('price_type_id',3)->get();
             $row->otherPrice = $hold;
            }
            $total = count($hold);
       }
       return view('departure.all_departure_hold_history',compact('hold','total'));
  }

  public function HoldHistoryDetails($id){

    $hold = HoldDepartureSeat::find($id);
    $departure = Departure::find($hold->departure_id);
    $user = User::find($hold->user_id);
    $destination = DB::table('departure_destinations')
    ->join('destinations','departure_destinations.destination_id','destinations.id')
    ->select('destinations.country_name','destinations.dest_name')
    ->where('departure_destinations.departure_id',$departure->id)
    ->get();
  $price = DB::table('prices')->where('departure_id',$departure->id)->where('price_type_id',3)->get();
  return view('departure.departure_hold_history_details',compact('hold','departure','user','destination','price'));
}


    public function UserTypeChange(Request $request, $id)
    {
        $user  = User::find($id);
        //dd($departures);
        if($user->main_user_type == 0){
            $user->main_user_type = 1;
            $user->save();
            $status = 'Not Verified';ggg
            Mail::send('mail.status', ['user' => $user,'status'=> $status], function ($m) use ($user) {
                //$m->from('kpritamk@gmail.com', 'Your Application');
                $m->to($user->email, $user->name)->subject('Your Reminder!');
                 });
        }
        else{
            $user->main_user_type = 0;
            $user->save();
            $status = 'Not Verified';
            Mail::send('mail.status', ['user' => $user,'status'=> $status], function ($m) use ($user) {
                //$m->from('kpritamk@gmail.com', 'Your Application');
                $m->to($user->email, $user->name)->subject('Your Reminder!');
                 });
        }
        
        return response()->json(['success'=>'User updated successfully!']);
    }
    public function UserStatusChange(Request $request, $id)
    {
        $user  = User::find($id);
       
        
        if($user->verified == 0){
            $status = 'Verified';
            Mail::send('mail.status', ['user' => $user,'status'=> $status], function ($m) use ($user) {
                //$m->from('kpritamk@gmail.com', 'Your Application');
                $m->to($user->email, $user->name)->subject('Your Reminder!');
                 });
            $user->verified = 1;
            $user->save();
        }
        else{
            $status = 'Not Verified';
            Mail::send('mail.status', ['user' => $user,'status'=> $status], function ($m) use ($user) {
                //$m->from('kpritamk@gmail.com', 'Your Application');
                $m->to($user->email, $user->name)->subject('Your Reminder!');
                 });
            $user->verified = 0;
            $user->save();
             
        }
        return response()->json(['success'=>'User updated successfully!']);
    }
   
}
