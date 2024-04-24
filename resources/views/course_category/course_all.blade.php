@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{('Add Course')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-flash-msg/>
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{('Add Course')}}</h4>
                            <a href="{{route('course_all.course_listing')}}" class="btn btn-primary">{{('All Course')}}</a>
                        </div>
                        

                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- ERROR:BEGIN --}}
                                    @if ($errors->any())
                                    <div class="alert alert-danger py-3 mt-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    {{-- ERROR:END --}}
                                    {{-- session flash use:BEGIN --}}
                                @if(session('success'))
                                <h4 class="d-flex justify-content-center py-2 bg-success text-white">{{session('success')}}</h4>
                                @endif
                                @if(session('info'))
                                <h4 class="d-flex justify-content-center py-2 bg-success text-white">{{session('info')}}</h4>
                                @endif
                                @if (session('danger'))
                                <h4 class="d-flex  justify-content-center py-2 bg-danger text-white">{{session('danger')}}</h4>
                                @endif
                                @if (session('warning'))
                                <h4 class="d-flex justify-content-center py-2 bg-warning text-white">{{session('warning')}}</h4>
                                @endif
                                </div>
                                <div class="col-lg-8">
                                    
                                    <div class="form-group">
                                        <label for="topic_title">{{('Title')}}</label>
                                        <input type="text" class="form-control"  value="" name="topic_title" id="topic_title" placeholder="{{('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="course_type">{{('Course Type')}}</label>
                                        <input type="text" class="form-control"  value="" name="course_type" id="course_type" placeholder="{{('Course Type')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="instructor_id">{{('Instructor ID')}}</label>
                                        <input type="number" class="form-control"  value="" name="instructor_id" id="instructor_id" placeholder="{{('Instructor ID')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="course_requirement">{{('Course Requirement')}}</label>
                                        <input type="text" class="form-control"  value="" name="course_requirement" id="course_requirement" placeholder="{{('Course Requirement')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="course_description">{{('Course Description')}}</label>
                                        <input type="text" class="form-control"  value="" name="course_description" id="course_description" placeholder="{{('Course Description')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{('Category')}}</label>
                                        <select name="category" id="category" class="form-control">
                                          <option value="technology">Technology</option>
                                          <option value="innovation">Innovation</option>
                                          <option value="learning">Learning</option>
                                          <option value="information">Information</option>
                                        </select>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_category">{{('Sub Category')}}</label>
                                        <select name="sub_category" id="sub_category" class="form-control">
                                            <option value="technology">Technology</option>
                                            <option value="innovation">Innovation</option>
                                            <option value="learning">Learning</option>
                                            <option value="information">Information</option>
                                        </select>                                    
                                    </div>                                    
                                    <div class="form-group">
                                      <label for="delivery">{{('Mode Of Delivery')}}</label>
                                      <select name="delivery" id="delivery" class="form-control">
                                        <option value="1">Online</option>
                                        <option value="0">Offline</option>
                                      </select>
                                  </div>
                                    <div class="form-group">
                                      <label for="level">{{('Level')}}</label>
                                      <select name="level" id="level" class="form-control">
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advance">Advance</option>
                                        <option value="pro">Pro</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="language">{{('Language')}}</label>
                                    <select name="language" id="language" class="form-control">
                                      <option value="hindi">Hindi</option>
                                      <option value="english">English</option>
                                    </select>
                                
                                   </div>
                                
                                <div class="form-group">
                                    <label for="duration">{{('Duration')}}</label>
                                    <input type="text" class="form-control"  value="" name="duration" id="duration" placeholder="{{('Duration')}}">
                                </div>
                                <div class="form-group">
                                    <label for="price">{{('Price')}}</label>
                                    <input type="number" class="form-control"  value="" name="price" id="price" placeholder="{{('Price')}}">
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">{{('Discount Price')}}</label>
                                    <input type="number" class="form-control"  value="" name="discount_price" id="discount_price" placeholder="{{('Discount Price')}}">
                                </div>
                                </div>
                                <div class="col-lg-4">
                                    
                                    <div class="form-group">
                                        <label for="view_scope">{{('View Scope')}}</label>
                                        <select name="view_scope" id="view_scope" class="form-control">
                                          <option value="public">Public</option>
                                          <option value="private">Private</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="access_limit">{{('Access Limit')}}</label>
                                        <input type="text" class="form-control"  value="" name="access_limit" id="access_limit" placeholder="{{('Access Limit')}}">                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="image_url">{{('Image URL')}}</label>
                                        <input type="file" class="form-control" name="image_url" id="image_url">
                                    </div>
                                    <div class="form-group">
                                        <label for="video_url">{{('Vedio URL')}}</label>
                                        <input type="file" class="form-control" name="video_url" id="video_url">
                                    </div>
                                    <div class="form-group">
                                        <label for="course_thumbnail">{{('Course Thumbnail')}}</label>
                                        <input type="file" class="form-control" name="course_thumbnail" id="course_thumbnail">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">{{('Meta Title')}}</label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keyword">{{('Meta Keyword')}}</label>
                                        <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Keyword')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{('Meta Description')}}</label>
                                        <input type="text" name="meta_description" id="meta_description" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Description')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{('Meta Tags')}}</label>
                                        <input type="text" name="meta_tags" id="meta_tags" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Tags')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="og_meta_title">{{('OG Meta Title')}}</label>
                                        <input type="text" name="og_meta_title" id="og_meta_title" class="form-control" value="" data-role="tagsinput" placeholder="{{('OG Meta Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="og_meta_description">{{('OG Meta Description')}}</label>
                                        <input type="text" name="og_meta_description" id="og_meta_description" class="form-control" value="" data-role="tagsinput" placeholder="{{('OG Meta Description')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="og_meta_image">{{('Og Meta Image')}}</label>
                                        <input type="file" class="form-control" name="og_meta_image" id="og_meta_image" >
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{('Add Course')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
   
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection