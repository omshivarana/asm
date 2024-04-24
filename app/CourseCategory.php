<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_categories';
    protected $fillable=[
        'name',
        'description',
        'parent_id',
        'position_order',
        'status',
        'icon',
        'thumbnail_image'
    ];
}
