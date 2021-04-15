<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Departure;
use App\Price;
use App\BookDeparture;
use App\HoldDepartureSeat;

class DepartureSeatsController extends Controller
{
    public function seatsIndexForAgentDook(Request $request)
    {
    	$departure_id = $request->departure_id;
    	$unique_key = $request->unique_key;
    	$departure_seat = Departure::where('id',$departure_id)
    				->where('unique_key',$unique_key)
    				->select('total_seat')
	                ->first(); 
	    $booked_seat = BookDeparture::where('departure_id',$departure_id)
    				->count('booked_seat');

    	$hold_seat = HoldDepartureSeat::where('departure_id',$departure_id)
    				->count('hold_seat');

	    $price = Price::where('departure_id',$departure_id)
    				->where('price_type_id',1)
    				->select('price_inr','price_usd')
	                ->first(); 

	    $status = [
            'manage_seat' => $departure_seat->total_seat,
            'booked_seat' => $departure_seat->booked_seat,
            'available_seat' => $departure_seat->available_seat,
            'price_inr' => $price->price_inr,
            'price_usd' => $price->price_usd
        ];
        return response()->json($status, 200);
    }
}
