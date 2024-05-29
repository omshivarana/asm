public function orderCartShow(Request $request)
    {
        $user_id = $this->validate_user($request->connection_id, $request->auth_code);
        if ($user_id) 
        {
            $orderCart = DB::table('order_carts')
                ->join('products', 'order_carts.product_id', '=', 'products.id')
                ->where('order_carts.added_by', $user_id)
                ->select('order_carts.id', 'order_carts.product_id', 'order_carts.item_name', 'order_carts.quantity', 'order_carts.unit_price', 'order_carts.taxes', 'order_carts.amount', 'order_carts.added_by', 'products.default_image')
                ->get();

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
        }
        else 
        {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }
    }
