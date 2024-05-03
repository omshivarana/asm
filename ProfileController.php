
<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConnectionRequest;
use App\Models\EmployeeDocument;
use Hash;
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

    public function createprofile(Request $request)
    {    
        $user = $this->validate_user($request->connection_id, $request->auth_code);

        if ($user) {
            $userData = DB::table('users')
                ->leftjoin('employee_details', 'users.id', '=', 'employee_details.user_id') // Adjusted join condition here
                ->leftjoin('employee_docs', 'users.id', '=', 'employee_docs.user_id') // Adjusted join condition here
                ->where('users.id', $user)
                ->select(
                    'users.name',
                    'users.email',
                    'users.mobile',
                    DB::raw("CASE 
                                WHEN users.gender = 'male' THEN 'Male' 
                                WHEN users.gender = 'female' THEN 'Female' 
                                ELSE 'Other' 
                            END AS gender"),
                    'employee_details.date_of_birth',
                    'employee_details.joining_date',
                    'employee_details.address',
                    'employee_details.marriage_anniversary_date',
                    'employee_docs.filename',
                    'employee_docs.hashname',
                )
                ->first();
            return response()->json([
                'status'=>'success',
                'message'=>'User Found successfully',
                'userData'=>$userData,
            ]);

        } else {
            return response()->json(['status' => 'failed', 'message' => 'User not found.'], 404);
        }
    }


     public function updateprofile(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            // Include other validation rules for fields to be updated
        ]);

        // Retrieve the user based on the connection ID
        $user = User::where('connection_id', $request->connection_id)->first();

        if ($user) {
            // Update the user's profile information in the 'users' table
            $userUpdated = DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'mobile' => $request->input('mobile'),
                    'gender' => $request->input('gender'),
                    // Add other fields to be updated in the 'users' table
                ]);
        
            // Update the user's profile information in the 'employee_details' table using a join with the 'users' table
            $employeeDetailsUpdated = DB::table('employee_details')
                ->join('users', 'employee_details.user_id', '=', 'users.id')
                ->where('users.id', $user->id)
                ->update([
                    'employee_details.date_of_birth' => $request->input('date_of_birth'),
                    'employee_details.joining_date' => $request->input('joining_date'),
                    'employee_details.address' => $request->input('address'),
                    'employee_details.marriage_anniversary_date' => $request->input('marriage_anniversary_date'),
                    // Add other fields to be updated in the 'employee_details' table
                ]);
                
            // Update the user's profile information in the 'employee_docs' table using a join with the 'users' table
            $employeeDocsUpdated = DB::table('employee_docs')
                ->join('users', 'employee_docs.user_id', '=', 'users.id')
                ->where('users.id', $user->id)
                ->update([
                    'filename' => $request->input('aadhar_front_image') . ',' . $request->input('aadhar_back_image'),
                    'hashname' =>$request->input('pan_image'),
                    // Add other fields to be updated in the 'employee_docs' table
                ]);
        
            // Retrieve updated user, employee details, and employee documents
            $userUpdated = DB::table('users')
                ->where('id', $user->id)
                ->first();
        
            $employeeUpdated = DB::table('employee_details')
                ->where('user_id', $user->id)
                ->first();
        
            $employeeDocsUpdated = DB::table('employee_docs')
                ->where('user_id', $user->id)
                ->first();
        
            if ($userUpdated && $employeeDetailsUpdated && $employeeDocsUpdated) {
                return response()->json([
                    'status' => 'success',
                    'employee_data' => $employeeUpdated,
                    'user_data' => $userUpdated,
                    'employee_docs_data' => $employeeDocsUpdated,
                    'message' => 'Profile updated successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to update profile.'
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
    
    
    


    public function uploadImage(Request $request)
    {
        // dd($request);
        $image_file=$request->image;
         // $folderPath = storage_path('/uploads/'.$folder);
         $folderPath ='/uploads/';
         $image_file = str_replace('data:image/jpeg.base64,','', $image_file);
         $image_file=str_replace(' ', '+', $image_file);
         $data = base64_decode($image_file);
         $image_name=uniqid();
         $filename= $image_name.'.png';
         $path=public_path($folderPath.$filename);
         $success = file_put_contents($path, $data);
        //  dd('uploads/'.$filename);
        return  response()->json(['status' => 'success', 'message' => 'Image saved successfully','image_path'=>'uploads/'.$filename]);
    }

    public function KYCdetails(Request $request)
    {  
        $user = User::where('connection_id', $request->connection_id)->first();
        $KYCdetails = DB::table('employee_docs')
        ->insert([
            'name'=>$user->name,
            'user_id'=>$user->id,
            'filename' => $request->input('aadhar_front_image') . ',' . $request->input('aadhar_back_image'),
            'hashname' =>$request->input('pan_image'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // dd($KYCdetails);
        return response()->json(['status' => 'success', 'message' => 'KYC documents saved successfully.']);
    }

}
