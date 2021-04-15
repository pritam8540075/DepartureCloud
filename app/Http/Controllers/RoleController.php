<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\PermissionRole;

class RoleController extends Controller
{
    public function index(){
        $role = Role::all();
        $permission = DB::table('permissions')
            ->select('module')
            ->distinct()
            ->get();
          //  return $permission;
            foreach($permission as $row){
                $permission_allow = DB::table('permissions')
                     ->where('module',$row->module)
                     ->get();
                $row->sub_module=$permission_allow;
            }
            //dd($permission);
        return view('role.create_role',compact('role','permission_allow','permission'));
    }
    public function create(Request $request){
        $save = new Role;
        $save->name = $request->role;
        $save->tenant_id = Auth::user()->tenant_id;
        $save->user_id =Auth::user()->id;
        $save->status =0;
        if($save->save()){
            return redirect()->back()->with('msg','Role Created');
        }
    }
    public function user(){
        $role = Role::all();
        $user = User::where('tenant_id',Auth::user()->tenant_id)->where('user_type',1)->get();
        foreach($user as $row){
              $user_role = Role::where('id',$row->role_id)
                         ->get();
               $row->sub_name=$user_role;
        }
        return view('role.user_create',compact('role','user'));
    }
    public function UserCreate(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:users|max:255',
        ]);
        $selector = bin2hex(random_bytes(32));
        $int = 123;
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->phone;
        $user->tenant_id = Auth::user()->tenant_id;
        $user->role_id = $request->role;
        $user->user_type = 1;
        $user->main_user_type = 4;
        $pass = $request->name.$int;
        $user->password = Hash::make($pass);
        $user->remember_token = $selector;
      
        if($user->save()){
           //$user->sendEmailVerificationNotification();
            return redirect()->back()->with('msg','User Created Successfuly');
        }
    }
    public function disable(Request $request, $id)
    {
        $user  = User::find($id);
        //dd($departures);
        if($user->status == 0){
            $user->status = 1;
            $user->save();
        }
        else{
            $user->status = 0;
            $user->save();
        }
        return response()->json(['success'=>'Departure disabled successfully!']);
    }
    public function PermissionAllow(Request $request){
        $permission = $request->permission_id;
        $role_id = $request->role_id;
        $delete = DB::table('Permission_roles')->where('role_id',$role_id)->delete();
        for ($i=0; $i<sizeof($permission); $i++)
        {
            //dd($i);
           $data = array();
           $data['permission_id']= $permission[$i];
           $data['role_id']   = $role_id;
           $query_insert = DB::table('permission_roles')->insert($data);
        }
        if($query_insert){
            return redirect()->back()->with('msg', 'successfully permission provided');
        }
    }
  
}
