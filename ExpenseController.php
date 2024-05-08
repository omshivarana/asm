<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;

class ExpenseController extends Controller
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
                $expenseCreated = [
                    'company_id' => $request->input('company_id'),
                    'item_name' => $request->input('item_name'),
                    'purchase_date' => $request->input('purchase_date'),
                    'purchase_from' => $request->input('purchase_from'),
                    'price' => $request->input('price'),
                    'currency_id' => $request->input('currency_id'),
                    'default_currency_id' => $request->input('default_currency_id'),
                    'exchange_rate' => $request->input('exchange_rate'),
                    'project_id' => $request->input('project_id'),
                    'bill' => $request->input('bill'),
                    'user_id' => $user_id,
                    'status' => $request->input('status'),
                    'can_claim' => $request->input('can_claim'),
                    'category_id' => $request->input('category_id'),
                    'expenses_recurring_id' => $request->input('expenses_recurring_id'),
                    'created_by' => $request->input('created_by'),
                    'description' => $request->input('description'),
                    'added_by' => $request->input('added_by'),
                    'last_updated_by' => $request->input('last_updated_by'),
                    'approver_id' => $request->input('approver_id'),
                    'bank_account_id' => $request->input('bank_account_id'),
                ];
                 // Insert expense into database
                DB::table('expenses')->insert($expenseCreated);  
                if ($expenseCreated)
                 {
                    $get_expenses=$this->get_expense($user_id);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Expense created successfully',
                        'expense' => $expenseCreated,
                        'get_expenses'=>$get_expenses,
                    ], 200);
                } else 
                {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Expense not created',
                    ], 500);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'An error occurred while creating the expense: ' . $e->getMessage(),
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

    public function get_expense($id){
        $data=DB::table('expenses')->where('user_id',$id)->get();
        return $data;
    }

    

}
