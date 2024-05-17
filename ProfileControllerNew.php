<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConnectionRequest;
use App\Models\EmployeeDocument;
use Illuminate\Support\Facades\Hash;
// use Hash; 
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class ProfileController extends Controller
{
    use ValidationTrait;

    public function profile(Request $request)
    {    
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);

if ($user_id) {
    // Fetch user data
    $userData = DB::table('users')
        ->leftJoin('employee_details', 'users.id', '=', 'employee_details.user_id')
        ->leftJoin('employee_docs', 'users.id', '=', 'employee_docs.user_id')
        ->where('users.id', $user_id)
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.mobile',
            'users.image',
            DB::raw("CASE 
                        WHEN users.gender = 'male' THEN 'Male' 
                        WHEN users.gender = 'female' THEN 'Female' 
                        ELSE 'Other' 
                    END AS gender"),
            'employee_details.date_of_birth',
            'employee_details.joining_date',
            'employee_details.address',
            'employee_details.marriage_anniversary_date',
        )
        ->first();

    // Fetch employee docs data
    $employeeDocsData = DB::table('employee_docs')
        ->where('user_id', $user_id)
        ->select('doc_title', 'filename')
        ->get();

    return response()->json([
        'status' => 'success',
        'message' => 'User Found successfully',
        'userData' => $userData,
        'DocData' => $employeeDocsData,
    ]);

} else {
    return response()->json(['status' => 'failed', 'message' => 'User not found.'], 404);
}
 
    }


    public function updateProfile(Request $request)
    {       
        // Validate the incoming request data
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'connection_id' is sent in the request
            // Include other validation rules for fields to be updated
        ]);

        // Retrieve the user based on the connection ID
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) {

            $userUpdated = DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'image' => $request->input('image'),
                    'mobile' => $request->input('mobile'),
                    'gender' => $request->input('gender'),
                    // Add other fields to be updated in the 'users' table
                ]);
        
            // Update the user's profile information in the 'employee_details' table using a join with the 'users' table
            $employeeDetailsUpdated = DB::table('employee_details')
                ->join('users', 'employee_details.user_id', '=', 'users.id')
                ->where('users.id', $user_id)
                ->update([
                    'employee_details.date_of_birth' => $request->input('date_of_birth'),
                    'employee_details.joining_date' => $request->input('joining_date'),
                    'employee_details.address' => $request->input('address'),
                    'employee_details.marriage_anniversary_date' => $request->input('marriage_anniversary_date'),
                    // Add other fields to be updated in the 'employee_details' table
                ]);
           
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.'
            ]);
        } 
        else {
            // User not found
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found.'
            ], 404);
        }
    }

    public function updateProfileImage(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'connection_id' is sent in the request
            // Include other validation rules for fields to be updated
        ]);

        // Retrieve the user based on the connection ID
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) {

            $userUpdated = DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'image' => $request->input('image'),
                    // Add other fields to be updated in the 'users' table
                ]); 
        
            return response()->json([
                'status' => 'success',
                'message' => 'Profile Image updated successfully.'
            ]);
        } 
        else {
            // User not found
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found.'
            ], 404);
        }
        
        
    }  

    
    public function kycDocumentUpload(Request $request)
    {  
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', 
        ]);
        
        // Retrieve the user based on the connection ID and auth code
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        
        if ($user_id) {
            //get company _id
            $user_data= User::find($user_id);
            // Save KYC details
            $KYCdetails = DB::table('employee_docs')->insert([  
                'company_id' => $user_data->company_id,
                'user_id' => $user_id, // Assuming you want to associate the KYC document with a user
                'name' => $request->input('document_title'),
                'filename' => $request->input('file'),
                'hashname' => Str::random(20),
                'added_by' => $user_id,
                'last_updated_by' => $user_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        
            // Check if KYC details were saved successfully
            if ($KYCdetails) {
                return response()->json(['status' => 'success', 'message' => 'KYC document saved successfully.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to save KYC document.'], 500);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid connection ID or auth code.'], 400);
        }
    }

    public function uploadImage(Request $request) 
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        // dd($user_id);
        if ($user_id) 
        {
            $uploadImg= $this->upload_image($request);
            // dd($uploadImg);
            return response()->json([
            "status"=> "success",
            "message"=> "Image saved Successfully",
            "image_path"=> $uploadImg,
            ]);    
        }   
    }
    
}
