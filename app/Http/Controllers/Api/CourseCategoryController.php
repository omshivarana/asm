<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CourseCategory;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
     //CourseCategory index function
     public function index()
     {
         $coursecategories = CourseCategory::all();
         return view('backend.course_category.course_category', compact('coursecategories'));
        
     }
 
     //course category store function
    public function store(Request $request)
    {
    // Validate input data
    $request->validate([
        'name' => 'required',
        'description' => 'required'
    ]);

    // Initialize variables for file paths
    $iconPath = null;
    $thumbnailImagePath = null;

    // Handle file upload for icon
    if ($request->hasFile('icon')) {
        $iconPath = $request->file('icon')->store('public/images');
    }
    // Handle file upload for thumbnail_image
    if ($request->hasFile('thumbnail_image')) {
        $thumbnailImagePath = $request->file('thumbnail_image')->store('public/images');
    }
    // Create new resource
    $coursecategory = CourseCategory::create([
        'name' => $request->name,
        'description' => $request->description,
        'parent_id' => $request->parent_id,
        'position_order' => $request->position_order,
        'status' => $request->status,
        'icon' => $iconPath,
        'thumbnail_image' => $thumbnailImagePath,
    ]);
    return redirect()->back();
}

    //course category update function
    public function update(Request $request)
{
    // Retrieve the course category by ID
    $coursecategory = CourseCategory::find($request->id);
    // Update the attributes with the validated request data
    $coursecategory->name = $request->input('name');
    $coursecategory->description = $request->input('description');
    $coursecategory->parent_id = $request->input('parent_id');
    $coursecategory->position_order = $request->input('position_order');
    $coursecategory->status = $request->input('status');

    // Handle file uploads
    if ($request->hasFile('icon')) {
        $coursecategory->icon = $request->file('icon')->store('images', 'public');
    }

    if ($request->hasFile('thumbnail_image')) {
        $coursecategory->thumbnail_image = $request->file('thumbnail_image')->store('images', 'public');
    }

    // Save the updated course category
    $coursecategory->save();
    return redirect()->back();
}

    //course category delete function
    public function destroy($id){
        $coursecategory = CourseCategory::find($id);
        $coursecategory->delete();
        return redirect()->back();
    }   

}
