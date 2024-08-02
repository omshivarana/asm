@extends('backend.layouts.master')
@section('title')
Staff
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('style')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <!-- basic form start -->
        <div class="col-lg-12">
            <div class="margin-top-40"></div>

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
                <div class="statud">
                    @if (Session::has('status'))
                    <div class="alert alert-success">
                        <h6>{{ Session::get('status') }}</h6>
                    </div>
                    @endif
                    @if (Session::has('danger'))
                    <div class="alert alert-danger">
                        <h6>{{ Session::get('danger') }}</h6>
                    </div>
                    @endif
                    @if (Session::has('primary'))
                    <div class="alert alert-primary">
                        <h6>{{ Session::get('primary') }}</h6>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="header-title">{{__('Security Staff')}}</h4>
                    <div class="bulk-delete-wrapper">
                        <div class="select-box-wrap d-flex justify-content-end">
                            <!-- <select name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button> -->
                            <div class="float-right mb-5">
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Staff</a>
                            </div>
                            <!-- Start : add staff -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.staff.store' )}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city">
                                                </div>
                                                <div class="form-group">
                                                    <label for="pincode">Pincode</label>
                                                    <input type="number" class="form-control" name="pincode" id="pincode" placeholder="Enter your pincode">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <select class="form-control" name="state" id="state">
                                                        <option value="">Select your state</option>
                                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                        <option value="Assam">Assam</option>
                                                        <option value="Bihar">Bihar</option>
                                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                                        <option value="Goa">Goa</option>
                                                        <option value="Gujarat">Gujarat</option>
                                                        <option value="Haryana">Haryana</option>
                                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                        <option value="Jharkhand">Jharkhand</option>
                                                        <option value="Karnataka">Karnataka</option>
                                                        <option value="Kerala">Kerala</option>
                                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                        <option value="Maharashtra">Maharashtra</option>
                                                        <option value="Manipur">Manipur</option>
                                                        <option value="Meghalaya">Meghalaya</option>
                                                        <option value="Mizoram">Mizoram</option>
                                                        <option value="Nagaland">Nagaland</option>
                                                        <option value="Odisha">Odisha</option>
                                                        <option value="Punjab">Punjab</option>
                                                        <option value="Rajasthan">Rajasthan</option>
                                                        <option value="Sikkim">Sikkim</option>
                                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                                        <option value="Telangana">Telangana</option>
                                                        <option value="Tripura">Tripura</option>
                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                        <option value="Uttarakhand">Uttarakhand</option>
                                                        <option value="West Bengal">West Bengal</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="guest_name">{{ __('Role') }}</label>
                                                    <select class="form-control" name="role_id" id="role_id">
                                                        <option value="">{{ __('Select Role') }}</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End : add staff -->
                        </div>

                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @php $a=0; @endphp
                    </ul>
                    <div class="tab-content margin-top-40">
                        @php $b=0; @endphp

                        <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab" role="tabpanel">
                            <div class="table-wrap table-responsive">
                                <table class="table table-default" id="all_blog_table">
                                    <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('email')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('City')}}</th>
                                        <th>{{__('Pincode')}}</th>
                                        <th>{{__('Address')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>

                                        @foreach($staffs as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->phone}}</td>
                                            <td>{{$data->city}}</td>
                                            <td>{{$data->pincode}}</td>
                                            <td>{{$data->address}}</td>

                                            <td class="d-flex">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="btn text-white btn-secondary btn-xs mb-3 mr-1 testimonial_view_btn" 
                                                data-id="{{$data->id}}" 
                                                data-name="{{$data->name}}" 
                                                data-email="{{$data->email}}" 
                                                data-phone="{{$data->phone}}" 
                                                data-city="{{$data->city}}" 
                                                data-pincode="{{$data->pincode}}" 
                                                data-state="{{$data->state}}" 
                                                data-address="{{$data->address}}" 
                                                data-role_id="{{$data->role_id}}"
                                                data-password="{{$data->password}}"
                                                >
                                                    <i class="ti-eye">view</i>
                                                </a>&nbsp;
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn" data-id="{{$data->id}}" data-name="{{$data->name}}" data-email="{{$data->email}}" data-phone="{{$data->phone}}" data-city="{{$data->city}}" data-pincode="{{$data->pincode}}" data-state="{{$data->state}}" data-address="{{$data->address}}" data-role_id="{{$data->role_id}}">
                                                    <i class="ti-pencil">edit</i>
                                                </a>&nbsp;
                                                <form action="{{route('admin.staff.destroy', $data->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">delete</button>
                                                </form>

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

<div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Staff')}}</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('admin.staff.update') }}" id="testimonial_edit_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="gallery_id" value="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city">
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input type="number" class="form-control" name="pincode" id="pincode" placeholder="Enter your pincode">
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" name="state" id="state">
                            <option value="">Select your state</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address">
                    </div>
                    <div class="form-group">
                        <label for="guest_name">{{ __('Role') }}</label>
                        <select class="form-control" name="role_id" id="role_id">
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- View Modal Satrt --}}
<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body  input-amenty">
                <table class="table view-table" id="testimonial_view_modal_form">
                    <tbody>
                        <tr>
                            <th scope="row">ID</th>
                            <td></td>
                            <td><input type="text" id="id" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td></td>
                            <td><input type="text" id="name" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td></td>
                            <td><input type="text" id="email" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td></td>
                            <td><input type="text" id="phone" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">City</th>
                            <td></td>
                            <td><input type="text" id="city" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Pincode</th>
                            <td></td>
                            <td><input type="text" id="pincode" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">State</th>
                            <td></td>
                            <td><input type="text" id="state" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td></td>
                            <td><input type="text" id="address" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Role ID</th>
                            <td></td>
                            <td><input type="text" id="role_id" readonly></td>
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
{{-- View Modal End --}}
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include other scripts -->
<script src="jquery.dataTables.min.js"></script>
<script src="dataTables.bootstrap4.min.js"></script>
<script src="dataTables.responsive.min.js"></script>
<script src="responsive.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {

        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var image = el.data('email');
            var description = el.data('phone');
            var status = el.data('city');
            var pincode = el.data('pincode');
            var state = el.data('state');
            var address = el.data('address');
            var role_id = el.data('role_id');
            var password = el.data('password');

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#name').val(el.data('name'));
            form.find('#email').val(el.data('email'));
            form.find('#phone').val(el.data('phone'));
            form.find('#city').val(el.data('city'));
            form.find('#pincode').val(el.data('pincode'));
            form.find('#state').val(el.data('state'));
            form.find('#address').val(el.data('address'));
            form.find('#role_id').val(el.data('role_id'));
            form.find('#password').val(el.data('password'));
            form.find('.form-check-input').each(function() {
                var checkbox = $(this);
                if (amenities.includes(checkbox.val())) {                 
                    checkbox.prop('checked', true);
                } else {
                    checkbox.prop('checked', false);
                }
            });


        });

        $(document).on('click', '.testimonial_view_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var image = el.data('email');
            var description = el.data('phone');
            var status = el.data('city');
            var pincode = el.data('pincode');
            var state = el.data('state');
            var address = el.data('address');
            var role_id = el.data('role_id');
            var password = el.data('password');

            var form = $('#testimonial_view_modal_form');
            form.find('#id').val(id);
            form.find('#name').val(el.data('name'));
            form.find('#email').val(el.data('email'));
            form.find('#phone').val(el.data('phone'));
            form.find('#city').val(el.data('city'));
            form.find('#pincode').val(el.data('pincode'));
            form.find('#state').val(el.data('state'));
            form.find('#address').val(el.data('address'));
            form.find('#role_id').val(el.data('role_id'));


        });


    });
</script>

<!-- Start datatable js -->
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


-

<script>
    $(document).ready(function() {
        $('.table-wrap > table').DataTable({
            "order": [
                [1, "desc"]
            ],
            'columnDefs': [{
                'targets': 'no-sort',
                'orderable': false
            }]
        });
    });
</script>
