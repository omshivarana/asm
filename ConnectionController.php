<?php

namespace app\Http\Controllers\Api\Traits;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ConnectionRequest;

Trait ValidationTrait{


    public function getConnectionId(Request $request)
    {
        if($request->api_key=="y9O2fffDuVFFWgynkYwP")
        {            
          
            $random_string = Str::random(20);

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

            $insert_connection_id = ConnectionRequest::insert(['connection_id' => $numeric_string]);
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


    public function validate_user($connection_id,$auth_code)
    {
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
