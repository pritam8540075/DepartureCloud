<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UserDestination;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function UserProfile(){
     $user_destination = UserDestination::where('user_id',Auth::user()->id)->get();
     return view('profile.index',compact('user_destination'));
    }
    public function UserEdit(){
        $edit = User::find(Auth::user()->id);
        return view('profile.edit',compact('edit'));
    }
    public function userProfileUpdate(Request $request){
        // $delete = User::find(Auth::user()->id);
        // $delete_image_path = storage_path().'/app/public/companyLogo/'.$delete->logo;

        
        $update = User::find(Auth::user()->id);
        $update->name = $request->name;
        $update->company_name = $request->company_name;
        $update->mobile = $request->mobile;
        //$update->email = $request->email;
        $update->city = $request->city;
        $update->state = $request->state;
        $update->country = $request->country;
        $update->pin = $request->pin_code;
        $update->website = $request->website;

        if($request->hasFile('logo')){ 
           // unlink($delete_image_path);
            $image = $request->file('logo');
            $extension = $request->logo->getClientOriginalExtension();
            $name = $request->logo->getClientOriginalName();
            $filenames = $name;
            $filenamess = explode('.png',$filenames);
            $filename = $filenamess[0].'-'.time().'.'.$extension;
            $path = '/companyLogo/';
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 777, true); 
            }
                $image->move( public_path().$path, $filename );
                $update->logo = $filename; 
            }
        //$update->save();
        $update->save();
        return redirect()->route('profile')->with('message', 'Profile Updated Successfully');

    }
    
}
