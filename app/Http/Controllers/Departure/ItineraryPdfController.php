<?php

namespace App\Http\Controllers\Departure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageServiceProvider;
use DB;
use Storage;
use Image;
use Auth;
use App\User;
use App\Departure;
use App\AgentItinerary;

class ItineraryPdfController extends Controller
{
	public function pdfItinerayCreate(Request $request)
    {
        $route_ids = $request->route('id');
            $route_id = (int)$route_ids;
        $pdf_itinerary = AgentItinerary::where('tenant_id',auth()->user()->tenant_id)
        ->where('departure_id', $route_id)
                            ->first();
            $s3url_cloud = "https://s3-pullit-bucket.s3.us-west-2.amazonaws.com/departure_cloud/itinerary/";
            if($pdf_itinerary){
                return view('departure.itinerary_pdf_edit',compact('pdf_itinerary','s3url_cloud'));
            }
            else{
                return view('departure.itinerary_pdf',compact('pdf_itinerary','s3url_cloud'));
            }
        }
    public function pdfItinerayStore(Request $request)
    {
        $data = $request->all();
        $user = auth()->user(); 
        $route_ids = $request->route('id'); 
        $route_id = (int)$route_ids;

        $pdf_itinerary = new AgentItinerary;
        $pdf_itinerary->title = $request->title;
        $pdf_itinerary->description = $request->description;
        $pdf_itinerary->departure_id = $route_id;
        $pdf_itinerary->tenant_id = $user->tenant_id;
        $pdf_itinerary->user_id = $user->id;
        $pdf_itinerary->dep_type = "main";
        $pdf_itinerary->unique_key = Str::random(10).time();
        if($request->hasFile('pdf_name')){
            $pdf_files = $request->file('pdf_name');
            $extension = $request->pdf_name->getClientOriginalExtension();
            $name = $request->pdf_name->getClientOriginalName();
            $filenames = explode('.pdf',$name);
            $filename = $filenames[0].'-'.Str::random(3).'.'.$extension;
            $storagePath = Storage::disk('s3')->put('departure_cloud/itinerary/'.$filename, file_get_contents($pdf_files), 'public');
            $pdf_itinerary->pdf_file = $filename;                    
        };
        $pdf_itinerary->save();
        $status = [
                'message'=> "Sussess!",
            ];
        return response()->json($status);
    }

    public function pdfItinerayUpdate(Request $request, $id)
    {
        $data = $request->all();
        $user = auth()->user(); 
        $dep_id = AgentItinerary::where('id', $id)
        		->value('departure_id');
        $pdf_itinerary = AgentItinerary::find($id);
        $pdf_itinerary->title = $request->title;
        $pdf_itinerary->description = $request->description;
        $pdf_itinerary->departure_id = $dep_id;
        $pdf_itinerary->tenant_id = $user->tenant_id;
        $pdf_itinerary->user_id = $user->id;
        $pdf_itinerary->dep_type = "main";
        if($request->hasFile('pdf_name')){
            $pdf_files = $request->file('pdf_name');
            $extension = $request->pdf_name->getClientOriginalExtension();
            $name = $request->pdf_name->getClientOriginalName();
            $filenames = explode('.pdf',$name);
            $filename = $filenames[0].'-'.Str::random(3).'.'.$extension;
            $storagePath = Storage::disk('s3')->put('departure_cloud/itinerary/'.$filename, file_get_contents($pdf_files), 'public');
            $pdf_itinerary->pdf_file = $filename;                    
        };
        $pdf_itinerary->save();
        $status = [
                'message'=> "Sussess!",
            ];
        return response()->json($status);
    }
}
