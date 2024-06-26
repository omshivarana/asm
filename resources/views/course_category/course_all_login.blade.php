@extends('frontend_new.extendmaster');
{{-- /var/www/html/omshiva.asmbeta.in/@core/resources/views/frontend_new/extendmaster.blade.php --}}
@section('site-title')
    {{__('Enroll')}}
@endsection
@section('page-title')
    {{__('Enroll')}}
@endsection

@section('content')
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="enroll-area-wrapper">
                        @if(auth()->guard('web')->check())
                        <div class="enroll-form-wrapper">
                            <x-error-msg />
                            <x-flash-msg />
                            <div class="col-lg-12">
                                {{-- session flash use:BEGIN --}}
                            @if(session('success'))
                            <h4 class="d-flex justify-content-center py-2 bg-primary text-white">{{session('success')}}</h4>
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
                            <h4 class="amount-title">{{ __('Payable Amount') }} <span class="price">₹{{$course_all_enroll->price}}</span></h4>
                            <form action="{{route('course_all_filter.course_enroll_store', )}}" method="post" class="appointment-booking-form" id="appointment_rating_form">
                                @csrf
                                <input type="hidden" name="course_all_id" value="">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="{{ __('Name') }}"  value="{{auth()->guard('web')->user()->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="{{ __('Email') }}" value="{{auth()->guard('web')->user()->email}}">
                                </div>
                                <div class="form-group coupon">
                                    <label for="coupon">{{ __('Have Coupon?') }}</label>
                                    <input type="text" name="coupon" id="coupon" class="form-control"
                                        placeholder="{{ __('Coupon') }}">
                                    <span class="right spin-none" id="course_coupon_apply">{{ __('Apply') }}<i
                                            class="fas fa-spinner fa-spin"></i></span>
                                </div>
                                <div class="payment-gateway-wrapper"><input type="hidden" name="selected_payment_gateway"
                                        value="manual_payment">
                                    <ul>
                                        <li data-gateway="paypal" class="">
                                            <div class="img-select"><img
                                                    src="http://omshiva.asmbeta.in/assets/uploads/media-uploader/paypal-logowine1592737455.png"
                                                    alt=""></div>
                                        </li>
                                        <li data-gateway="manual_payment" class="selected">
                                            <div class="img-select"><img
                                                    src="http://omshiva.asmbeta.in/assets/uploads/media-uploader/wallet-money-logo-icon-design-vector-229013281592737514.jpg"
                                                    alt=""></div>
                                        </li>
                                        <li data-gateway="paytm">
                                            <div class="img-select"><img
                                                    src="http://omshiva.asmbeta.in/assets/uploads/media-uploader/download1592737457.png"
                                                    alt=""></div>
                                        </li>
                                        <li data-gateway="stripe">
                                            <div class="img-select"><img
                                                    src="http://omshiva.asmbeta.in/assets/uploads/media-uploader/social1592737458.png"
                                                    alt=""></div>
                                        </li>
                                        <li data-gateway="razorpay">
                                            <div class="img-select"><img
                                                    src="http://omshiva.asmbeta.in/assets/uploads/media-uploader/razorpay-the-new-epayment-that-will-break-everything-in-20191592737459.png"
                                                    alt=""></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="coupon-msg-wrap"></div>

                                <div class="form-group manual_payment_transaction_field">
                                    <div class="label">{{ __('Transaction ID') }}</div>
                                    <input type="text" name="transaction_id" placeholder="{{ __('transaction') }}"
                                        class="form-control">
                                    <span class="help-info">Data</span>
                                </div>
                                @if(!empty($course->price) && $course->price != 0)
                                        {!! render_payment_gateway_for_form(false) !!}
                                        @if(!empty(get_static_option('manual_payment_gateway')))
                                            <div class="form-group manual_payment_transaction_field @if( get_static_option('site_default_payment_gateway') === 'manual_payment') d-block @endif ">
                                                <div class="label">{{__('Transaction ID')}}</div>
                                                <input type="text" name="transaction_id" placeholder="{{__('transaction')}}" class="form-control">
                                                <span class="help-info">{!! get_manual_payment_description() !!}</span>
                                            </div>
                                        @endif
                                    @endif
                                <div class="btn-wrapper">
                                    <button type="submit" class="btn-boxed enroll">Enroll now</button>
                                </div>
                            </form>
                        </div>                        
                        @else 
                        @include('frontend.partials.ajax-login-form', ['title' => __('Login to enroll')])  
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection


@section('scripts')
    @include('frontend.partials.ajax-login-form-js')
    <script>
        (function (){
            "use strict";

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                var manual_gateway_tr = $('.manual_payment_transaction_field');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway === 'manual_payment'){
                    manual_gateway_tr.removeClass('d-none').addClass('d-block');
                }else{
                    manual_gateway_tr.addClass('d-none').removeClass('d-block');
                }
            });

            $(document).on('click','#course_coupon_apply',function (){
               var course_id = $('input[name="course_id"]').val();
               var coupon = $('input[name="coupon"]').val();
                $(this).removeClass('spin-none')
               if(coupon == ''){
                    $('.coupon-msg-wrap').html('');
                    $('.coupon-msg-wrap').html('<span class="text-danger">'+'{{__("enter coupon")}}'+'</span>');
                    $(this).addClass('spin-none');
                   return
                }
               $.ajax({
                   'type' : 'post',
                   'url' : "{{route('frontend.course.apply.coupon')}}",
                   data: {
                        '_token': "{{csrf_token()}}",
                        'course_id' : course_id,
                        'coupon' : coupon
                   },
                   success: function (data){
                       $('#course_coupon_apply').addClass('spin-none');
                       $('.coupon-msg-wrap').html('');
                       $('.coupon-msg-wrap').html('<span class="text-'+data.status+'">'+data.msg+'</span>');
                       if(data.status == 'success'){
                           var oldPrice = $('.enroll-form-wrapper .amount-title .price').text();
                           $('.enroll-form-wrapper .amount-title .price').html(data.amount+'<del>'+oldPrice+'</del>');
                       }

                   }
               });
            });

        })(jQuery);
    </script>
@endsection
