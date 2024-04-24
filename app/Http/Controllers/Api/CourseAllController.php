<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CourseAll;
use App\CourseAllEnroll;
use Illuminate\Support\Facades\Session;

class CourseAllController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //course index function
    public function index(){
        
        return view('backend.course_category.course_all');
    }

    //course all listing function
    public function course_listing(){
        $course_all_list = CourseAll::all();
        return view('backend.course_category.course_all_list', compact('course_all_list'));
    }

    //course category function for filter
    public function course_all_filter(Request $request, $category = null){
        if ($category) {
            $course_all_filter = CourseAll::where('category', $category)->get();
        } else {
            $course_all_filter = CourseAll::orderBy('price', 'asc')->get();
        }
        
        return view('backend.course_category.course_all_filter', compact('course_all_filter'));
        // $course_all_filter = CourseAll::all();
        // return view('backend.course_category.course_all_filter', compact('course_all_filter'));
    }
    //course category function for filter
    public function course_all_detail($id){
        $course_all_filter = CourseAll::findOrFail($id);
        $course_recent_filter = CourseAll::limit(3)->latest()->get();
        // dd($course_all_filter);
         return view('backend.course_category.course_all_details', compact('course_all_filter','course_recent_filter'));
    }
  

    // course enroll login function
    public function course_all_login($id){
        $course_all_enroll = CourseAll::find($id);
        // dd($course_all_enroll);
        return view('backend.course_category.course_all_login', compact('course_all_enroll'));
    }

    //course enroll listing function
    public function course_all_enroll(){
        $course_all_enroll = CourseAllEnroll::all();
        return view('backend.course_category.course_all_enroll', compact('course_all_enroll'));
    }
    
    //course enroll delete function
    public function enroll_destroy($id){
        $enroll = CourseAllEnroll::find($id);
        if($enroll){
            $enroll->delete();
        }
        return redirect()->back();
    }

    //course enroll function
    public function course_enroll_store(Request $request){

        $course_all_enroll = new CourseAllEnroll;
        $course_all_enroll->total = $request->total;
        $course_all_enroll->name = $request->name;
        $course_all_enroll->email = $request->email;
        $course_all_enroll->course_id = $request->course_id;
        $course_all_enroll->user_id = $request->user_id;
        $course_all_enroll->payment_gateway = $request->payment_gateway;
        $course_all_enroll->payment_track = $request->payment_track;
        $course_all_enroll->transaction_id = $request->transaction_id;
        $course_all_enroll->payment_status = $request->payment_status;
        $course_all_enroll->status = $request->status;
        $course_all_enroll->coupon = $request->coupon;
        $course_all_enroll->coupon_discounted = $request->coupon_discounted;
        $course_all_enroll->save();

        Session()->flash('success', "You are enrolled successfully !");
        return redirect()->back();
    }

    //course filtering desc function
    public function sortByPriceDesc(Request $request){
         // Fetch products ordered by default
    $course_all_filter = CourseAll::orderBy('price', 'desc')->get();   
    return view('backend.course_category.course_all_filter',compact('course_all_filter'));
    }

    //course filtering Asc function
    public function sortByPriceAsc(Request $request){
         // Fetch products ordered by default
    $course_all_filter = CourseAll::orderBy('price', 'asc')->get(); 
    return view('backend.course_category.course_all_filter',compact('course_all_filter'));
    }
    //course filtering latest function
    public function sortByLatestDesc(Request $request){
         // Fetch products ordered by default
    $course_all_filter = CourseAll::orderBy('created_at', 'desc')->get(); 
    return view('backend.course_category.course_all_filter',compact('course_all_filter'));
    }

    //course store function
    public function store(Request $request){
        $request->validate([
            'topic_title' => 'required|unique:course_alls|max:255'
        ]);

        $course = new CourseAll;
        $course->course_type = $request->course_type;
        $course->instructor_id = $request->instructor_id;
        $course->topic_title = $request->topic_title;
        $course->slug = str_replace(' ','-',strtolower($request->topic_title));
        $course->course_requirement = $request->course_requirement;
        $course->course_description = $request->course_description;
        $course->category = $request->category;
        $course->sub_category = $request->sub_category;
        $course->delivery = $request->delivery;
        $course->level = $request->level;
        $course->language = $request->language;
        $course->duration = $request->duration;
        $course->price = $request->price;
        $course->discount_price = $request->discount_price;
        $fileName1 = $request->file('image_url')->getClientOriginalName();
             // Store file in storage/app/public/images directory
        $filePath1 = $request->file('image_url')->storeAs('images', $fileName1, 'public');
        $course->image_url = $filePath1;
        $fileName2 = $request->file('video_url')->getClientOriginalName();
             // Store file in storage/app/public/images directory
        $filePath2 = $request->file('video_url')->storeAs('images', $fileName2, 'public');
        $course->video_url = $filePath2;
        $course->view_scope = $request->view_scope;
        $course->access_limit = $request->access_limit;
        $fileName3 = $request->file('course_thumbnail')->getClientOriginalName();
             // Store file in storage/app/public/images directory
        $filePath3 = $request->file('course_thumbnail')->storeAs('images', $fileName3, 'public');
        $course->course_thumbnail = $filePath3;
        $course->meta_title = $request->meta_title;
        $course->meta_keyword = $request->meta_keyword;
        $course->meta_description = $request->meta_description;
        $course->meta_tags = $request->meta_tags;
        $course->og_meta_title = $request->og_meta_title;
        $course->og_meta_description = $request->og_meta_description;
        $fileName4 = $request->file('og_meta_image')->getClientOriginalName();
             // Store file in storage/app/public/images directory
        $filePath4 = $request->file('og_meta_image')->storeAs('images', $fileName4, 'public');
        $course->og_meta_image = $filePath4;
        // dd($request);
        $course->save();
        
        session()->flash('success', 'course created successfully');
        return redirect(route('course_all.index'));
        
        
    }
    
    //course store function
    public function update(Request $request)
    {      
        $request->validate([
            'topic_title' => 'required|unique:course_alls|max:255'
        ]);
        // Find the course by ID
        $course = CourseAll::find($request->id);
    
        // Update the course fields
        $course->course_type = $request->course_type;
        $course->instructor_id = $request->instructor_id;
        $course->topic_title = $request->topic_title;
        $course->slug = str_replace(' ','-',strtolower($request->topic_title));
        $course->course_requirement = $request->course_requirement;
        $course->course_description = $request->course_description;
        $course->category = $request->category;
        $course->sub_category = $request->sub_category;
        $course->delivery = $request->delivery;
        $course->level = $request->level;
        $course->language = $request->language;
        $course->duration = $request->duration;
        $course->price = $request->price;
        $course->discount_price = $request->discount_price;
        $course->view_scope = $request->view_scope;
        $course->access_limit = $request->access_limit;
        $course->meta_title = $request->meta_title;
        $course->meta_keyword = $request->meta_keyword;
        $course->meta_description = $request->meta_description;
        $course->meta_tags = $request->meta_tags;
        $course->og_meta_title = $request->og_meta_title;
        $course->og_meta_description = $request->og_meta_description;
    
        // Handle image_url
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imagePath = $image->store('images', 'public');
            $course->image_url = $imagePath;
        }
    
        // Handle video_url
        if ($request->hasFile('video_url')) {
            $video = $request->file('video_url');
            $videoPath = $video->store('videos', 'public');
            $course->video_url = $videoPath;
        }
    
        // Handle course_thumbnail
        if ($request->hasFile('course_thumbnail')) {
            $thumbnail = $request->file('course_thumbnail');
            $thumbnailPath = $thumbnail->store('thumbnails', 'public');
            $course->course_thumbnail = $thumbnailPath;
        }
    
        // Handle og_meta_image
        if ($request->hasFile('og_meta_image')) {
            $ogImage = $request->file('og_meta_image');
            $ogImagePath = $ogImage->store('og_images', 'public');
            $course->og_meta_image = $ogImagePath;
        }
    
        // Save the updated course
        $course->save();
    
        Session()->flash('success', 'course updated successfully');
       return redirect(route('course_all.course_listing'));
    }

    //course  delete function
    public function destroy($id){
        $course = CourseAll::find($id);
        $course->delete();
        session()->flash('danger', 'course deleted successfully');
        return redirect(route('course_all.course_listing'));
    }
}
