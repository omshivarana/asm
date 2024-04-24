@extends('backend.admin-master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0 !important;
    }

    div.dataTables_wrapper div.dataTables_length select {
        width: 60px;
        display: inline-block;
    }

    .btn-delete {
        height: 40px !important;
    }
</style>
@endsection
@section('site-title')
{{('All Course List')}}
@endsection
@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="margin-top-40"></div>
            @include('backend/partials/message')
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{('All Course List')}}</h4>
                    <div class="bulk-delete-wrapper">
                        <div class="select-box-wrap">
                            <select name="bulk_option" id="bulk_option">
                                <option value="">{{{('Bulk Action')}}}</option>
                                <option value="delete">{{{('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{('Apply')}}</button>
                        </div>
                    </div>

                    <div class="tab-content margin-top-40" id="myTabContent">
                        @php $b=0; @endphp
                        {{-- @foreach($all_blog as $key => $blog) --}}
                        <div class="tab-pane fade @if($b == 0) show active @endif" role="tabpanel">
                            <div class="table-wrap table-responsive">
                                <table class="table table-default" id="all_blog_table">
                                    <div class="col-lg-12">
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
                                    <thead>
                                        <th class="no-sort">
                                            <div class="mark-all-checkbox">
                                                <input type="checkbox" class="all-checkbox">
                                            </div>
                                        </th>
                                        <th>{{('ID')}}</th>
                                        <th>{{('Title')}}</th>
                                        <th>{{('Slug')}}</th>
                                        <th>{{('Course Type')}}</th>
                                        <th>{{('Instructor ID')}}</th>
                                        <th>{{('Course Requirement')}}</th>
                                        <th>{{('Course Description')}}</th>
                                        <th>{{('Category')}}</th>
                                        <th>{{('Sub Category')}}</th>
                                        <th>{{('Delivery')}}</th>
                                        <th>{{('Level')}}</th>
                                        <th>{{('Language')}}</th>
                                        <th>{{('Duration')}}</th>
                                        <th>{{('Price')}}</th>
                                        <th>{{('Discount Price')}}</th>
                                        <th>{{('View Scope')}}</th>
                                        <th>{{('Access Limit')}}</th>
                                        <th>{{('Image URL')}}</th>
                                        <th>{{('Vedio URL')}}</th>
                                        <th>{{('Course Thumbnail')}}</th>
                                        <th>{{('Og Meta Image')}}</th>
                                        <th>{{('Action')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach( $course_all_list as $course_all)
                                        <tr>
                                            <td></td>
                                            <td>{{$course_all->id}}</td>
                                            <td>{{$course_all->topic_title}}</td>
                                            <td>{{$course_all->slug}}</td>
                                            <td>{{$course_all->course_type}}</td>
                                            <td>{{$course_all->instructor_id}}</td>
                                            <td>{{$course_all->course_requirement}}</td>
                                            <td>{{$course_all->course_description}}</td>
                                            <td>{{$course_all->category}}</td>
                                            <td>{{$course_all->sub_category}}</td>
                                            <td>{{$course_all->delivery ? 'Online':'Offline'}}</td>
                                            <td>{{$course_all->level}}</td>
                                            <td>{{$course_all->language}}</td>
                                            <td>{{$course_all->duration}}</td>
                                            <td>{{$course_all->price}}</td>
                                            <td>{{$course_all->discount_price}}</td>
                                            <td>{{$course_all->view_scope}}</td>
                                            <td>{{$course_all->access_limit}}</td>
                                            <td><img src="{{ asset('@core/storage/app/public/'.$course_all->image_url) }}" alt="image" width="100" height="30"></td>
                                            <td>{{$course_all->video_url}}</td>
                                            <td><img src="{{ asset('@core/storage/app/public/'.$course_all->course_thumbnail) }}" alt="image" width="100" height="30"></td>
                                            <td><img src="{{ asset('@core/storage/app/public/'.$course_all->og_meta_image) }}" alt="image" width="100" height="30"></td>
                                            <td class="d-flex justify-content-center">
                                                <a href="#" data-toggle="modal" data-target="#category_edit_modal" class="btn btn-lg btn-primary btn-sm mb-3 mr-1 category_edit_btn" data-id="{{$course_all->id}}" data-topic_title="{{$course_all->topic_title}}" data-course_type="{{$course_all->course_type}}" data-instructor_id="{{$course_all->instructor_id}}" data-course_requirement="{{$course_all->course_requirement}}" data-course_description="{{$course_all->course_description}}" data-category="{{$course_all->category}}" data-sub_category="{{$course_all->sub_category}}" data-delivery="{{$course_all->delivery}}" data-level="{{$course_all->level}}" data-language="{{$course_all->language}}" data-duration="{{$course_all->duration}}" data-price="{{$course_all->price}}" data-discount_price="{{$course_all->discount_price}}" data-view_scope="{{$course_all->view_scope}}" data-access_limit="{{$course_all->access_limit}}" data-image_url="{{$course_all->image_url}}" data-video_url="{{$course_all->video_url}}" data-course_thumbnail="{{$course_all->course_thumbnail}}" data-og_meta_image="{{$course_all->og_meta_image}}" data-meta_title="{{$course_all->meta_title}}" data-meta_keyword="{{$course_all->meta_keyword}}" data-meta_description="{{$course_all->meta_description}}" data-meta_tags="{{$course_all->meta_tags}}" data-og_meta_title="{{$course_all->og_meta_title}}" data-og_meta_description="{{$course_all->og_meta_description}}">
                                                    <i class="ti-pencil"></i>
                                                </a>

                                                <a href="{{route('course_all.destroy', $course_all->id)}}" class="btn btn-danger btn-delete">delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php $b++; @endphp
                        {{-- @endforeach --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- EDIT MODAL:BEGIN --}}
<div class="modal fade" id="category_edit_modal" aria-hidden="true" 4>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{('Update Course')}}</h5>
                <button type="button" class="close" data-dismiss="modal"><span></span></button>
            </div>
            <div>
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
            </div>
            <form action="{{route('course_all.update')}}" method="post" enctype="multipart/form-data" class="px-3">
                <input type="hidden" name="id" id="category_id">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="edit_topic_title">{{('Title')}}</label>
                        <input type="text" class="form-control" value="" name="topic_title" id="edit_topic_title" placeholder="{{('Title')}}">
                    </div>
                    <div class="form-group">
                        <label for="edit_course_type">{{('Course Type')}}</label>
                        <input type="text" class="form-control" value="" name="course_type" id="edit_course_type" placeholder="{{('Course Type')}}">
                    </div>
                    <div class="form-group">
                        <label for="edit_instructor_id">{{('Instructor ID')}}</label>
                        <input type="number" class="form-control" value="" name="instructor_id" id="edit_instructor_id" placeholder="{{('Instructor ID')}}">
                    </div>
                    <div class="form-group">
                        <label for="edit_course_requirement">{{('Course Requirement')}}</label>
                        <input type="text" class="form-control" value="" name="course_requirement" id="edit_course_requirement" placeholder="{{('Course Requirement')}}">
                    </div>
                    <div class="form-group">
                        <label for="edit_course_description">{{('Course Description')}}</label>
                        <input type="text" class="form-control" value="" name="course_description" id="edit_course_description" placeholder="{{('Course Description')}}">
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
                        <label for="edit_delivery">{{('Mode Of Delivery')}}</label>
                        <select name="delivery" id="edit_delivery" class="form-control">
                            <option value="1">Online</option>
                            <option value="0">Offline</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_level">{{('Level')}}</label>
                    <select name="level" id="edit_level" class="form-control">
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advance">Advance</option>
                        <option value="pro">Pro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_language">{{('Language')}}</label>
                    <select name="language" id="edit_language" class="form-control">
                        <option value="hindi">Hindi</option>
                        <option value="english">English</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="edit_duration">{{('Duration')}}</label>
                    <input type="text" class="form-control" value="" name="duration" id="edit_duration" placeholder="{{('Duration')}}">
                </div>
                <div class="form-group">
                    <label for="edit_price">{{('Price')}}</label>
                    <input type="number" class="form-control" value="" name="price" id="edit_price" placeholder="{{('Price')}}">
                </div>
                <div class="form-group">
                    <label for="edit_discount_price">{{('Discount Price')}}</label>
                    <input type="number" class="form-control" value="" name="discount_price" id="edit_discount_price" placeholder="{{('Discount Price')}}">
                </div>

                <div class="form-group">
                    <label for="edit_view_scope">{{('View Scope')}}</label>
                    <select name="view_scope" id="edit_view_scope" class="form-control">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_access_limit">{{('Access Limit')}}</label>
                    <input type="text" class="form-control" value="" name="access_limit" id="edit_access_limit" placeholder="{{('Access Limit')}}">
                </div>
                <div class="form-group">
                    <label for="edit_image_url">{{('Image URL')}}</label>
                    <input type="file" class="form-control" name="image_url" id="edit_image_url" value="">
                </div>
                <div class="form-group">
                    <label for="edit_video_url">{{('Vedio URL')}}</label>
                    <input type="file" class="form-control" name="video_url" id="edit_video_url" value="">
                </div>
                <div class="form-group">
                    <label for="edit_course_thumbnail">{{('Course Thumbnail')}}</label>
                    <input type="file" class="form-control" name="course_thumbnail" id="edit_course_thumbnail" value="">
                </div>
                <div class="form-group">
                    <label for="edit_meta_title12">{{('Meta Title')}}</label>
                    <input type="text" name="meta_title" id="edit_meta_title12" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Title')}}">
                </div>
                <div class="form-group">
                    <label for="edit_meta_keyword">{{('Meta Keyword')}}</label>
                    <input type="text" name="meta_keyword" id="edit_meta_keyword" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Keyword')}}">
                </div>
                <div class="form-group">
                    <label for="edit_meta_description">{{('Meta Description')}}</label>
                    <input type="text" name="meta_description" id="edit_meta_description" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Description')}}">
                </div>
                <div class="form-group">
                    <label for="edit_meta_tags">{{('Meta Tags')}}</label>
                    <input type="text" name="meta_tags" id="edit_meta_tags" class="form-control" value="" data-role="tagsinput" placeholder="{{('Meta Tags')}}">
                </div>
                <div class="form-group">
                    <label for="edit_og_meta_title">{{('OG Meta Title')}}</label>
                    <input type="text" name="og_meta_title" id="edit_og_meta_title" class="form-control" value="" data-role="tagsinput" placeholder="{{('OG Meta Title')}}">
                </div>
                <div class="form-group">
                    <label for="edit_og_meta_description">{{('OG Meta Description')}}</label>
                    <input type="text" name="og_meta_description" id="edit_og_meta_description" class="form-control" value="" data-role="tagsinput" placeholder="{{('OG Meta Description')}}">
                </div>
                <div class="form-group">
                    <label for="edit_og_meta_image">{{('Og Meta Image')}}</label>
                    <input type="file" class="form-control" name="og_meta_image" id="edit_og_meta_image" value="">
                </div>

                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{('Update Course')}}</button>

            </form>
        </div>
    </div>
</div>
{{-- EDIT MODAL:END --}}
@endsection

@section('script')
<!-- Start datatable js -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#bulk_delete_btn', function(e) {
            e.preventDefault();

            var bulkOption = $('#bulk_option').val();
            var allCheckbox = $('.bulk-checkbox:checked');
            var allIds = [];
            allCheckbox.each(function(index, value) {
                allIds.push($(this).val());
            });
            if (allIds != '' && bulkOption == 'delete') {
                $(this).text('{{('
                    Deleting...')}}');
                $.ajax({
                    'type': "POST",
                    'url': "{{route('admin.blog.bulk.action')}}",
                    'data': {
                        _token: "{{csrf_token()}}",
                        ids: allIds
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }

        });

        $('.all-checkbox').on('change', function(e) {
            e.preventDefault();
            var value = $('.all-checkbox').is(':checked');
            var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
            //have write code here fr
            if (value == true) {
                allChek.prop('checked', true);
            } else {
                allChek.prop('checked', false);
            }
        });

        $('.table-wrap > table').DataTable({
            "order": [
                [1, "desc"]
            ],
            'columnDefs': [{
                'targets': 'no-sort',
                'orderable': false
            }]
        });


        $(document).on('click', '#bulk_delete_btn', function(e) {
            e.preventDefault();

            var bulkOption = $('#bulk_option').val();
            var allCheckbox = $('.bulk-checkbox:checked');
            var allIds = [];
            allCheckbox.each(function(index, value) {
                allIds.push($(this).val());
            });
            if (allIds != '' && bulkOption == 'delete') {
                $(this).text('{{('
                    Deleting...')}}');
                $.ajax({
                    'type': "POST",
                    'url': "{{route('admin.blog.category.bulk.action')}}",
                    'data': {
                        _token: "{{csrf_token()}}",
                        ids: allIds
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }

        });

        $('.all-checkbox').on('change', function(e) {
            e.preventDefault();
            var value = $('.all-checkbox').is(':checked');
            var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
            //have write code here fr
            if (value == true) {
                allChek.prop('checked', true);
            } else {
                allChek.prop('checked', false);
            }
        });


        //edit:begin
        $(document).on('click', '.category_edit_btn', function() {
            var el = $(this);
            console.log(el);
            var id = el.data('id');
            var topic_title = el.data('topic_title');
            var course_type = el.data('course_type');
            var instructor_id = el.data('instructor_id');
            var course_requirement = el.data('course_requirement');
            var course_description = el.data('course_description');
            var category = el.data('category');
            var sub_category = el.data('sub_category');
            var delivery = el.data('delivery');
            var level = el.data('level');
            var language = el.data('language');
            var duration = el.data('duration');
            var price = el.data('price');
            var discount_price = el.data('discount_price');
            var view_scope = el.data('view_scope');
            var access_limit = el.data('access_limit');
            var image_url = el.data('image_url');
            var video_url = el.data('video_url');
            var course_thumbnail = el.data('course_thumbnail');
            var og_meta_image = el.data('og_meta_image');
            var meta_title = el.data('meta_title');
            var meta_keyword = el.data('meta_keyword');
            var meta_description = el.data('meta_description');
            var meta_tags = el.data('meta_tags');
            var og_meta_title = el.data('og_meta_title');
            var og_meta_description = el.data('og_meta_description');
            var modal = $('#category_edit_modal');
            console.log("lllllllllll", meta_title);
            modal.find('#category_id').val(id);
            modal.find('#edit_topic_title').val(topic_title);
            modal.find('#edit_course_type').val(course_type);
            modal.find('#edit_instructor_id').val(instructor_id);
            modal.find('#edit_course_requirement').val(course_requirement);
            modal.find('#edit_course_description').val(course_description);
            modal.find('#edit_category').val(category);
            modal.find('#edit_sub_category').val(sub_category);
            modal.find('#edit_delivery').val(delivery);
            modal.find('#edit_level').val(level);
            modal.find('#edit_language').val(language);
            modal.find('#edit_duration').val(duration);
            modal.find('#edit_price').val(price);
            modal.find('#edit_discount_price').val(discount_price);
            modal.find('#edit_view_scope').val(view_scope);
            modal.find('#edit_access_limit').val(access_limit);

            modal.find('#edit_meta_title12').val(meta_title);
            modal.find('#edit_meta_keyword').val(meta_keyword);
            modal.find('#edit_meta_description').val(meta_description);
            modal.find('#edit_meta_tags').val(meta_tags);
            modal.find('#edit_og_meta_title').val(og_meta_title);
            modal.find('#edit_og_meta_description').val(og_meta_description);
            modal.find('#edit_image_url').val(image_url);
            modal.find('#edit_video_url').val(video_url);
            modal.find('#edit_course_thumbnail').val(course_thumbnail);
            console.log("gjgjhgjhg", course_thumbnail);
            modal.find('#edit_og_meta_image').val(og_meta_image);
            modal.find('#category_id').val(id);
        });
    });
</script>
@endsection