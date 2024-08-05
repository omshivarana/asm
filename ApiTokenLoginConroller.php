<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConnectionRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ValidationTrait;

    public function get_connection_id(Request $request)
    {
        $connection_id = $this->getConnectionId($request);
        // dd($request);
        if($connection_id){
            return response()->json([
                'status' => 'success',
                'message' => 'connection established successfully',
                'connection_id' => $connection_id,
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
            ], 500);
        }
    }

   
    public function login_user(Request $request)
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
    
        $user = User::where('email', $credentials['email'])->first();
    
        if ($user && Hash::check($credentials['password'], $user->password)) 
        {
            // Create a new token for the user
            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();
    
            $authCode = Str::random(20);
            ConnectionRequest::create([
                'connection_id' => $request->connection_id,
                'auth_code' => $authCode,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
                'auth_code' => $authCode,
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ], 200);
        }
        else 
        {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
    


}




// validation Trait
<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\Request;
use App\Models\ConnectionRequest;
use Illuminate\Support\Str;

Trait ValidationTrait {

    public function getConnectionId(Request $request)
    {
        if($request->api_key=="y9O2fffDuVFFWgynkYwP")
        {            
            
            $random_string = Str::random(20);
            // dd($random_string);
            // Convert to numeric
            $numeric_string = '';
            for ($i = 0; $i < strlen($random_string); $i++) {
                $numeric_string .= ord($random_string[$i]);
            }
            // Ensure the numeric string is exactly 20 digits
            if (strlen($numeric_string) > 20) {
                $numeric_string = substr($numeric_string, 0, 20);
            } elseif (strlen($numeric_string) < 20) {
                // Append zeros if the length is less than 20
                $numeric_string .= str_repeat('0', 20 - strlen($numeric_string));
            }  
            // dd($numeric_string);
            try{
            $insert_connection_id = ConnectionRequest::insert(['connection_id' => $numeric_string]);
            // return $insert_connection_id;
            }catch(\Exception $e){
                return $e;
            }
            if($insert_connection_id)
            {
                return $numeric_string;
            }
            else
            {
                return response()->json(['Connection Id' => null, 'Message' => 'Could not get Connection Id.']);
            }
        }
        else
        {
            return response()->json(['Connection Id' => null, 'Message' => 'API_key not matched.']);    
        }

        
    }

    public function validate_connection_id($key)
    {
        $connection = ConnectionRequest::where('connection_id', $key)->first();
        if($connection)
        {
            return true;
        }else
        {
            return false;
        }
    }

}


//migration
 Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
// route
//include('staff.php');in api.php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Froiden\RestAPI\Facades\ApiRoute;
use App\Http\Controllers\Api\Auth\AuthController;


// code written by Omshiva Rana :start

Route::post('/get_connection_id', [AuthController::class, 'get_connection_id']);// common apis

Route::prefix('login')->group(function(){
    Route::post('/users', [AuthController::class, 'login_user']);
});

// code written by Omshiva Rana :start

