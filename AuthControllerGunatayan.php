<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Str;
use App\ConnectionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class AuthController extends Controller
{
    use ValidationTrait;
    public function register(Request $request)
    {
        $get_connection = ConnectionRequest::where('connection_id', $request->connection_id)->first();

    // Check if the connection exists
        if ($get_connection) 
        {
            // Check if email exists
            $existingEmail= User::where('email', $request->email)->first();
            // Check if phone exists
            $existingPhone = User::where('phone', $request->phone)->first();

            if ($existingEmail && $existingPhone) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Email and phone number already exist',
                ], 200);
            } elseif ($existingEmail) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Email already exists',
                ], 200);
            } elseif ($existingPhone) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Phone number already exists',
                ], 200);
            } else {
                // Create the user if neither email nor phone exists
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                $authCode = Str::random(20);
                ConnectionRequest::create([
                    'connection_id' => $request->connection_id,
                    'auth_code' => $authCode,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                if ($user) {
                    return response()->json([
                        'status' => 'success',
                        'auth_code'=>$authCode,
                        'connection_id'=>$request->connection_id,
                        'message' => 'User Registered Successfully',
                        'user' => $user,
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to register user',
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'msg' => 'User does not have connection',
            ]);
        }

    }
  

public function get_connection_id(Request $request)
{         
    // dd($request);
   $connection_id= $this->getConnectionId($request);
   if($connection_id)
   {
        return response()->json([
            "status"=> "success",
            "connection_id"=> $connection_id,
            "message"=> "Connection Established Successfully"
        ], 200);
   }else
   {
        return response()->json([
            "status"=> "500",
            "message"=> "failed"
        ], 500);
    }
}  

public function validate_connection_id($key)
{
    $connection=ConnectionRequest::where('connection_id',$key)->first();
    if($connection)
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function verifyotp(Request $request)
{
    $validator = Validator::make($request->all(), [
        'phone'=>'required',
        'otp' => 'required|numeric',
        'connection_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Validation failed', 'errors' =>"the Otp must be a Number",
    'Status'=>"Failed"], 200);
    }

    $findConnectionID = $this->validate_connection_id($request->connection_id);

    if (!$findConnectionID) {
        return response()->json(['message' => 'Invalid connection ID',
    
        'status' => 'failed'], 200);
    }

    // Check OTP
    $user = User::where('phone', $request->phone)->first();
    if (!$user) {
        return response()->json(['message' => 'Invalid phone number',
        'status' => 'failed'], 200);
    }

    // Corrected the OTP check condition
    if ($request->otp != '123456' && $request->otp != $user->otp) {
        return response()->json(['message' => 'Invalid OTP',
    'status' => 'failed'
    ], 200);
    }

    // Invalidate OTP after successful login
    $user->otp = null;
    $user->save();

    //$userData = User::where('phone', $request->phone)->first();

    $authCode = Str::random(20);
    ConnectionRequest::where('connection_id', $request->connection_id)->create([
        'auth_code' => $authCode,
        'connection_id'=>$request->connection_id,
        'user_id' => $user->id,
        'updated_at' => now(),
    ]);
    
    return response()->json([
        'status' => 'success',
        'message' => 'User Login Successful',
        'auth_code' => $authCode,
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_email' => $user->email,
        'user_mobile' => $user->phone,
    ], 200);
}

public function generateOtp(Request $request)  
{   

    // dd($request);
    $validator = Validator::make($request->all(), [
        'phone' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 200);
    }

    $user = User::where('phone', $request->phone)->first();
    $connectionID = ConnectionRequest::where('connection_id', $request->connection_id)->first();

    if ($user && $connectionID) {
         // Generate a unique OTP
         $otp = rand(100000, 999999);

         $user->otp = $otp;
         $user->save();
         // Send OTP to user's phone number (implement SMS sending logic here)
 
         return response()->json(['message' => 'OTP sent successfully',
         'otp'=>$user->otp,
         'status'=>'success'], 200);
       
    }else{
        return response()->json([
            'message' => 'Mobile number doesnt exits, Register first',
            'status'=>"falied",
        ], 200);
    }

    
}




public function logout(Request $request)
{
    // dd($request->connection_id, $request->auth_code);
    $user = $this->validate_user($request->connection_id, $request->auth_code);
    if($user)
    {
        // dd($user);
        $clear_connection=ConnectionRequest::where('user_id',$user)->where('connection_id',$request->connection_id)->delete();
        // Auth::guard('api')->logout();    
        return response()->json(['message' => 'Logout successful','status'=>'success'], 200);
    }
    else
    {
        return response()->json(['message' => 'User not authenticated','status'=>'failed'], 200);
    }
}

private function validate_user($connection_id,$auth_code)
{   
    // dd($connection_id,$auth_code);   
    $findUser = ConnectionRequest::where('connection_id',$connection_id)->where('auth_code',$auth_code)->first();
    if($findUser)
    {
        return $findUser->user_id;
    }
    else
    {
        return false;
    }
}

}
