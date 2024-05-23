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
       $products = DB::table('products')->paginate(2);

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
        $category = $request->input('category_id'); // This should be an array of category IDs
        $search = $request->input('search');
        $unit = $request->input('unit_id'); // This should be an array of unit IDs
        $subCategory = $request->input('sub_category_id'); // This should be an array of sub-category IDs
        $minPrice = $request->input('min_price'); // minPrice limit
        $miaxPrice = $request->input('max_price'); // minPrice limit

        $productFilter = Product::query();

        if (!empty($category)) {
            $productFilter->whereIn('category_id', $category);
        }

        if (!empty($subCategory)) {
            $productFilter->WhereIn('sub_category_id', $subCategory);
        }

        // Apply the search filter if the search parameter is provided
        if (!empty($search)) {
            $productFilter->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($minPrice && $miaxPrice)) {
            $productFilter->whereBetween('price', [$minPrice, $miaxPrice]);
        }    
        
        if (!empty($unit)) {
            $productFilter->whereIn('unit_id', $unit);
        }

        $products = $productFilter->paginate(2);


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

}
