<?php

namespace App\Http\Controllers\Departure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;
use Image;
use Auth;
use App\User;
use App\Departure;
use App\AgentItinerary;
use App\CurrencyConversion;


class TermsPayementController extends Controller
{
    public function TermsPaymentCreate($id){
         $id= $id;
         $termsPayment = Departure::find($id);
         $status = Departure::where('id',$id)->first();
        return view('terms_payment.create',compact('id','termsPayment','status'));
    }
    public function TermsPayemntStore(Request $request, $id){
        
      
       $departure =Departure::find($id);
       $departure->termspayment = $request->termspayment;;
       $departure->save();
       return redirect()->back()->with('msg','Success');
    }
    public function currencyConverion(){
        $data=DB::table('currency_conversions')->first();
        // foreach($currency_converion as $row){
        //      $data = $row->indian_currency;
        // }
        return view('terms_payment.currency_converion',compact('data'));
    }
    public function currencyConverionUpdate(Request $request){
        $data = CurrencyConversion::find($request->id);
        $data->indian_currency = $request->currency_conversion;
        $data->save();
        return redirect()->back()->with('msg','Success');
    }
    
}
