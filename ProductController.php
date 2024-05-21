<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use DB;

class ProductController extends Controller
{
    public function productShow()
    {
        $products = DB::table('product_category')
        ->join('product_sub_category', 'product_category.id', '=', 'product_sub_category.category_id')
        ->join('products', 'product_sub_category.id', '=', 'products.sub_category_id')
        ->select(
            'product_category.id as category_id',
            'product_category.category_name as category_name',
            'product_sub_category.id as sub_category_id',
            'product_sub_category.category_name as sub_category_name',
            'products.*'
        )
        ->get();
    
        if($products)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'products listing successfully',
                'data' => $products
            ]);
        }else
        {
            return response()->json([
                'status' => '404',
                'message' => 'failed',
            ]);
        }
        

    }
}
