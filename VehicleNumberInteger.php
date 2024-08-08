<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConnectionRequest;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use App\Models\RcDetail;
use App\Models\OwnerDetail;
use App\Models\FinancingDetail;
use App\Models\KycRcPermit;
use App\Models\KycRcNationalPermit;
use App\Models\KycRcVehicleDetail;
use App\Models\KycRcInsuranceDetail;

class VehicleController extends Controller
{
    use ValidationTrait;

    public function index()
    {
        return view('backend.vehicle.vehicle');
    }

    public function store(Request $request)
    {
        $user = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user) { 
            $data=str_split($request->input('rc_number'));
            $state_code = $data[0] . $data[1];
            $district_code=$data[2].$data[3];
            $serial_code=$data[4].$data[5];
            $unique_code=$data[6].$data[7]. $data[8].$data[9];
            // dd($state_code,$district_code,$serial_code,$unique_code);           

            $rc_detail = [
                'state_code' =>$state_code,
                'district_date' =>$district_code,
                'serial_code' =>$serial_code,
                'unique_code' =>$unique_code,
                'rc_issue_date' => $request->input('rc_issue_date'),
                'vehicle_image' => $request->input('vehicle_image'), 
                'expiry_date' => $request->input('expiry_date'),
                'rc_status' => $request->input('rc_status'),
                'emission_norms_type' => $request->input('emission_norms_type'),
                'serial' => $request->input('serial'),
                'rc_category' => $request->input('rc_category'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $owner_detail = [
                'owner_name' => $request->input('owner_name'),
                'rc_details_id' => $request->input('rc_details_id'),
                'care_of' => $request->input('care_of'),
                'present_address' => $request->input('present_address'),
                'permanent_address' => $request->input('permanent_address'),
                'black_list_status' => $request->input('black_list_status'),
                'tax_end_date' => $request->input('tax_end_date'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $financing_detail = [
                'financier' => $request->input('financier'),
                'rc_details_id' => $request->input('rc_details_id'),
                'financed' => $request->input('financed'),
                'financing_status_as_on' => $request->input('financing_status_as_on'),
                'pucc_number' => $request->input('pucc_number'),
                'pucc_upto' => $request->input('pucc_upto'),
                'mobile_number' => $request->input('mobile_number'),
                'pincode' => $request->input('pincode'),
                'vehicle_tax_upto' => $request->input('vehicle_tax_upto'),
                'rc_standard_cap' => $request->input('rc_standard_cap'),
                'non_use_status' => $request->input('non_use_status'),
                'non_use_from' => $request->input('non_use_from'),
                'non_use_to' => $request->input('non_use_to'),
                'is_commercial' => $request->input('is_commercial'),
                'registered_at' => $request->input('registered_at'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $kyc_rc_permit_detail = [
                'issue_date' => $request->input('issue_date'),
                'rc_details_id' => $request->input('rc_details_id'),
                'permit_number' => $request->input('permit_number'),
                'expiry_date' => $request->input('expiry_date'),
                'type' => $request->input('type'),
                'permit_valid_from' => $request->input('permit_valid_from'),
                'permit_valid_upto' => $request->input('permit_valid_upto'),
                'kyc_rc_permit_data' => $request->input('kyc_rc_permit_data'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $kyc_rc_national_permit_detail = [
                'issue_by' => $request->input('issue_by'),
                'kyc_rc_permit_id' => $request->input('kyc_rc_permit_id'),
                'permit_number' => $request->input('permit_number'),
                'national_permit_number' => $request->input('national_permit_number'),
                'national_permit_upto' => $request->input('national_permit_upto'),
                'national_permit_issued_by' => $request->input('national_permit_issued_by'),
                'expiry_date' => $request->input('expiry_date'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $kyc_rc_vehicle_detail = [
                'manufactured_date' => $request->input('manufactured_date'),
                'rc_details_id' => $request->input('rc_details_id'),
                'variant' => $request->input('variant'),
                'category' => $request->input('category'),
                'category_description' => $request->input('category_description'),
                'chassis_number' => $request->input('chassis_number'),
                'engine_number' => $request->input('engine_number'),
                'maker_description' => $request->input('maker_description'),
                'maker_model' => $request->input('maker_model'),
                'body_type' => $request->input('body_type'),
                'fuel_type' => $request->input('fuel_type'),
                'color' => $request->input('color'),
                'cubic_capacity' => $request->input('cubic_capacity'),
                'gross_weight' => $request->input('gross_weight'),
                'number_of_cylinders' => $request->input('number_of_cylinders'),
                'seating_capacity' => $request->input('seating_capacity'),
                'wheelbase' => $request->input('wheelbase'),
                'unladen_weight' => $request->input('unladen_weight'),
                'standing_capacity' => $request->input('standing_capacity'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $kyc_rc_insurance_detail = [
                'policy_number' => $request->input('policy_number'),
                'rc_details_id' => $request->input('rc_details_id'),
                'company' => $request->input('company'),
                'expiry_date' => $request->input('expiry_date'),
                'kyc_vehicle_challan_details' => $request->input('kyc_vehicle_challan_details'),
                'kyc_vehicle_black_list_details' => $request->input('kyc_vehicle_black_list_details'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            dd($rc_detail);
            $rc_detail_inserted = DB::table('rc_details')->insertGetId($rc_detail);
            $owner_detail_inserted = DB::table('owner_details')->insertGetId($owner_detail);
            $financing_detail_inserted = DB::table('financing_details')->insertGetId($financing_detail);
            $kyc_rc_permit_detail_inserted = DB::table('kyc_rc_permits')->insertGetId($kyc_rc_permit_detail);
            $kyc_rc_national_permit_detail_inserted = DB::table('kyc_rc_national_permits')->insertGetId($kyc_rc_national_permit_detail);
            $kyc_rc_vehicle_detail_inserted = DB::table('kyc_rc_vehicle_details')->insertGetId($kyc_rc_vehicle_detail);
            $kyc_rc_insurance_detail_inserted = DB::table('kyc_rc_insurance_details')->insertGetId($kyc_rc_insurance_detail);

            if($rc_detail_inserted && $owner_detail_inserted && $financing_detail_inserted && $kyc_rc_permit_detail_inserted && $kyc_rc_national_permit_detail_inserted && $kyc_rc_vehicle_detail_inserted && $kyc_rc_insurance_detail_inserted)
            {
                $rc_detail_data = RcDetail::where('id', $rc_detail_inserted)->first();
                $owner_detail_data = OwnerDetail::where('id', $owner_detail_inserted)->first();
                $financing_detail_data = FinancingDetail::where('id', $financing_detail_inserted)->first();
                $kyc_rc_permit_detail_data = KycRcPermit::where('id', $kyc_rc_permit_detail_inserted)->first();
                $kyc_rc_national_permit_detail_data = KycRcNationalPermit::where('id', $kyc_rc_national_permit_detail_inserted)->first();
                $kyc_rc_vehicle_detail_data = KycRcVehicleDetail::where('id', $kyc_rc_vehicle_detail_inserted)->first();
                $kyc_rc_insurance_detail_data = KycRcInsuranceDetail::where('id', $kyc_rc_insurance_detail_inserted)->first();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vehicle registered successful',
                    'rc_details' => $rc_detail_data,
                    'owner_details' => $owner_detail_data,
                    'financing_details' => $financing_detail_data,
                    'kyc_rc_permit_details' => $kyc_rc_permit_detail_data,
                    'kyc_rc_national_permit_details' => $kyc_rc_national_permit_detail_data,
                    'kyc_rc_vehicle_details' => $kyc_rc_vehicle_detail_data,
                    'kyc_rc_insurance_details' => $kyc_rc_insurance_detail_data,
                ], 200);
            }else
            {
                return response()->json([
                    'status' => 'failed',
                ], 500);
            }
            
           
        } else {
            return response()->json([
                'status' => '401',
                'message' => 'user not authenticated',
            ], 401);
        }
    }

}
