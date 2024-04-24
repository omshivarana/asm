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
<script>
    function enrollData(enroll) {
        console.log(enroll);
        $('#name_view').html(enroll.name);
        $('#email_view').html(enroll.email);
        $('#total_view').html(enroll.total);
        $('#payment_status_view').html(enroll.payment_status);
        $('#status_view').html(enroll.status);
        $('#payment_gateway_view').html(enroll.payment_gateway);
        $('#coupon_view').html(enroll.coupon);
        $('#coupon_discounted_view').html(enroll.coupon_discounted);
        $('#course_id_view').html(enroll.course_id);
        $('#user_id_view').html(enroll.user_id);
    }
</script>
@endsection
@section('site-title')
{{('Course Enrolled List')}}
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
                    <h4 class="header-title">{{('Course Enrolled List')}}</h4>
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
                                        <th>{{('Name')}}</th>
                                        <th>{{('Email')}}</th>
                                        <th>{{('Total')}}</th>
                                        <th>{{('Payment Gateway')}}</th>
                                        <th>{{('Transaction ID')}}</th>
                                        <th>{{('Payment Status')}}</th>
                                        <th>{{('Status')}}</th>
                                        <th>{{('Coupon')}}</th>
                                        <th>{{('Coupon Discounted')}}</th>
                                        <th>{{('Action')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach( $course_all_enroll as $enroll)
                                        <tr>
                                            <td></td>
                                            <td>{{$enroll->id}}</td>
                                            <td>{{$enroll->name}}</td>
                                            <td>{{$enroll->email}}</td>
                                            <td>₹{{$enroll->total}}</td>
                                            <td>{{$enroll->payment_gateway}}</td>
                                            <td>{{$enroll->transaction_id}}</td>
                                            <td>{{$enroll->payment_status}}</td>
                                            <td>{{$enroll->status}}</td>
                                            <td>{{$enroll->coupon}}</td>
                                            <td>₹{{$enroll->coupon_discounted}}</td>
                                            <td class="d-flex justify-content-center">
                                                <button onclick="enrollData({{$enroll}})" class="btn btn-primary" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;
                                                <a href="{{route('course_all_filter.enroll_destroy', $enroll->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php $b++; @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- VIEW MODEL:BEGIN --}}
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enrolled Details</h5>
                <hr>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td id="name_view">{{$enroll->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td id="email_view">{{$enroll->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Total</th>
                            <td id="total_view">{{$enroll->total}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Payment status</th>
                            <td id="payment_status_view">{{$enroll->payment_status}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td id="status_view">{{$enroll->status}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Payment gateway</th>
                            <td id="payment_gateway_view">{{$enroll->payment_gateway}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Coupon</th>
                            <td id="coupon_view">{{$enroll->coupon}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Coupon Discounted</th>
                            <td id="coupon_discounted_view">{{$enroll->coupon_discounted}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Course ID</th>
                            <td id="course_id_view">{{$enroll->course_id}}</td>
                        </tr>
                        <tr>
                            <th scope="row">User ID</th>
                            <td id="user_id_view">{{$enroll->user_id}}</td> <!-- Fixed the ID here -->
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- VIEW MODEL:END --}}
@endsection

@section('script')
<!-- Start datatable js -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

@endsection