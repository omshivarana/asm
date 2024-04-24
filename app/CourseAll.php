<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseAll extends Model
{
    protected $table='course_alls';
    protected $fillable=[
        'course_type',
        'instructor_id',
        'topic_title',
        'course_requirement',
        'course_description',
        'category',
        'sub_category',
        'delivery',
        'level',
        'language',
        'duration',
        'price',
        'discount_price',
        'image_url',
        'video_url',
        'view_scope',
        'access_limit',
        'course_thumbnail',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_tags',
        'og_meta_title',
        'og_meta_description',
        'og_meta_image'
    ];
}
