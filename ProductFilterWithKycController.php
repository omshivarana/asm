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
    public function productCategoryShow()
    {
        $products = DB::table('product_category')
            ->join('product_sub_category', 'product_category.id', '=', 'product_sub_category.category_id')
            ->select(
                'product_category.id as category_id',
                'product_category.category_name as category_name',
                'product_sub_category.id as subcategory_id',
                'product_sub_category.category_name as subcategory_name'
            )
            ->get();

        if ($products->isNotEmpty()) {
            $formattedProducts = [];

            // Group products by category
            $groupedProducts = $products->groupBy('category_id');

            foreach ($groupedProducts as $categoryId => $categoryProducts) {
                $categoryData = [
                    'id' => $categoryId,
                    'name' => $categoryProducts->first()->category_name,
                    'subcategories' => [],
                ];

                // Group subcategories within each category
                $groupedSubcategories = $categoryProducts->groupBy('subcategory_id');

                foreach ($groupedSubcategories as $subcategoryProducts) {
                    $subcategory = [
                        'id' => $subcategoryProducts->first()->subcategory_id,
                        'name' => $subcategoryProducts->first()->subcategory_name,
                    ];

                    $categoryData['subcategories'][] = $subcategory;
                }

                $formattedProducts[] = $categoryData;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product Category listed successfully',
                'categories' => $formattedProducts,
            ]);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'Failed to retrieve product category',
            ]);
        }
    }

    public function productFilter(Request $request)
    {
        // Retrieve inputs from request
        $category = $request->input('category_id');
        $subCategory = $request->input('sub_category_id');
        $search = $request->input('search');
        $page = $request->input('page', 1); // Default page is 1
        $perPage = 10; // Items per page
        
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

        // Total count without pagination
        $totalCount = $productFilter->count();

        // Check if pagination is needed
        if ($totalCount <= $perPage) {
            $products = $productFilter->get();
        } else {
            // Fetching current page data
            $products = $productFilter->paginate($perPage);
        }

        // Fetch document data
        $docData = DB::table('product_files')
            ->whereIn('product_id', $products->pluck('id'))
            ->select('product_id', 'filename')
            ->get()
            ->groupBy('product_id');

        // Map document data with products
        $products->each(function ($product) use ($docData) {
            $product->docData = $docData[$product->id] ?? [];
        });

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
            'products' => $products->map(function ($product) {
                $totalAmount = $product->price + ($product->price * ($product->taxes / 100));
                return [
                    'id' => $product->id,
                    'company_id' => $product->company_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'taxes' => $product->taxes,
                    'description' => $product->description,
                    'category_id' => $product->category_id,
                    'sub_category_id' => $product->sub_category_id,
                    'total_amount' => $totalAmount,
                    'default_image' => $product->default_image,
                    'productImages' => $product->docData // Include document data
                    // Include other product attributes if needed
                ];
            }),
            'total_products' => $totalCount,
            'current_page' => $page,
            'per_page' => $perPage,
            'total_page' => isset($totalPage) ? $totalPage : ceil($totalCount / $perPage),
        ], 200);
    }


    

    

    






}
