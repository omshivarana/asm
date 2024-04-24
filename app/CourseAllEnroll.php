<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseAllEnroll extends Model
{
    protected $table = 'course_all_enrolls';
    protected $fillable=[
        'total',
        'name',
        'email',
        'course_id',
        'user_id',
        'payment_gateway',
        'payment_track',
        'transaction_id',
        'payment_status',
        'status',
        'coupon',
        'coupon_discounted',
    ];
}
