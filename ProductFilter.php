<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\UnitType;
use DB;

class ProductController extends Controller
{
    public function productShow()
    {
       $products = DB::table('products')->get();

       if($products)
       {
            return response()->json([
                'status'=>'success',
                'message'=>'products listing successfullly',
                'products'=>$products
            ], 200);
       }else
       {
            return response()->json([
                'status'=>'404',
                'message'=>'failed',
            ], 404);
       }
    }

    public function productFilter(Request $request)
    {
        // Retrieve inputs from request
        $category = $request->input('category_id');
        $subCategory = $request->input('sub_category_id');
        $search = $request->input('search');
        $unit = $request->input('unit_id');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $page = $request->input('page', 1); // Default page is 1
        $perPage = 1; // Items per page
        $totalItem = $page*$perPage;
        
        // Create a query builder instance for products
        $productFilter = Product::query();

        // Apply filters
        if (!empty($category)) {
            $categoryArray = explode(",", $category);
            $productFilter->whereIn('category_id', $categoryArray);
        }

        if (!empty($subCategory)) {
            $subCategoryArray = explode(",", $subCategory);
            $productFilter->whereIn('sub_category_id', $subCategoryArray);
        }

        if (!empty($search)) {
            $productFilter->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($minPrice) && !empty($maxPrice)) {
            $productFilter->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if (!empty($unit)) {
            $unitArray = explode(",", $unit);
            $productFilter->whereIn('unit_id', $unitArray);
        }

        // Total count without pagination
        $totalCount = $productFilter->count();

        // Total pages
        $totalPage = ceil($totalCount / $perPage);

        // Fetching current page data
        $products = $productFilter->limit($totalItem)->get();

        // Check if products are found
        if ($products->isEmpty()) {
            return response()->json([
                'status' => '404',
                'message' => 'No products found matching the criteria.',
            ], 404);
        }

        // Return response with products
        return response()->json([
            'status' => 'success',
            'message' => 'Products listing successful.',
            'products' => $products,
            'total_products' => $totalCount,
            'current_page' => $page,
            'per_page' => $perPage,
            'total_page' => $totalPage,
        ], 200);
    }




}
