<?php

namespace App\Http\Controllers\Departure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Departure;
use App\Destination;
use App\DepartureDestination;
use App\Inclusion;

class InclusionController extends Controller
{
	public function inclusionIndex(Request $request)
    {
    	$route_ids = $request->route('id'); 
        $route_id = (int)$route_ids;
    	$inclusions = DB::table('inclusion_masters')->select('name','description')->get();
        $inclusione = Inclusion::where(["departure_id" => $route_id, "dep_type" => "main", "tenant_id" => auth()->user()->tenant_id])->select('name','description')->get();

        $array_1 = json_decode(json_encode($inclusions, true),true);
        $array_2 = json_decode(json_encode($inclusione, true),true);
        $array = array_merge($array_1, $array_2);
        foreach($array as $element) {
            $hash = $element['name'];
            $inclusionedit[$hash] = $element;
        }
        foreach ($inclusionedit as $value) {
            $arr[] = $value;
        }
        $inclusionedits = $arr;

        if(count($inclusione) > 0){
        	return view('departure.inclusion_edit',compact('inclusionedits','inclusione'));
        }
        else{
        	$inclusion_masters = DB::table('inclusion_masters')->get();
	        return view('departure.inclusion_create',compact('inclusion_masters'));
	    }
	    	
    }

    public function storeInclusion(Request $request)
    {
        $route_ids = $request->route('id'); 
        $route_id = (int)$route_ids;
        $user = auth()->user(); 
        $array_check = array();
        for($i = 0; $i < count($request->name); $i++) {
            if ($request->name[$i] != '') {
                array_push($array_check, $request->name[$i]);
            }
        }
        if(count($array_check) > 0){ 
            foreach ($request->names as $key => $value) {
                $n = 1; 
                $start = strlen($value) - $n;
                $str1 = ''; 
                for ($x = $start; $x < strlen($value); $x++) { 
                    $str1 .= $value[$x]; 
                }
                $inc  = Inclusion::where('name',$value)
                        ->where('departure_id',$route_id)
                        ->first();
                if(is_null($inc)){
                    $inclusion  = new Inclusion;
                    $incName = substr($value, 0, strlen($value)-1);
                    $inclusion->name = $incName; 
                    if($request->descriptions[$str1] != ''){   
                        $inclusion->description = $request->descriptions[$str1];
                    }
                    else{
                        $inclusion->description = '';
                    }
                    $inclusion->departure_id = $route_id;
                    $inclusion->dep_type = "main";
                    $inclusion->tenant_id = $user->tenant_id;
                    $inclusion->user_id = $user->id;
                    $inclusion->save();
                }
            }
            foreach ($array_check as $key => $ext_name) {
                $inc  = Inclusion::where('name',$ext_name)
                        ->where('departure_id',$route_id)
                        ->first();
                if(is_null($inc)){
                    $inclusion  = new Inclusion;
                    $inclusion->name = $ext_name;   
                    if($request->description[$key] != ''){   
                        $inclusion->description = $request->description[$key];
                    }
                    else{
                        $inclusion->description = '';
                    }
                    $inclusion->departure_id = $route_id;
                    $inclusion->dep_type = "main"; 
                    $inclusion->tenant_id = $user->tenant_id;
                    $inclusion->user_id = $user->id;
                    $inclusion->save();
                }
            } 
        }
        else{
            foreach ($request->names as $key => $value) {
                $n = 1; 
                $start = strlen($value) - $n;
                $str1 = ''; 
                for ($x = $start; $x < strlen($value); $x++) { 
                    $str1 .= $value[$x]; 
                }

                $inc  = Inclusion::where('name',$value)
                        ->where('departure_id',$route_id)
                        ->first();
                if(is_null($inc)){
                    $inclusion  = new Inclusion;
                    $incName = substr($value, 0, strlen($value)-1);
                    $inclusion->name = $incName; 
                    if($request->descriptions[$str1] != ''){   
                        $inclusion->description = $request->descriptions[$str1];
                    }
                    else{
                        $inclusion->description = '';
                    }
                    $inclusion->departure_id = $route_id;
                    $inclusion->dep_type = "main";
                    $inclusion->tenant_id = $user->tenant_id;
                    $inclusion->user_id = $user->id;
                    $inclusion->save();
                }
            }
        }
        $status = [
                'url'=> url('/departure/inclusion',$route_id),
            ];
        return response()->json($status);  
    }

    public function updateInclusion(Request $request)
    {
        $route_ids = $request->route('id'); 
        $route_id = (int)$route_ids;
        $user = auth()->user(); 
        $array_check = array();
        for($i = 0; $i < count($request->name); $i++) {
            if ($request->name[$i] != '') {
                array_push($array_check, $request->name[$i]);
            }
        }
        if(count($array_check) > 0){ 
            Inclusion::where('departure_id', $route_id)->delete();
            foreach ($request->names as $key => $value) {
                $n = 1; 
                $start = strlen($value) - $n;
                $str1 = ''; 
                for ($x = $start; $x < strlen($value); $x++) { 
                    $str1 .= $value[$x]; 
                }
                $inc  = Inclusion::where('name',$value)
                        ->where('departure_id',$route_id)
                        ->first();
                if(is_null($inc)){
                    $inclusion  = new Inclusion;
                    $incName = substr($value, 0, strlen($value)-1);
                    $inclusion->name = $incName; 
                    if($request->descriptions[$str1] != ''){   
                        $inclusion->description = $request->descriptions[$str1];
                    }
                    else{
                        $inclusion->description = '';
                    }
                    $inclusion->departure_id = $route_id;
                    $inclusion->dep_type = "main";
                    $inclusion->tenant_id = $user->tenant_id;
                    $inclusion->user_id = $user->id;
                    $inclusion->save();
                }
            }
            foreach ($array_check as $key => $ext_name) {
                $inc  = Inclusion::where('name',$ext_name)
                        ->where('departure_id',$route_id)
                        ->first();
                if(is_null($inc)){
                    $inclusion  = new Inclusion;
                    $inclusion->name = $ext_name;   
                    if($request->description[$key] != ''){   
                        $inclusion->description = $request->description[$key];
                    }
                    else{
                        $inclusion->description = '';
                    }
                    $inclusion->departure_id = $route_id; 
                    $inclusion->dep_type = "main";
                    $inclusion->tenant_id = $user->tenant_id;
                    $inclusion->user_id = $user->id;
                    $inclusion->save();
                }
            } 
        }
        else{
            Inclusion::where('departure_id', $route_id)->delete();
            foreach ($request->names as $key => $value) {
                $n = 1; 
                $start = strlen($value) - $n;
                $str1 = ''; 
                for ($x = $start; $x < strlen($value); $x++) { 
                    $str1 .= $value[$x]; 
                }
                $inc  = Inclusion::where('name',$value)
                        ->where('departure_id',$route_id)
                        ->first();
                if(is_null($inc)){
                    $inclusion  = new Inclusion;
                    $incName = substr($value, 0, strlen($value)-1);
                    $inclusion->name = $incName;  
                    if($request->descriptions[$str1] != ''){   
                        $inclusion->description = $request->descriptions[$str1];
                    }
                    else{
                        $inclusion->description = '';
                    }
                    $inclusion->departure_id = $route_id;
                    $inclusion->dep_type = "main";
                    $inclusion->tenant_id = $user->tenant_id;
                    $inclusion->user_id = $user->id;
                    $inclusion->save();
                }
            }
        }
        $status = [
                'url'=> url('/departure/inclusion',$route_id),
            ];
        return response()->json($status);  
    }
}

