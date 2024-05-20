<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\CompanyAddress;
use App\Models\EmployeeShift;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    use ValidationTrait;

    public function employeeAttendance(Request $request)
    {
         // Validate the incoming request data
         $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'auth_code' is sent in the request
        ]);

        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        // dd($user_id);
        if ($user_id)
        {        
                        
            try {                 
                // Fetch user details including company_id
                $user_data = User::find($user_id);
                 // Retrieve the user's company address
                $company_address = $user_data->company_id; // Assuming the relationship is defined as 'company' in the User model
                
                // Get the location_id from the company_address
                $location_id = CompanyAddress::where('company_id', $company_address)->first();
                $employee_shift_id = EmployeeShift::where('company_id', $company_address)->first();
                        
                $attendanceCreated = [
                    'company_id' => $user_data->company_id,
                    'user_id' => $user_id,
                    'location_id' => $location_id->id,
                    'employee_shift_id' => $employee_shift_id->id,
                    'clock_in_time' => $request->input('clock_in_time'),                   
                    'clock_in_ip' => $request->input('clock_in_ip'),                   
                    'clock_out_time' => $request->input('clock_out_time'),                   
                    'clock_out_ip' => $request->input('clock_out_ip'),                   
                    'half_day' => $request->input('half_day') ?? 'no',                   
                    'added_by' => $user_id,                   
                    'last_updated_by' => $user_id,  
                    'latitude' => $request->input('latitude'),                 
                    'longitude' => $request->input('longitude'),                 
                    'punchin_image' => $request->input('punchin_image'),                 
                    'punchout_image' => $request->input('punchout_image'),                 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            
                // Insert Attendance into database
                $attendanceInserted = DB::table('attendances')->insertGetId($attendanceCreated);
            
                if ($attendanceInserted) {
                    $attendanceData = DB::table('attendances')->find($attendanceInserted); // Retrieve the inserted attendance data using the ID
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Punch In successfully',
                        'attendance' => $attendanceData, // Returning the created attendance data
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Punch In Failed',
                    ], 500);
                }
            
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'An error occurred while creating the Attendance: ' . $e->getMessage(),
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

    public function getEmployeeAttendance(Request $request)
    {     
        
          // Validate the incoming request data
          $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'auth_code' is sent in the request
        ]);

        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id)
        {        
            // Get today's date
            $todayDate = Carbon::now()->toDateString();
            
            // Fetch attendance data for today
            $attendanceData = DB::table('attendances')
                ->where('user_id', $user_id)
                ->whereDate('clock_in_time', $todayDate)
                ->orderBy('created_at', 'desc')
                ->select('id', 'user_id', 'clock_in_time', 'clock_out_time','clock_in_ip', 'clock_out_ip', 'latitude', 'longitude', 'punchin_image', 'punchout_image')
                ->get();
            
            if($attendanceData->isNotEmpty()) 
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Punch In - attendance listing successful',
                    'attendance' => $attendanceData
                ], 200);
            } else 
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No attendance data found for today'
                ], 404);
            }
        
        }else
        {
            return response()->json([
                'status' => '404',
                'message' => 'User not found'
            ]);
        }
    }


    public function getEmployeeMonthlyAttendance(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'connection_id' => 'required|string', // Assuming 'connection_id' is sent in the request
            'auth_code' => 'required|string', // Assuming 'auth_code' is sent in the request
        ]);

        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        // dd($user_id);
        if ($user_id)
        {        
            // Define the month and year you want to fetch data for
            $month = 5; // May
            $year = 2024;

            // Fetch attendance data for the specified month and year
            $attendanceData = DB::table('attendances')
                ->where('user_id', $user_id)
                ->whereYear('clock_in_time', $year)
                ->whereMonth('clock_in_time', $month)
                ->orderBy('created_at', 'desc')
                ->select('id', 'user_id', 'clock_in_time', 'clock_out_time','clock_in_ip', 'clock_out_ip', 'latitude', 'longitude', 'punchin_image', 'punchout_image')
                ->get();

            if($attendanceData->isNotEmpty()) 
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Attendance listing successful for ' . Carbon::createFromDate($year, $month)->format('F Y'),
                    'attendance' => $attendanceData
                ], 200);
            } else 
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No attendance data found for ' . Carbon::createFromDate($year, $month)->format('F Y')
                ], 404);
            }

        }else
        {
            return response()->json([
                'status' => '404',
                'message' => 'User not found'
            ]);
        }
    }   

 


}
