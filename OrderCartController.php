<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCart;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;

class OrderCartController extends Controller
{
    use ValidationTrait;

    public function orderCart(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) 
        {
            $orderCart = [
                'product_id' => $request->input('product_id'),
                'client_id' => $request->input('client_id'),
                'item_name' => $request->input('item_name'),
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'quantity' => $request->input('quantity'),
                'unit_price' => $request->input('unit_price'),
                'amount' => $request->input('amount'),
                'taxes' => $request->input('taxes'),
                'hsn_sac_code' => $request->input('hsn_sac_code'),
                'unit_id' => $request->input('unit_id'),
                'created_at'=> now(),
                'updated_at'=> now(),
            ];

            $orderCartData = DB::table('order_carts')->insert($orderCart);

            if ($orderCartData) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Added to cart successfully',
                    'data' => $orderCart, 
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => 'Failed'
                ], 500);
            }
        } else 
        {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

    }

    public function orderCartShow(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) 
        {
            $orderCart = DB::table('order_carts')->get();

            if ($orderCart) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product cart listing successfully',
                    'data' => $orderCart, 
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => 'Failed'
                ], 500);
            }
        }else 
        {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }
    }

    public function orderCartDetail(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) 
        {
            $product_id = $request->input('product_id');

            $orderCartDetail = DB::table('order_carts')->where('product_id', $product_id)->first();
            
            if ($orderCartDetail) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product cart Details listing successfully',
                    'data' => $orderCartDetail, 
                ], 200);
            } else {
                return response()->json([
                    'status' => '500',
                    'message' => 'Failed'
                ], 500);
            }
        }else 
        {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

    }
    
}
