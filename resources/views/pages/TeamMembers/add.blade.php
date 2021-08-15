@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.add_member')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.add_member')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

              <form method="post"  action="{{ route('TeamMembers.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('TeamMembers_trans.member_information')}}</h6><br>
                        <div class="row">
                            
                                <div class="form-group col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="Name_ar"  class="form-control">
                                </div>
                                <div class="form-group  col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="Name_en" type="text" >
                                </div>
                                <div class="form-group  col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.email')}} : </label>
                                    <input type="email"  name="Email" class="form-control" >
                                </div>
                                <div class="form-group  col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.phone')}} : </label>
                                    <input type="phone"  name="Phone" class="form-control" >
                                </div>
                                <div class="form-group  col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.address_ar')}} : </label>
                                    <input type="address"  name="Address_ar" class="form-control" >
                                </div>
                                <div class="form-group  col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.address_en')}} : </label>
                                    <input type="address"  name="Address_en" class="form-control" >
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label>{{trans('TeamMembers_trans.Date_of_Birth')}}  :</label>
                                    <input class="form-control" type="text"  id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd">
                                </div>

                                <div class="form-group col-sm-12 col-md-3">
                                    <label for="gender_id">{{trans('TeamMembers_trans.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option  value="{{ $gender->id }}">{{ $gender->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-3">
                                    <label for="jobtime_id">{{trans('TeamMembers_trans.Job_Time')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="jobtime_id">
                                        <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                                        @foreach($jobtimes as $jobtime)
                                            <option  value="{{ $jobtime->id }}">{{ $jobtime->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="jobtype_id">{{trans('TeamMembers_trans.Job_Type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="jobtype_id">
                                        <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                                    @foreach($jobtypes as $jobtype)
                                        <option  value="{{ $jobtype->id }}">{{ $jobtype->Name }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="form-group  col-sm-12 col-md-4">
                                    <label>{{trans('TeamMembers_trans.Salary')}} : </label>
                                    <input type="salary"  name="salary" class="form-control" >
                                </div>


                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="currency_id">{{trans('TeamMembers_trans.Currency')}} : </label>
                                    <select class="custom-select mr-sm-2" name="currency_id">
                                        <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                                    @foreach($currencies as $currency)
                                        <option  value="{{ $currency->id }}">{{ $currency->Name }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="service_id">{{trans('TeamMembers_trans.Service')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="service_id">
                                        <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                                    @foreach($my_positions as $my_position)
                                        <option  value="{{ $my_position->id }}">{{ $my_position->Name }}</option>
                                    @endforeach
                                </select>
                                </div>
                           

                                <div class="form-group col-sm-12 col-md-4">
                                    <label for="position_id">{{trans('TeamMembers_trans.Positions')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="position_id">

                                    </select>
                                </div>
                               
                                <div class="form-group col-sm-12 col-md-4">
                                    
                                        <label for="academic_year">{{trans('TeamMembers_trans.Attachments')}} : <span class="text-danger">*</span></label><br>
                                        <input type="file" accept="image/*" name="photos[]" multiple>
                                   
                                </div>

                                
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit" style="margin: auto; width:60px; ">{{trans('TeamMembers_trans.submit')}}</button>
                          
                        </div>
                   
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="service_id"]').on('change', function () {
                var service_id = $(this).val();
                if (service_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_positions') }}/" + service_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="position_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="position_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }
                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection