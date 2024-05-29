<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCart;
use App\Models\Product;
use App\Models\User;
use App\Models\Client;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;

class OrderCartController extends Controller
{
    use ValidationTrait;

    // public function orderCart(Request $request)
    // {
    //     $user_id = $this->validate_user($request->connection_id, $request->auth_code);
    //     if ($user_id) 
    //     {

    //         $productData = DB::table('products')
    //         ->where('id', $request->input('product_id'))
    //         ->first();
            
    //         $totalAmount = ($productData->price + ($productData->price * ($productData->taxes / 100)))*$request->input('quantity');
            
    //         $orderCart = [
    //             'product_id' => $request->input('product_id'),
    //             'client_id' => $request->input('client_id'),
    //             'item_name' => $productData->name,
    //             'description' => $request->input('description'),
    //             'type' => $request->input('type', 'tax'),
    //             'quantity' => $request->input('quantity'),
    //             'unit_price' => $productData->price,
    //             'amount' => $totalAmount,
    //             'taxes' => $productData->taxes,
    //             'hsn_sac_code' => $request->input('hsn_sac_code'),
    //             'unit_id' => $request->input('unit_id'),
    //             'created_at'=> now(),
    //             'updated_at'=> now(),
    //         ];
            
    //         $orderCartData = DB::table('order_carts')->insert($orderCart);

    //         if ($orderCartData) {
    //             return response()->json([
    //                 'status' => 'success',
    //                 'message' => 'Added to cart successfully',
    //                 'data' => $orderCart, 
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'status' => '500',
    //                 'message' => 'Failed'
    //             ], 500);
    //         }
    //     } else 
    //     {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'User not found'
    //         ], 404);
    //     }

    // }
    public function orderCart(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) 
        {
            $productData = DB::table('products')
                ->where('id', $request->input('product_id'))
                ->first();

            // Check if the product already exists in the order cart for the given client
            $existingOrder = DB::table('order_carts')
                ->where('product_id', $request->input('product_id'))
                ->first();

            if ($existingOrder) {
                // If the product exists, update quantity and amount
                $totalQuantity = $existingOrder->quantity + $request->input('quantity');
                $totalAmount = ($productData->price + ($productData->price * ($productData->taxes / 100))) * $totalQuantity;

                DB::table('order_carts')
                    ->where('id', $existingOrder->id)
                    ->update([
                        'quantity' => $totalQuantity,
                        'amount' => $totalAmount,
                        'updated_at' => now()
                    ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Quantity updated in cart successfully',
                    'data' => ['id'=>$existingOrder->id, 'product_id'=>$existingOrder->product_id, 'item_name'=>$existingOrder->item_name, 'quantity'=>$totalQuantity, 'unit_price'=>$existingOrder->unit_price, 'taxes'=>$existingOrder->taxes, 'total_amount'=>$totalAmount]
                ], 200);
            } else {
                // If the product doesn't exist, insert a new record
                $totalAmount = ($productData->price + ($productData->price * ($productData->taxes / 100))) * $request->input('quantity');
                $clientId = DB::table('client_details')->where('user_id', $user_id)->first();
                // dd($clientId);

                $orderCart = [
                    'product_id' => $request->input('product_id'),
                    'client_id' => $request->input('client_id', $clientId->id),
                    'item_name' => $productData->name,
                    'description' => $productData->description,
                    'type' => $request->input('type', 'tax'),
                    'quantity' => $request->input('quantity'),
                    'unit_price' => $productData->price,
                    'amount' => $totalAmount,
                    'taxes' => $productData->taxes,
                    'added_by' => $user_id,
                    'hsn_sac_code' => $productData->hsn_sac_code,
                    'unit_id' => $productData->unit_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $orderCartData = DB::table('order_carts')->insertGetId($orderCart); // Assuming you want to return the ID of the inserted row
                
                if ($orderCartData) {
                    $insertedData = DB::table('order_carts')->where('id', $orderCartData)->first(); // Retrieve inserted data
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Added to cart successfully',
                        'data' => ['id'=>$insertedData->id, 'product_id'=>$insertedData->product_id, 'item_name'=>$insertedData->item_name, 'quantity'=>$insertedData->quantity, 'unit_price'=>$insertedData->unit_price, 'taxes'=>$insertedData->taxes, 'total_amount'=>$insertedData->amount], // Return inserted data
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to add to cart',
                    ], 500);
                }

            }
        } else {
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
            $orderCart = DB::table('order_carts')->where('added_by', $user_id)->get(['id', 'product_id','client_id', 'item_name', 'quantity', 'unit_price', 'taxes', 'amount', 'added_by']);

            if ($orderCart->isEmpty()) {
                return response()->json([
                    'status' => '500',
                    'message' => 'Failed'
                ], 500);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product cart listing successfully',
                'data' => $orderCart,
            ], 200);

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

    public function orderCartDelete(Request $request, $id)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        
        if ($user_id) 
        {
            $orderCartDelete = OrderCart::find($id);
            
            if($orderCartDelete){
                $orderCartDelete->delete();
                return response()->json(['message' => 'Order cart deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Order cart not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    
}
