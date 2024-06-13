<?php

namespace App\Http\Controllers\Api\Track;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;
use Carbon\Carbon;

class TrackController extends Controller
{
    use ValidationTrait;  

    public function trackEmployee(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);

        if ($user_id) {
            // Check if there is an existing entry with the same latitude and longitude
            $existingEntry = DB::table('employee_tracking')
                                ->where('latitude', $request->input('latitude'))
                                ->where('longitude', $request->input('longitude'))
                                ->orderBy('updated_at', 'desc')
                                ->first();
            
            if ($existingEntry) {
                try {
                    // Calculate total_time based on previous updated_at time
                    $prevUpdatedAt = Carbon::parse($existingEntry->updated_at);
                    $currentTime = Carbon::now();
                    $totalTimeInSeconds = $currentTime->diffInSeconds($prevUpdatedAt);
                    // Convert total time to HH:MM:SS format
                    $totalTime = gmdate('H:i:s', $totalTimeInSeconds);

                    // Update the existing entry's updated_at column
                    $updatedEntry=DB::table('employee_tracking')
                        ->where('id', $existingEntry->id)
                        ->update([
                            'updated_at' => now(),
                            'activity_time' => now(),
                            'battery' => $request->input('battery'),
                            'signal_strength' => $request->input('signal_strength'),
                            'total_time' => $totalTime,
                        ]);
                        $updatedEntry=DB::table('employee_tracking')
                        ->where('id', $existingEntry->id)
                        ->first();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Tracking updated successfully',
                        'employee_tracking' => $updatedEntry,
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to update tracking entry',
                    ], 500);
                }
            } else {
                try {
                    // Create a new entry
                    $trackData = [                       
                        'user_id' => $user_id,
                        'activity_time' => now(),
                        'total_time' => $request->input('total_time', "00:00:00"),
                        'activity_name' => $request->input('activity_name'),
                        'latitude' => $request->input('latitude'),
                        'longitude' => $request->input('longitude'),
                        'battery' => $request->input('battery'),
                        'signal_strength' => $request->input('signal_strength'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $trackInserted = DB::table('employee_tracking')->insertGetId($trackData);

                    if ($trackInserted) {
                        $track = DB::table('employee_tracking')->where('id', $trackInserted)->first();
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Tracking successful',
                            'employee_tracking' => $track,
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Failed to create tracking entry',
                        ], 500);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to create tracking entry: ' . $e->getMessage(),
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User validation failed',
            ], 401);
        }
    }

    public function trackEmployeeListing(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);

        if ($user_id) {
            $trackListing = DB::table('employee_tracking')->where('user_id', $user_id)->get();
            if($user_id){
                return response()->json([
                    'status'=>'success',
                    'message'=>'track listing successfully',
                    'track_data'=>$trackListing 
                ], 200);
            }else
            {
                return response()->json([
                    'status'=>'500',
                    'message'=>'failed',
                ], 500);
            }
        }
    }
   

    public function trackEmployeeSync(Request $request)
    {
        try {
            // Decode JSON data from the request
            $requestData = json_decode($request->sync_data, true);

            if (!$requestData) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid sync data provided',
                ], 400);
            }
            
            // Validate user
            $user_id = $this->validate_user($request->connection_id, $request->auth_code);
            if (!$user_id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User validation failed',
                ], 401);
            }

            // Check if there is an existing entry with the same latitude and longitude
            $existingEntry = DB::table('employee_tracking')
                ->where('latitude', $requestData[0]['latitude'])
                ->where('longitude', $requestData[0]['longitude'])
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($existingEntry) {                    
                $prevUpdatedAt = Carbon::parse($existingEntry->updated_at);
                $currentTime = Carbon::now();
                $totalTimeInSeconds = $currentTime->diffInSeconds($prevUpdatedAt);
                // Convert total time to HH:MM:SS format
                $totalTime = gmdate('H:i:s', $totalTimeInSeconds);

                // Update the existing entry's updated_at column
                DB::table('employee_tracking')
                    ->where('id', $existingEntry->id)
                    ->update([
                        'updated_at' => $requestData[0]['activity_time'],
                        'activity_time' => $requestData[0]['activity_time'],
                        'battery' => $requestData[0]['battery'],
                        'signal_strength' => $requestData[0]['signal_strength'],
                        'total_time' => $totalTime,
                    ]);

                $updatedEntry = DB::table('employee_tracking')
                    ->where('id', $existingEntry->id)
                    ->first();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Tracking updated successfully',
                    'employee_tracking' => $updatedEntry,
                ], 200);
            } else {
                // Create a new entry
                $trackData = [
                    'user_id' => $user_id,
                    'activity_time' => $requestData[0]['activity_time'],
                    'total_time' => $requestData[0]['total_time'] ?? "00:00:00",
                    'activity_name' => $requestData[0]['activity_name'] ?? null,
                    'latitude' => $requestData[0]['latitude'],
                    'longitude' => $requestData[0]['longitude'],
                    'battery' => $requestData[0]['battery'],
                    'signal_strength' => $requestData[0]['signal_strength'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $trackInserted = DB::table('employee_tracking')->insertGetId($trackData);

                if ($trackInserted) {
                    $track = DB::table('employee_tracking')->where('id', $trackInserted)->first();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Tracking successful',
                        'employee_tracking' => $track,
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to create tracking entry',
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }




}
