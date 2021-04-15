<?php

namespace App\Http\Controllers;

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
use App\Price;

class PricingModuleController extends Controller
{
	public function updatePriceModal(Request $request)
	{
		$data = $request->all();
		Price::where('departure_id',$request->edit_id)->delete();
		foreach($request->price_type_id as $key => $value) {
			if($request->price_inr[$value] || $request->price_usd[$value]){
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
}
