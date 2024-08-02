<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{
    public function index()
    {
        $staffs = User::where('role_id', 2)->where('status', 1)->get();
        $roles = Role::all();
        return view('backend.users.security_staff', compact('staffs', 'roles'));
    }

    public function store(Request $request)
    {
        $staff = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'state' => $request->input('state'),
            'address' => $request->input('address'),
            'role_id' => $request->input('role_id'),
            'password' => bcrypt($request->input('password')), 
        ];
        if($staff){
            $staffInserted = DB::table('users')->insert($staff);
        }
        return redirect()->back();
        
    }

    public function update(Request $request)
    {
        $staff = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'state' => $request->input('state'),
            'address' => $request->input('address'),
            'role_id' => $request->input('role_id'),
            'password' => bcrypt($request->input('password')), 
        ];
        // dd($staff);
        if($staff){
            $staffInserted = DB::table('users')->where('id', $request->id)->update($staff);
        }
        return redirect()->back();
        
    }

    public function destroy($id)
    {
        // dd($id);
      $staff = User::where('id', $id)->update(['status'=>0]);
        return redirect()->back();
    }
}
