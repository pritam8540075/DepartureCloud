<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Departure;
use DB;

class BookController extends Controller
{
    public function index(){
        $data = Departure::all();
        foreach($data as $value){
            $today = date("Y-m-d");
            $date1=date_create($value->start_date);
            $date2=date_create($today);
            $diff=date_diff($date1,$date2);
            $date = $diff->format("%R%a");
            if($date){
                 $value->id; 
                //$data =DB::table('departures')->where('id', $value->id)->update(['hold_seat' => 0]);
            }
        }
        $book = Departure::orderBy('id','DESC')->paginate(8);
        return view('book.index',compact('book'));
    }
    public function hold(Request $request){
       $id = $request->id;
       $total = $request->total_hold + $request->hold;
       $data =DB::table('departures')->where('id', $id)->update(['hold_seat' => $total]);
        if($data){
            return Redirect::back();
        }
    }
    public function store(Request $request){
        $id = $request->id;
        $total = $request->total_available + $request->book;
        $data =DB::table('departures')->where('id', $id)->update(['booked_seat' => $total]);
         if($data){
             return Redirect::back();
         }
    }
}
