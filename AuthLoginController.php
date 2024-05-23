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
use DB;

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
            'connection_id'=> 'required|string',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->connection_id = $request->input('connection_id');
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

        if (!$findConnectionID) {
            return response()->json(['message' => 'Invalid connection ID'], 400);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('api')->attempt($credentials)) 
        {
            $user = Auth::guard('api')->user();
            if ($user) 
            {
                $authCode = Str::random(20);

                // Check if a record with the connection_id and user_id already exists
                $connectionRequest = ConnectionRequest::where('user_id', $user->id)
                                                    ->first();

                if ($connectionRequest) {
                    // Update existing record
                    $connectionRequest->update([
                        'auth_code' => $authCode,
                    ]);
                } else {
                    // Create new record
                    ConnectionRequest::create([
                        'connection_id' => $request->connection_id,
                        'auth_code' => $authCode,
                        'user_id' => $user->id,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    ]);
                }

                return response()->json([
                    'status' => 'success', 
                    'message' => 'User Login Successful', 
                    'auth_code' => $authCode, 
                    'user_id' => $user->id, 
                    'user_name' => $user->name, 
                    'user_email' => $user->email, 
                    'user_image' => $user->image, 
                    'user_mobile' => $user->mobile, 
                    'user_gender' => $user->gender
                ], 200);
            }
            else 
            {
                return response()->json(['message' => 'User not found after authentication'], 404);
            }
        }
        else {
            return response()->json(['message' => 'Login not found after authentication'], 404);
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


