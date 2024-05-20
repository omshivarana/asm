<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientDocument;
use App\Models\ClientDetails;
use App\Models\User; // Import the User model
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Api\Traits\ValidationTrait;

class ClientDocumentController extends Controller
{
    use ValidationTrait;
   
    public function kycDocUpload(Request $request)
    {  
        // dd($request);
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', 
        ]);
        
        // Retrieve the user based on the connection ID and auth code
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        
        if ($user_id) {
            try {
                //get company _id
                $user_data = User::find($user_id);
                
                // Save KYC details
                $KYCdetails = DB::table('client_docs')->insert([  
                    'company_id' => 2,
                    'user_id' => $user_id, // Assuming you want to associate the KYC document with a user
                    'name' => $request->input('name'),
                    'filename' => $request->input('file'),
                    'hashname' => Str::random(20),
                    'added_by' => $user_id,
                    'last_updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                // Check if KYC details were saved successfully
                if ($KYCdetails) {
                    return response()->json(['status' => 'success', 'message' => 'KYC document saved successfully.'], 200);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Failed to save KYC document.'], 500);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid connection ID or auth code.'], 400);
        }
    }

    public function getBusinessKyc(Request $request)
    {    
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);

    if ($user_id) {
        // Retrieve user details
        $userData = DB::table('client_details')
            ->where('user_id', $user_id)
            ->select(
                'id',
                'company_name',
                'owner_name',
                'business_email',
                'address',
                'postal_code',
                'gst_number',
                'category_id',
                'company_logo',
                'office_phone',
            )
            ->first();

        // Check if user data exists
        if ($userData) {
            // Retrieve documents associated with the user
            $docData = DB::table('client_docs')
                ->where('user_id', $user_id)
                ->select('name','filename')
                ->get();

            // Merge document data with user data
            $userData->docData = $docData;

            return response()->json([
                'status' => 'success',
                'message' => 'User Found successfully',
                'userData' => $userData,
            ]);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found.'], 404);
        }

    } else {
        return response()->json(['status' => 'failed', 'message' => 'User not found.'], 404);
    }
    }
}
