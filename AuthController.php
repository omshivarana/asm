<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConnectionRequest;
use Hash;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class AuthController extends Controller
{
    use ValidationTrait;

    public function get_connection_id(request $request)
    {
       $connection_id= $this->getConnectionId($request);
       return response()->json([
        "status"=> "success",
        "connection_id"=> $connection_id,
        "message"=> "Connection Established Successfully"
       ]);
    }



    public function registerSubmit(Request $request)
    {        
        // Validate the connection ID
        $isValidConnectionID = $this->validate_connection_id($request->connection_id);
        
        if (!$isValidConnectionID) {
            return response()->json(['message' => 'Invalid connection ID'], 400);
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|alpha|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if ($user) {
            return response()->json(['user' => $user, 'message' => 'User registered successfully!'], 201);
        } else {
            return response()->json(['user' => null ,'message' => 'User registration failed!'], 500);
        }
    }



    
    // Assuming all necessary classes are imported at the top of the file

public function loginSubmit(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
        'connection_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
    }

    $findConnectionID = $this->validate_connection_id($request->connection_id);
    // dd($findConnectionID);

    if (!$findConnectionID) {
        return response()->json(['message' => 'Invalid connection ID'], 400);
    }

    $credentials = $request->only('email', 'password');

    if (Auth::guard('api')->attempt($credentials)) {
        $user = Auth::guard('api')->user();
      
        if ($user) {
            $authCode = Str::random(20);

            $findUpdate = User::where('email', $request->email)->first();
             
            if ($findUpdate)
             {
                $connection_update=ConnectionRequest::where('connection_id',$request->connection_id)->update([
                    'connection_id'=>$request->connection_id,
                    'auth_code'=>$authCode,
                    'user_id'=>$user->id,
                ]);
                return response()->json(['user' => $user,'status'=>'success', 'message' => 'Login successful!', 'auth_code' => $authCode], 200);
            } 
            else 
            {
                    return response()->json(['status'=>'Failed','message' =>'Connection request not found'], 404);
            }
            }
            else 
            {
                return response()->json(['message' => 'User not found after authentication'], 404);
            }
        }
    }





    public function logout(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        // dd($user);
        if($user)
        {
            $clear_connection=ConnectionRequest::where('user_id',$user)->where('connection_id',$request->connection_id)->delete();
            // $user->save();
            Auth::guard('api')->logout();    
            return response()->json(['message' => 'Logout successful','status'=>'success'], 200);
        }
        else
        {
            return response()->json(['message' => 'User not authenticated','status'=>'failed'], 401);
        }
    }
    
    
}


