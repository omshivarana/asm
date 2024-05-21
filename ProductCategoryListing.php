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
                'product_category.category_name as main_category',
                'product_sub_category.category_name as sub_category',
                'products.id',
                'products.name',
                'products.price',
                'products.description',
                'products.default_image'
            )
            ->get();

        if ($products->isNotEmpty()) {
            // Group products by main category and then by sub category
            $formattedProducts = $products->groupBy('main_category')->map(function ($mainCategory) {
                return $mainCategory->groupBy('sub_category')->map(function ($subCategory) {
                    return $subCategory->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'description' => $product->description,
                            'image' => $product->default_image,
                        ];
                    });
                });
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Products listed successfully',
                'data' => $formattedProducts,
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'Failed to retrieve products',
            ]);
        }
    }
}
