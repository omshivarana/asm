<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;


class ClientController extends Controller
{
    use ValidationTrait;
    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'connection_id' is sent in the request
           
        ]);

        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
       
        if ($user_id)
         {
            try
             {
                // Get original file name
                $fileName1 = $request->file('company_logo')->getClientOriginalName();
        
                // Store file in storage/app/public/images directory
                $companyLogo = $request->file('company_logo')->storeAs('images', $fileName1, 'public');

                $business = [
                    'company_id' => $request->input('company_id'),
                    'user_id' => $user_id,
                    'company_name' => $request->input('company_name'),
                    'owner_name' => $request->input('owner_name'),
                    'business_email' => $request->input('business_email'),
                    'address' => $request->input('address'),
                    'shipping_address' => $request->input('shipping_address'),
                    'postal_code' => $request->input('postal_code'),
                    'state' => $request->input('state'),
                    'city' => $request->input('city'),
                    'office' => $request->input('office'),
                    'website' => $request->input('website'),
                    'note' => $request->input('note'),
                    'linkedin' => $request->input('linkedin'),
                    'facebook' => $request->input('facebook'),
                    'twitter' => $request->input('twitter'),
                    'skype' => $request->input('skype'),
                    'gst_number' => $request->input('gst_number'),
                    'category_id' => $request->input('category_id'),
                    'sub_category_id' => $request->input('sub_category_id'),
                    'added_by' => $request->input('added_by'),
                    'last_updated_by' => $request->input('last_updated_by'),
                    'company_logo' => $companyLogo,
                    'mobile' => $request->input('mobile'),
                    'office_phone' => $request->input('office_phone'),
                    'quickbooks_client_id' => $request->input('quickbooks_client_id'),
                    'electronic_address' => $request->input('electronic_address'),
                    'electronic_address_scheme' => $request->input('electronic_address_scheme'),
                    'created_at' => now(),                 
                    'updated_at' => now(),                  
                ];
                 // Insert expense into database
                DB::table('client_details')->insert($business);  
                if ($business)
                 {                    
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Business created successfully',
                        'expense' => $business,
                    ], 200);
                } else 
                {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Business not created',
                    ], 500);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'An error occurred while creating the expense: ' . $e->getMessage(),
                ], 500);
            }
        } else
         {
            // User not found
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found.'
            ], 404);
        }        

    }


    public function update_client(Request $request)
    {
        // dd($request);
        // Validate the incoming request data
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'connection_id' is sent in the request
            // Include other validation rules for fields to be updated
        ]);

        // Retrieve the user based on the connection ID
        // $user = ConnectionRequest::where('connection_id', $request->connection_id)->where('auth_code',$request->auth_code)->first();
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        $clientID = $request->client_id;
        
        if ($user_id) {

            // Get original file name
            $fileName1 = $request->file('company_logo')->getClientOriginalName();
        
              // Store file in storage/app/public/images directory
              $companyLogo = $request->file('company_logo')->storeAs('images', $fileName1, 'public');

              $businessUpdated = [
                  'company_id' => $request->input('company_id'),
                  'user_id' => $user_id,
                  'company_name' => $request->input('company_name'),
                  'owner_name' => $request->input('owner_name'),
                  'business_email' => $request->input('business_email'),
                  'address' => $request->input('address'),
                  'shipping_address' => $request->input('shipping_address'),
                  'postal_code' => $request->input('postal_code'),
                  'state' => $request->input('state'),
                  'city' => $request->input('city'),
                  'office' => $request->input('office'),
                  'website' => $request->input('website'),
                  'note' => $request->input('note'),
                  'linkedin' => $request->input('linkedin'),
                  'facebook' => $request->input('facebook'),
                  'twitter' => $request->input('twitter'),
                  'skype' => $request->input('skype'),
                  'gst_number' => $request->input('gst_number'),
                  'category_id' => $request->input('category_id'),
                  'sub_category_id' => $request->input('sub_category_id'),
                  'added_by' => $request->input('added_by'),
                  'last_updated_by' => $request->input('last_updated_by'),
                  'company_logo' => $companyLogo,
                  'mobile' => $request->input('mobile'),
                  'office_phone' => $request->input('office_phone'),
                  'quickbooks_client_id' => $request->input('quickbooks_client_id'),
                  'electronic_address' => $request->input('electronic_address'),
                  'electronic_address_scheme' => $request->input('electronic_address_scheme'),
                  'created_at' => now(),                 
                  'updated_at' => now(),                  
              ];
            //   dd($businessUpdated);
            // Update the user's profile information in the 'users' table
            $clientUpdated = DB::table('client_details')
                ->where('user_id', $user_id)->where('id',$clientID)
                ->update($businessUpdated);
            // dd($clientUpdated);
            // Retrieve updated user, employee details, and employee documents
            $clientUpdated = DB::table('client_details')
                ->where('user_id', $user_id)->where('id',$clientID)
                ->first();   
            if ($clientUpdated ) {
                return response()->json([
                    'status' => 'success',
                    'employee_data' => $clientUpdated,
                    'message' => 'Business updated successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to update business'
                ], 500);
            }
        } else {
            // User not found
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found.'
            ], 404);
        }
        
        
    }
}
